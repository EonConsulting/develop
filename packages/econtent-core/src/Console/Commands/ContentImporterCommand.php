<?php

namespace EONConsulting\Core\Console\Commands;

use DB;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use EONConsulting\ContentBuilder\Models\Content;
use Illuminate\Console\Command;
use Storage;

// use EONConsulting\Core\Helpers\ContentImporter\Importer;

use Facades\ {
    EONConsulting\Core\Helpers\ContentImporter\Importer
};

class ContentImporterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:content:importer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to import content for FBN courses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {



        if( ! $course_values = $this->commandQuestions())
        {
            $this->info('Stopping inport!');
            return;
        }



        DB::beginTransaction();

        try {

            $html = Importer::fromUrl(array_get($course_values, 'link'));

        } catch(\Exception $e)
        {
            $this->error($e->getMessage());

            DB::rollBack();

            return false;
        }

        $course = $this->createCourse([
            'title' => array_get($course_values, 'title'),
        ]);

        $storyline = $this->createStoryLine([
            'course_id' => $course->id,
        ]);

        $storyline_root = StorylineItem::updateOrCreate([
            'name' => 'Root',
            'storyline_id' => $storyline->id,
        ]);

        $tree_items = [];

        $counter = 1;

        foreach($html->getTopics()->all() as $topic)
        {
            $this->info('Importing: [' . $topic->get('name') . ']');

            $content_model = $this->CreateContent([
                'title' => $topic->get('name'),
                'description' => $topic->get('name'),
                'body' => "<h3>{$topic->get('name')}</h3>",
            ]);

            $tree_items[$counter] = [
                'name' => $topic->get('name'),
                'content_id' => $content_model->id,
                'storyline_id' => $storyline->id,
                'root_parent' => $storyline_root->id,
            ];

            if($topic->has('children'))
            {
                $tree_items[$counter]['children'] = $this->buildContentTree($topic->get('children'), $storyline_root->id, $storyline->id, $counter);
            }

            $counter++;
        }

        $storyline_root->makeTree($tree_items);

        DB::commit();



        $storyline_items = StorylineItem::where('storyline_id', $storyline->id)->where('name', '!=', 'Root')->get();

        $tree_items = [];

        $counter = 0;

        foreach($storyline_items as $item)
        {
            if(str_contains($item->name, ['Welcome']))
            {
                $tree_items[$counter] = [
                    'id' => $item->id,
                    'storyline_id' => $item->storyline_id,
                    'name' => $item->name,
                ];

                $counter++;

                continue;
            }

            $tree_items[$counter] = [
                'id' => $item->id,
                'storyline_id' => $item->storyline_id,
                'name' => $item->name,
                'required' => $tree_items[$counter-1]['id'],
            ];

            $counter++;
        }

        StorylineItem::buildTree($tree_items);
        $this->info('Import Finished!');

        return true;
    }

    /*
     * Ask a couple questions to get started
     *
     * @return array
     */
    protected function commandQuestions()
    {
        $title = $this->ask('Please enter a course name?');

        $type = $this->choice('Please select the course type?', ['FBN']);

        $link = $this->ask('Please enter the full url to the course?');

        if ( ! $this->confirm('Do you wish to continue with the import?'))
        {
            return false;
        }

        return compact('title', 'type', 'link');
    }

    /*
     * Build the content tree and add the content
     */
    protected function buildContentTree($pages, $root_parent, $storyline_id, $parent_id, $level = 1)
    {
        $tree_items = [];
        $temp = '';
        $level++;

        foreach($pages->all() as $page)
        {

            $html = Importer::fromUrl($page->get('link'));

            $this->info(str_repeat("\t", $level) . 'Importing: [' . $page->get('name') . ']');

            try {

                $html_title = $html->getTitle();

                $body = $html->removeElements()
                    ->storeAssets($page->get('link'))
                    ->fixMathJax()
                    ->cleanFbnClasses()
                    ->getBody();

            } catch(\Exception $e)
            {
                $this->error($e->getMessage());

                DB::rollBack();

                exit;
            }

            $content_model = $this->createContent([
                'title' => $html_title,
                'description' => $html_title,
                'body' => $body,
            ]);

            $temp = [
                'name' => $page->get('name'),
                'content_id' => $content_model->id,
                'parent_id' => $parent_id,
                'storyline_id' => $storyline_id,
                'root_parent' => $root_parent,
                //'required' => $parent_id,
            ];

            if($page->has('children'))
            {
                $temp['children'] = $this->buildContentTree($page->get('children'), $root_parent, $storyline_id, $html->getPageId(), $level);
            }

            $tree_items[] = $temp;
        }

        return $tree_items;
    }

    /*
     * Helper method to create or update content
     *
     * @return model
     */
    protected function createContent($params)
    {
        return Content::firstOrCreate([
            'title' => $params['title'],
            'description' => $params['title'],
            'body' => $params['body'],
            'creator_id' => 1,
        ]);
    }

    /*
     * Helper method to create or update courses
     *
     * @return model
     */
    protected function createCourse($params = [])
    {
        return Course::firstOrCreate([
            'title' => $params['title'],
            'description' => 'Auto Imported',
            'creator_id' => 1,
            'template_id' => 1,
        ]);
    }

    /*
     * Helper method to create or update a storyline
     *
     * @return model
     */
    protected function createStoryLine($params = [])
    {
        return Storyline::firstOrCreate([
            'course_id' => $params['course_id'],
            'creator_id' => 1,
            'version' => 1,
        ]);
    }
}
