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
        //$progress = $StudentProgress::whereStorylineItemId($request->get('id'))->first();
        $progress = $StudentProgress::whereStudentId($request->get('student'))->orderBy('id', 'asc')->first();
        if ($progress) {
            //$level = $this->check_level($StudentProgress,$request);           
            $topicArray = $this->topics($StorylineItem, $progress->storyline_item_id);
            $array = array_diff($topicArray, [$progress->storyline_item_id,$request->get('id')]);    
            $id = array_shift($array);   
            $id = $this->save_progress($request,$StudentProgress,$id);
            //$progress = $StudentProgress::whereStorylineItemId($request->get('id'))->first();
            
            $story = $id; 
            
            $message = 'true';
    
        } else {
            $status = $this->save($StudentProgress, $request);
            if ($status) {
                $record = $StudentProgress::find($status)->first();
                $check = $this->check_record($record, $StorylineItem, $request, $StudentProgress);
                $message = 'false';
                $story = $check;
            } else {
                $message = 'false';
                $story = 'null';
            }
        }

        $response = array(
            'msg' => $message,
            'story' => $story,
        );

        return \Response::json($response);
    }

    /**
     * 
     * @param type $request
     * @param type $StudentProgress
     * @param type $storylineItem
     */
    public function save_progress($request, $StudentProgress, $storylineItem) {
        $level = $this->check_level($StudentProgress, $storylineItem);
        if($level){
        return $storylineItem;
        }else{
        $StudentProgress->student_id = (int) $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_item_id = $storylineItem;
        $StudentProgress->storyline_id = (int) $request->get('storyline');
        if($StudentProgress->save()){
            return $StudentProgress->toryline_item_id;
        } 
        }
    }

    public function save($StudentProgress, $request) {
        $StorylineItem = StorylineItem::whereId($request->get('id'))->first();
        $StudentProgress->student_id = (int) $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_id = (int) $request->get('storyline');
        $StudentProgress->storyline_item_id = (int) $StorylineItem->id;       
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

    /**
     * 
     * @param type $level
     * @param type $plusOne
     * @param type $row
     * @param type $request
     * @param type $StudentProgress
     * @param type $storyId
     * @return type
     */
    public function check_level($StudentProgress,$id) {
        $progress = $StudentProgress::whereStorylineItemId($id)->first();
        
        return $progress;
    }

    /**
     * 
     * @param type $record
     * @param type $StorylineItem
     * @param type $request
     * @param type $StudentProgress
     * @return string
     */
    public function check_record($record, $StorylineItem, $request, $StudentProgress) {
        if ($record) {
            $topicArray = $this->topics($StorylineItem, $record->storyline_item_id);
            //dd($topicArray[0]);
            //$this->save_progress($request, $StudentProgress, $topicArray[0]);

            return $topicArray[0];
        }
    }

}
