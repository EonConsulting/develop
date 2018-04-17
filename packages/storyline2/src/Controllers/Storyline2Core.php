<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/01/19
 * Time: 9:21 AM
 */

namespace EONConsulting\Storyline2\Controllers;

use Illuminate\Routing\Controller as BaseController;
use EONConsulting\Storyline2\Models\Course;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use Symfony\Component\HttpFoundation\Request;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\ContentBuilder\Models\Category;
use EONConsulting\ContentBuilder\Controllers\ContentBuilderCore as ContentBuilder;
use App\Tools\Elasticsearch\Elasticsearch;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use EONConsulting\Exports\Jobs\SinglePdfExportJob;
use EONConsulting\ContentBuilder\Jobs\ContentElasicUpdate;


class Storyline2Core extends BaseController {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rename_storyline_item(Request $request)
    {
        if (is_array($request->data))
        {
            $ItemId = (int) $request->data['id'];
            $node = StorylineItem::find($ItemId);
            $node->name = $request->data['text'];

            if ($node->save())
            {
                $msg = 'success';
            } else {
                $msg = 'failed';
            }

            return response()->json(['msg' => $msg], 200);
        }
    }



    public function storeProgress($item, $data)
    {
        if( ! $item instanceof StorylineItem)
        {
            $item = StorylineItem::find($item);
        }

        $item->required = array_get($data, 'topic', null);

        return $item->save();
    }   


    /**
     * Undocumented function
     *
     * @param [type] $item
     * @return void
     */
    public function get_content(StorylineItem $item)
    {
        $req = '';

        if( ! empty($item->required))
        {
            $req = StorylineItem::find($item->required);
        }

        //$Siblings    = $item->getAncestorsAndSelfWithoutRoot();
        $Storyline2ViewsJSON  = new Storyline2ViewsJSON;

        //$topicArray = $Storyline2ViewsJSON->items_to_tree(Storyline::find($item->storyline_id)->items);
        $items = StorylineItem::where('storyline_id', $item->storyline_id)->get();
         
        $topicArray = $Storyline2ViewsJSON->items_to_tree($items);
         
        usort($topicArray, [$this, "self::compare"]);
        
        if ($item['content_id'] == null)
        {
            $result = [
                "topics" => $topicArray,
                "item" => $item,
                "req" =>$req,
                "found" => false
            ];

        } else {

            $content = $item->content;

            $faulty_file = $item->faulty_file;

            $result = [
                "found" => true, 
                "topics" => $topicArray,
                "item" => $item,
                "req" =>$req,
                "content" => $content,
                "categories" => $content->categories,
                "faulty_file" => $faulty_file,
            ];
        }

        return response()->json($result, 200);
    }

    public function search_storyline(Request $request)
    {
        $data = $request->json()->all();

        $from = $data['from'];
        $size = $data['size'];

        $elasticsearch = new Elasticsearch;
        $index = 'content';

        $term = $data['term'];
        $course = $data['course'];

        $order = DB::select('
            SELECT co.id, si.id as item_id FROM storyline_items si
                LEFT JOIN storylines s ON s.id = si.storyline_id
                LEFT JOIN courses c ON c.id = s.course_id
                LEFT JOIN content co ON co.id = si.content_id
                WHERE 1=1
                AND c.id = '.$course.'
                ORDER BY si._lft;
        ');

        if($term === null && $course === null){

            Log::debug("Get ALL content");

            $query = '{
                "query": {
                     "match_all": {}
                 }
             }';
        }else{

            $first = true;

            //if a term is passed, build term portion of query
            if($term !== null){

                $q_term = '
                "must": {
                    "multi_match": {
                        "query" : "' . $term . '",
                        "fields" : ["title","description","body","tags"]
                    }
                }';
                
                $first = false;
            }else{
                $q_term = '';
            }
            
            
            //if a term is passed, build term portion of query
            if($course !== null){ //category only

                if($term !== null){
                    $q_course = ",";
                } else {
                    $q_course = "";
                }
                $q_course .= '"filter": [{ "match": { "courses": "' . $course . '" }}]';
            }else{
                $q_course = '';
            }

            $query = '{
                "query": {
                    "bool": {
                        ' . $q_term .
                        $q_course .'
                    }
                }
            }';
        }

        Log::debug("Query String---------------------------------------------------");
        Log::debug($query);

        $success = false;

        try {
            $output = $elasticsearch->search($index, $query, $from, $size);
            $success = true;
            Log::debug("Elastic search success---------------------------------------------------");
        } catch (\ErrorException $e) {
            Log::error("Unable to perform search: " . $e->getMessage());
            
        }

