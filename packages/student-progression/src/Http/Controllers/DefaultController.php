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
    public function storeProgress(Request $request) {
        
        $StudentProgress = new StudentProgress();
        $StorylineItem = new StorylineItem();
        $progress = $StudentProgress::whereStorylineItemId($request->get('storyline'))->first();
        
        if($progress){
            
            $message = 'true';
            $story   = $progress->storyline_item_id;
           }else{
            $this->save_progress($request,$StudentProgress);           
            $message = 'false';
            $story   = $request->get('storyline');
          }
          
          $response = array(
            'msg' => $message,
            'story'=>$story,
          );
          
          return \Response::json($response);
    }

    /**
     * @param $storyline
     * @param $CVS
     */
    public function save_progress($request,$StudentProgress) {
           $StudentProgress->student =  $request->get('student');
           $StudentProgress->course_id = (int) $request->get('course');
           $StudentProgress->storyline_item_id = (int) $request->get('storyline');
           $StudentProgress->save();
    }
    
    /**
     * @param $storyline
     * @param $CVS
     */
    public function topics($request,$StudentProgress) {
         $StorylineItem::select('id')->where('sttoryline_id',$progress->storyline_id);  
    }

}
