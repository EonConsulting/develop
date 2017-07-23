<?php
namespace EONConsulting\File\Reader\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use EONConsulting\File\Reader\Csv;

class DefaultController extends LTIBaseController {

    public function getFileuploadView($course,$filetype) {

        return view('fileupload::csvfileupload',['course'=>$course,'filetype'=>$filetype]);
    }

    public function storeStoryline(Request $request, Course $course){

        if (empty($_FILES['csv']))
            echo json_encode(['error'=>'No files found for upload.']);

            if($typ =$request["filetype"])
                 switch ($typ) {
                    case "csv":
                        $Read = new Csv($_FILES['csv']['tmp_name']);
                         $handler = $Read->open(",",'"');
                          $data = $Read->readAll();
                          foreach ($data[1] as $value) {
                                  $array[] = ['name' => $value,'file_url' => '', 'file_name' => '','children' => []];

                            }
                         $Read->close();
                        $CVS = [
                            ['name'=>$course->title,'file_url' => '', 'file_name' => '','parent_id'=>null, 'children' => $array]
                        ];

                        $stId = Storyline::where('course_id', '=', $course->id)->first();

                        //dd($stId);
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

    public function save_storyline_items($storyline, $CVS) {
        $item = new StorylineItem;
        //$storyline_id = $storyline->id;
        $item->currentStoryLine($storyline->id);
        $item->buildTree($CVS);
    }

}