        if($success){
            $output = json_decode($output);

            $hits = $output->hits->hits;
            $total = $output->hits->total;
    
            $searchOutput = [
                "meta" => [
                    "total" => $total,
                    "searchterm" => $term,
                ],
                "results" => []
            ];
    
            /*foreach ($hits as $hit) {
    
                //$content = Content::find($hit->_id);
                //$content->tags = $this->get_tags($content);
                //$content->categories = $content->categories();

                //$hit->tags = explode(',',$hit->tags);
                $temp = $hit->_source;
                $searchOutput['results'][] = [
                    "id" => $temp->id,
                    "title" => $temp->title,
                    "courses" => $temp->courses
                ];
                
            }*/

            foreach ($order as $o)
            {
                foreach($hits as $hit)
                {
                    $temp = $hit->_source;
                    
                    if($o->id."" === $temp->id."")
                    {
                        $searchOutput['results'][] = [
                            "id" => $temp->id,
                            "title" => $temp->title,
                            "courses" => $temp->courses,
                            "item_id" => $o->item_id.""
                        ];
                    }
                }
            }

        } else {
            $output = false;
        }



        return response()->json($searchOutput, 200);
    }

    /**
     * @param $content
     * @param $item
     * @param $action
     * @return \Illuminate\Http\JsonResponse
     */
    public function attach_content_to_item($content, $item, $action)
    {
        $result = ["id" => $item];

        if($action === "copy")
        {

            $this_content = Content::find($content);
            
            $new_content = new Content($this_content->toArray());
            $new_content->title = "";
            $new_content->cloned_id = $content;
            $new_content->save();

            $new_content->categories()->sync($this_content->categories);

            $storyline_item = StorylineItem::find($item);
            $storyline_item->content_id = $new_content->id;
            $storyline_item->save();

        } elseif($action === "link") {

            $storyline_item = StorylineItem::find($item);
            $storyline_item->content_id = $content;
            $storyline_item->save();

            ContentElasicUpdate::dispatch($storyline_item->content);
        }

        return response()->json($result);


    }

    /**
     * @param $a
     * @param $b
     * @return int
     */
    public function compare($a,$b)
    {
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }


    /**
     * @param Request $request
     * @param $item
     * @return int
     */
    public function save_content(Request $request, $item_id)
    {
        $data = $request->validate([
            'id' => 'sometimes',
            'title' => 'required',
            'body' => 'required',
            'tags' => 'required',
            'topic' => 'sometimes',
            'description' => 'required',
            'categories' => 'required',
        ]);

        $content = Content::updateOrCreate([
            'id' => array_get($data, 'id')
        ],[
            'title' => array_get($data, 'title'),
            'body' => array_get($data, 'body'),
            'tags' => array_get($data, 'tags'),
            'creator_id' => auth()->user()->id,
            'description' => array_get($data, 'description'),
            'ingested' => 0,
        ]);

        $content->categories()->sync(array_get($data, 'categories'));

        $item = StorylineItem::find($item_id);

        $item->content_id = $content->id;
        $item->required = array_get($data, 'topic');

        $item->save();

        ContentElasicUpdate::dispatch($content);

        /*
         * Temp because the observers ain't working
         */
        if($item = $content->storyline_item)
        {
            SinglePdfExportJob::dispatch($item);
        }

        return response()->json($content, 200);
    }




        //one time function that resets all storylines to sequential, use with extreme caution
/*    public function set_required(){

        ini_set('max_execution_time', 5000);

        $storylines = Storyline::all();

        foreach($storylines as $storyline){

            echo "Starting Storyline " . $storyline['id'] . " - Course: " . $storyline['course_id'] . ":---------------------------------<br>";

            $items = StorylineItem::where('storyline_id',$storyline['id'])->orderBy('_lft', 'ASC')->get();

            //dd($items->toArray());
            //$first = true;
            $prev_id = 0;
            $c = 0;

            foreach($items as $item){

                //dd($item);

                echo ("Start Item: " . $item['name']);
                if($c == 2){
                    $item['required'] = $prev_id;
                    echo (" | Set Item");
                } else {
                    $item['required'] = null;
                    $c++;
                }

                $item->save();
                echo " | Saved<br>";
                $prev_id = $item['id'];
            }

            echo "Finished Storyline: ". $storyline['name'] . "---------------------------------<br><br>";
        }

    }*/
    
    
}
