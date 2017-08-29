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

        $progress = $StudentProgress::whereStorylineItemId($request->get('id'))->first();

        if ($progress) {
            $topicArray = $this->topics($StorylineItem, $progress->storyline_id);
            ksort($topicArray);
            $key = array_search($progress->storyline_item_id, $topicArray);
            $row = $StorylineItem::whereId($topicArray[$key])->first();
            $plusRow = $StorylineItem::whereId($topicArray[$key + 1])->first();
            $storyId = $this->check_level($request->get('id'), $topicArray[$key + 1], $row, $plusRow);
            //$this->save_progress($request, $StudentProgress, $storyId);
            $message = 'true';
            $story = $storyId;
        } else {
            $record = $StudentProgress::whereStudent($request->get('student'))->orderBy('updated_at', 'desc')->first();
            $check = $this->check_record($record, $StorylineItem, $request);
            $story = $check;
            $message = 'false';
        }
        $response = array(
            'msg' => $message,
            'story' => $story,
        );

        return \Response::json($response);
    }

    /**
     * @param $storyline
     * @param $CVS
     */
    public function save_progress($request, $StudentProgress,$storylineItem) {
        $StudentProgress->student = $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_item_id = $storylineItem;
        $StudentProgress->storyline_id = (int) $request->get('storyline');
        $StudentProgress->save();
    }

    /**
     * @param $storyline
     * @param $CVS
     */
    public function topics($StorylineItem, $storylineId) {
        $query = $StorylineItem::where('storyline_id', $storylineId)->get();

        foreach ($query as $value) {
            $topic[] = $value->id;
        }
        return $topic;
    }

    public function check_level($level, $plusOne, $row, $plusStory) {
        if ($level >= $plusOne) {
            return $plusOne;
            }else if($level <= $plusOne){
            return $row->id;
           }else{
            return $row->id;  
           }
    }

    public function check_record($record, $StorylineItem, $request) {
        if ($record) {
            $topicArray = $this->topics($StorylineItem, $record->storyline_id);
            ksort($topicArray);
            $key = array_search($record->storyline_item_id, $topicArray);
            $row = $StorylineItem::whereId($topicArray[$key])->first();
            $plusRow = $StorylineItem::whereId($topicArray[$key + 1])->first();
            $storyId = $this->check_level($request->get('id'), $topicArray[$key + 1], $row, $plusRow);
            
            return $storyId;
        } else {
            return 'nothg';
        }
    }

}
