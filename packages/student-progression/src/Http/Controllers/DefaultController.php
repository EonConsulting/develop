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
     * 
     * @param Request $request
     * @return type
     */
    public function storeProgress(Request $request) {
        $StudentProgress = new StudentProgress();
        $StorylineItem = new StorylineItem();
        $progress = $StudentProgress::whereStudentId($request->get('student'))->first();
        if (!empty($progress->id)) {
            $ItemArray = $this->topics($StorylineItem, $progress->root);
            $current = $this->save_progress($StudentProgress, $request->get('id'),$progress->id,$ItemArray);
            $StorylineItem = $StudentProgress::find($progress->id);
            if($current === 'true'){
                $message = 'true';                
                $story = $request->get('id');
            }elseif($current === 'current'){
                $message = 'true';
                $story = $StorylineItem->current;
            }else{
                $message = 'error';
                $story = $StorylineItem->furthest;
            }
            
        } else {
            $ItemId = $this->save($StudentProgress, $request);
            $progress = $StudentProgress::find($ItemId);
            $ItemArray = $this->topics($StorylineItem, $progress->root);
            $furthest = $ItemArray[0];
            $progress->furthest = $furthest;
            $progress->save();
            $message = 'false';
            $story = $ItemId;
        }

        $response = array(
            'msg' => $message,
            'story' => $story,
        );

        return \Response::json($response);
    }

    /**
     * 
     * @param type $StudentProgress
     * @param type $current
     * @param type $progressId
     * @param type $ItemArray
     * @return string
     */
    public function save_progress($StudentProgress, $current,$progressId,$ItemArray) {        
        $Progress = $StudentProgress::find($progressId);
        $currentIndex = array_search($current, $ItemArray);
        $furthestIndex = array_search($Progress->furthest, $ItemArray);
        $array = array_diff($ItemArray, [$Progress->root,$Progress->current,$Progress->furthest]);
        if ($currentIndex > $furthestIndex) {
            return 'false';
        } elseif($currentIndex == $furthestIndex){ 
            $Progress->current = $Progress->furthest;
            $Progress->furthest = $ItemArray[$furthestIndex+1];
            $Progress->save();
            return 'current';
        }elseif($currentIndex < $furthestIndex){
         return 'true';   
        }
    }

    /**
     * 
     * @param type $StudentProgress
     * @param type $request
     * @return type
     */
    public function save($StudentProgress, $request) {
        $StorylineItem = StorylineItem::whereId($request->get('id'))->first();
        $StudentProgress->student_id = (int) $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_id = (int) $request->get('storyline');
        $StudentProgress->furthest = (int) $StorylineItem->id;
        $StudentProgress->current = (int) $StorylineItem->id;
        $StudentProgress->root = (int) $StorylineItem->id;
        if ($StudentProgress->save()) {
            return $StudentProgress->id;
        }
    }

    /**
     * 
     * @param type $StorylineItem
     * @param type $storylineId
     * @return type
     */
    public function topics($StorylineItem, $storylineId) {
        $Item = $StorylineItem::whereId($storylineId)->first();

        foreach ($Item->getDescendantsAndSelf() as $descendant) {
            $children[] = $descendant->id;
        }
        return $children;
    }

}
