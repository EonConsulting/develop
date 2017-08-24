<?php

namespace EONConsulting\Student\Progression\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Storyline;
use App\Models\StorylineItem;
use App\Models\StudentProgress;

//use EONConsulting\Storyline\Table\Csv;

class DefaultController extends LTIBaseController {

    /**
     * @param Request $request
     */
    public function storeData(Request $request) {
        $StudentProgress = new StudentProgress();
        $StudentProgress->student =  $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course_id');
        $StudentProgress->storyline_item_id = (int) $request->get('topic');
    if($StudentProgress->save()){
        echo "yeeeeeee";
      }else{
          echo "naaaaaaaaaa";
      }
        exit();
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
    public function storeContent(Request $request) {
        if ($request->ajax()) {

            if ($request->get('file_name')) {
                $page = public_path() . '/EON/system/public/vendor/storyline/core/files/content/' . $this->new_file_request($request) . '.html';
                $file = fopen($page, "w");
                fwrite($file, json_decode($request->get('data')));
                fclose($file);
                $results_array = ['message' => 'success', 'data' => $page];
                echo json_encode($results_array);
            } else {
                $results_array = ['message' => 'error'];
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
