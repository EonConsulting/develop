<?php
namespace EONConsulting\Storyline\Table\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\Storyline\Table\Csv;

class DefaultController extends LTIBaseController {

    /**
     * @param $course
     * @param $filetype
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFileuploadView($course,$filetype) {

        return view('fileupload::csvfileupload',['course'=>$course,'filetype'=>$filetype]);
    }

    /**
     * @param Request $request
     * @param Course $course
     */
    public function storeStoryline(Request $request, Course $course){

        if (empty($_FILES['csv']))
            echo json_encode(['error'=>'No file found for upload, please upload file.']);

            if($typ = $request["filetype"])
                 switch ($typ) {
                    case "csv":
                        $csv = array_map("str_getcsv", file($_FILES['csv']['tmp_name']));
                        $header = array_shift($csv);
                        $col = array_search("title", $header);
                        foreach ($csv as $row) {
                            $array[] = ['name' => $row[$col],'file_url' => '', 'file_name' => '','children' => []];
                        }

                        $CVS = [
                            ['name'=>$course->title,'file_url' => '', 'file_name' => '','parent_id'=>null, 'children' => $array]
                        ];

                        $stId = Storyline::where('course_id', '=', $course->id)->first();

                        if ($stId == null) {
                            $storyline = new Storyline;
                            $storyline->course_id = $course->id;
                            $storyline->creator_id = $request->user()->id;
                            $storyline->save();
                            $this->save_storyline_items($storyline,$CVS);
                        } else {
                            //$storyline = new Storyline;
                            //$storyline->course_id = $course->id;
                            //$storyline->creator_id = $request->user()->id;
                            //dd($stId);
                            $stId->update();
                            $this->save_storyline_items($stId,$CVS);

                        }

                        echo json_encode(['success'=>'Storyline has been save successfully.']);
                  break;
                    default:

                }

    }

    /**
     * @param $storyline
     * @param $CVS
     */
    public function save_storyline_items($storyline, $CVS) {
        $item = new StorylineItem;
        //$storyline_id = $storyline->id;
        $item->currentStoryLine($storyline->id);
        $item->buildTree($CVS);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeContent(Request $request){
        if($request->ajax()) {

            if($request->get('file_name')) {
                $page = public_path() . '/EON/system/public/vendor/storyline/core/files/content/' . $this->new_file_request($request) . '.html';
                $file = fopen($page, "w");
                fwrite($file, json_decode($request->get('data')));
                fclose($file);
                $results_array =    ['message'=>'success','data'=>$page];
                echo json_encode($results_array);
            }else{
                $results_array = ['message'=>'error'];
                echo json_encode($results_array);
            }

        }
    }

    /**
     * @param $request
     * @return mixed
     *
     */
    protected function new_file_request($request) {
        $file_name = $request->get('file_name');
        if (str_word_count($file_name) > 1) {
            $new_file_name = preg_replace('/\s+/', '_', $file_name);
            return $new_file_name;
        } else {
            return $file_name;
        }
    }

}