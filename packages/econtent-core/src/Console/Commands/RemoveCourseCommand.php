<?php

namespace EONConsulting\Core\Console\Commands;

use App\Models\StudentProgress;
use App\Models\SummaryModuleProgression;
use App\Models\SummaryStudentProgression;
use DB;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\StudentNotes\Models\Note;
use Illuminate\Console\Command;
use Storage;

class RemoveCourseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:course:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Course';

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

        $courses = Course::all();

        $course_choice = $this->choice('Select a course to remove', $courses->pluck('title')->toArray());

        if ( ! $this->confirm('Are you sure you wish to delete [' . $course_choice . ']')) {
            $this->info('Stopping delete!');
            return;
        }

        DB::beginTransaction();

        $course = Course::where('title', $course_choice)->first();

        /*
         * Delete Files
         */
        $course->exported_file()->get()->each->delete();
        $course->faulty_file()->get()->each->delete();

        /*
         * Loop through the storyline items
         */
        $course->storylines()->get()->each(function($storyline)
        {
            $this->info('Removing storyline storyline_id [' . $storyline->id . ']');

            $storyline->items()->get()->each(function($item)
            {
                $this->info('- Removing item [' . $item->name . ']');

                /*
                 * Delete Files
                 */
                $item->exported_file()->get()->each->delete();
                $item->faulty_file()->get()->each->delete();

                /*
                 * Delete content
                 */
                $item->content()->get()->each(function($content)
                {
                    $content->categories()->detach();

                    $content->delete();
                });

                /*
                 * Delete Storynotes
                 */
                Note::forStoryLineItem($item->id)->get()->each->delete();
            });

            /*
             * Delete Student Progress
             */
            StudentProgress::where('storyline_id', $storyline->id)->delete();

            /*
             * Delete Model Summery Progress
             */
            SummaryModuleProgression::where('storyline_id', $storyline->id)->delete();

            /*
             * Delete Student Summery Progress
             */
            SummaryStudentProgression::where('storyline_id', $storyline->id)->delete();

            /*
             * Delete storyline items
             */
            $storyline->items()->delete();

            /*
             * Delete storyline itself
             */
            $storyline->delete();
        });

        /*
         * Delete Course
         */
        $course->users()->detach();

        $course->delete();

        DB::commit();

        return;
    }
}