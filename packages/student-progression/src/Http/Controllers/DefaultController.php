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
            $storylineItemId = $progress->storyline_item_id;
            $topicArray = $this->topics($StorylineItem, $progress->storyline_id);
            ksort($topicArray);
            $key = array_search($storylineItemId, $topicArray);
            $URL = $StorylineItem::whereId($topicArray[$key])->first();
            $plusOneURL = $StorylineItem::whereId($topicArray[$key + 1])->first();
            $fileURL  = $this->check_level($request->get('id'),$topicArray[$key + 1],$URL,$plusOneURL);
            $message = 'true';
            $story   =  $fileURL;
        } else {
            $this->save_progress($request,$StudentProgress);            
            $message = 'false';
            $story = $request->get('storyline');
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
    public function save_progress($request, $StudentProgress) {
        $StudentProgress->student = $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_item_id = (int) $request->get('id');
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

    public function check_level($level,$plusOne,$URL,$plusOneURL) {
        if ($level > $plusOne) {
            return $URL->id;
        } else {
            return $plusOneURL->id;
        }
    }

}
