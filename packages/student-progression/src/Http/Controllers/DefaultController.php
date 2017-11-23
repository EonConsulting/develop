<?php
namespace EONConsulting\Student\Progression\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
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
            $ItemArray = $this->topics($StorylineItem, $request->get('storyline'));
            $current = $this->save_progress($StudentProgress, $request->get('id'),$progress->id,$ItemArray);
            $StorylineItem = $StudentProgress::find($progress->id);
            if($current === 'true'){
                $message = 'true';                
                $story = $progress->furthest;
            }elseif($current === 'current'){
                $message = 'true';
                $story = $StorylineItem->current;
            }elseif($current === 'false'){
                $message = 'error';
                $story = $StorylineItem->furthest;
            }
            
            else{
                $message = 'error';
                $story = $StorylineItem->furthest;
            }
            
        } else {
            $ItemArray = $this->topics($StorylineItem, $request->get('storyline'));
            $ItemId = $this->save($StudentProgress,$StorylineItem, $request,$ItemArray);
            $progress = $StudentProgress::find($ItemId);
            
            $progress->furthest = 2;
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
        $furthestIndex = array_search($ItemArray[$Progress->furthest], $ItemArray);
        //$array = array_diff($ItemArray, [$Progress->root,$Progress->current,$Progress->furthest]);
        //dd($currentIndex,$furthestIndex);
        if ($currentIndex > $furthestIndex) {
            return 'false';
        } elseif($currentIndex == $furthestIndex){ 
            $Progress->current = $Progress->furthest;
            end($ItemArray);
            $lastIndex = key($ItemArray);
            if($lastIndex === $furthestIndex){
               $Progress->furthest = $furthestIndex; 
            }else{
            $Progress->furthest = $furthestIndex+1; 
            }
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
    public function save($StudentProgress, $StorylineItem, $request, $ItemArray) {
        $ItemId = (int) $request->get('id');     
        $Item = $StorylineItem::find($ItemId);    
        
        $StudentProgress->student_id = (int) $request->get('student');
        $StudentProgress->course_id = (int) $request->get('course');
        $StudentProgress->storyline_id = (int) $request->get('storyline');
        $Index = array_search((int) $Item->id, $ItemArray);
        $StudentProgress->furthest = $Index;
        $StudentProgress->current = $Index;
        $StudentProgress->root =  $Index;
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
        $result = $this->items_to_tree(Storyline::find($storylineId)->items);
        usort($result, [$this, "self::compare"]);
        
        foreach ($result as $descendant) {
            $children[] = $descendant['id'];           
        }
   
     return  $children;
 
    
    }
    
    public function topicView($item){
        
       $StorylineItem =  StorylineItem::where('required',$item)->update(['required' => NULL]);
         
    }
    
    /**
     *
     * @param type $items
     * @return type
     */
    public function items_to_tree($items) {

        $map = [];

        foreach ($items as $k => $node) {

            $map[] = [
                'id' => (string) $node['id'],
                'text' => $node['name'],
                'parent_id' => ($node['parent_id'] === null) ? "#" : $node['parent_id'],
                'rgt' => $node['_rgt'],
                'lft' => $node['_lft']
            ];
        }

        return $map;
    }
    
    /**
     * 
     * @param type $a
     * @param type $b
     * @return int
     */
    
    public function compare($a,$b){
        if($a['lft'] == $b['lft']){return 0;}
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

}
