<?php

namespace EONConsulting\Student\Progression\Http\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use Illuminate\Http\Request;
use EONConsulting\Storyline2\Models\Storyline;
use EONConsulting\Storyline2\Models\StorylineItem;
use App\Models\StudentProgress;
use GuzzleHttp\Client;

class DefaultController extends LTIBaseController {
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function copyleaks(Request $request) {
        $client = new Client();
        $cert = base_path() . '/vendor/guzzlehttp/guzzle/src/cacert.pem';
        $text = $request->get('data');
        $login = $client->request('POST', 'https://api.copyleaks.com/v1/account/login-api', [
            'verify' => false,
            'form_params' => [
                'Email' => 'reggiest.ain@gmail.com',
                'ApiKey' => '91FEFB7C-68B4-447B-A08D-8064F75A6EC0'
            ]
        ]);

        if ($login->getStatusCode() == 200) {
            $body = $login->getBody()->getContents();
            $data = json_decode($body);
            $result = $this->createByText($data,$text);
            $msg = 'true';
            $success = $result;
            
        } else {
            $msg = 'false';
            $success = 'error';
        }
        
        $response = array(
            'msg' => $msg,
            'success' => $success
        );

        return \Response::json($response);
    }
    
    /**
     * 
     * @param type $data
     * @param type $text
     * @return string
     */
    public function createByText($data,$text){
        $client = new Client(['base_uri' => 'https://api.copyleaks.com']);
        $token = $data->access_token;      
        $process = $client->request('POST', '/v1/education/create-by-text', ['body' =>$text,                                          
                                    'verify' => false, 'headers' =>['Content-Type' =>'application/json',
                                    'Authorization' => ['Bearer ' . $token]]
                                                                       
            ]);
        
        if ($process->getStatusCode() == 200) {
            $body = $process->getBody()->getContents();
            $data = json_decode($body); 
            sleep(20);
            $result = $this->result($data,$token);
            return $result;
        } else {
            return 'false';
        }           
    }
    
    /**
     * 
     * @param type $data
     * @param type $token
     * @return string
     */
    public function result($data,$token){        
        $client = new Client();
        //$cert = base_path() . '/vendor/guzzlehttp/guzzle/src/cacert.pem';
        $result = $client->request('GET', 'https://api.copyleaks.com/v1/education/'.$data->ProcessId.'/result', [
                    'verify' => false, 'headers' =>[
                    'Content-Type' =>'application/json',
                    'Authorization' => 'Bearer ' . $token]               
            ]);
        
        if ($result->getStatusCode() == 200) {
            $body = $result->getBody()->getContents();
            $data = json_decode($body);
            if(empty($data)){
                $data = 'Content was Successfully scanned, no matches found.';
             }else{                
                $data = "<div class='alert alert-success'><strong>Content was Successfully scanned</strong> </div><br><b>Suspected Website :</b><a href=".$data[0]->URL." target='_blank'>".$data[0]->URL."</a><br>"
                        . '<b>Result Title :</b>'.$data[0]->Title.'<br>'
                        . '<b>Number Of Copied Words :</b>'.$data[0]->NumberOfCopiedWords.'<br>'
                        //. '<b>Introduction :</b>'.$data[0]->Introduction.'<br>'
                        . "<b>Comparison Report :</b> <a href=".$data[0]->ComparisonReport.">".$data[0]->ComparisonReport."</a>";
                                
                return $data;
                        
             }
            return $data;       
        } else {
           return 'false'; 
        }            
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function storeProgress(Request $request) {
        $progress = StudentProgress::where([['student_id', $request->get('student')],
                    ['storyline_id', $request->get('storyline')]])->first();

        $visited = implode(",", [$request->get('id')]);

        if ($progress == NULL) {
            $StudentProgress = new StudentProgress([
                'student_id' => $request->get('student'),
                'storyline_id' => $request->get('storyline'),
                //'storyline_item_id' => $request->get('id'),
                'visited' => $visited
            ]);

            if ($StudentProgress->save()) {
                $msg = 'saved';
            } else {
                $msg = 'not saved';
            }
        } else {
            $visited = explode(',', $progress->visited);
            if (in_array($request->get('id'), $visited)) {
                 $msg = 'visited';
            } else {

                $visited = [$progress->visited, $request->get('id')];
                $commaList = implode(',', $visited);
                $progress = StudentProgress::where([['student_id', $request->get('student')],
                            ['storyline_id', $request->get('storyline')]])
                        ->update(['visited' => $commaList]);

                $msg = 'updated';
            }
        }

        $response = array(
            'msg' => $msg
        );

        return \Response::json($response);
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function storeProg(Request $request) {
        $StudentProgress = new StudentProgress();
        $StorylineItem = new StorylineItem();
        $progress = $StudentProgress::whereStudentId($request->get('student'))->first();
        if (!empty($progress->id)) {
            $ItemArray = $this->topics($StorylineItem, $request->get('storyline'));
            $current = $this->save_progress($StudentProgress, $request->get('id'), $progress->id, $ItemArray);
            $StorylineItem = $StudentProgress::find($progress->id);
            if ($current === 'true') {
                $message = 'true';
                $story = $progress->furthest;
            } elseif ($current === 'current') {
                $message = 'true';
                $story = $StorylineItem->current;
            } elseif ($current === 'false') {
                $message = 'error';
                $story = $StorylineItem->furthest;
            } else {
                $message = 'error';
                $story = $StorylineItem->furthest;
            }
        } else {
            $ItemArray = $this->topics($request->get('storyline'));
            $ItemId = $this->save($StudentProgress, $StorylineItem, $request, $ItemArray);
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
    public function save_progress($StudentProgress, $current, $progressId, $ItemArray) {

        $Progress = $StudentProgress::find($progressId);
        $currentIndex = array_search($current, $ItemArray);
        $furthestIndex = array_search($ItemArray[$Progress->furthest], $ItemArray);
        //$array = array_diff($ItemArray, [$Progress->root,$Progress->current,$Progress->furthest]);
        //dd($currentIndex,$furthestIndex);
        if ($currentIndex > $furthestIndex) {
            return 'false';
        } elseif ($currentIndex == $furthestIndex) {
            $Progress->current = $Progress->furthest;
            end($ItemArray);
            $lastIndex = key($ItemArray);
            if ($lastIndex === $furthestIndex) {
                $Progress->furthest = $furthestIndex;
            } else {
                $Progress->furthest = $furthestIndex + 1;
            }
            $Progress->save();
            return 'current';
        } elseif ($currentIndex < $furthestIndex) {
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
        $StudentProgress->root = $Index;
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

        return $children;
    }

    public function topicView($item, $course) {
        $Items = StorylineItem::where('required', $item)->first();
        if ($Items) {
            $ItemId = $Items->id;
        } else {
            $ItemId = 0;
        }

        $progress = StudentProgress::where([['storyline_item_id', $ItemId], ['student_id', auth()->user()->id]])->first();

        if (!empty($Items) && empty($progress)) {
            $StudentProgress = new StudentProgress([
                'student_id' => auth()->user()->id,
                'storyline_item_id' => $Items->id,
                'course_id' => $course,
                'storyline_id' => $Items->storyline_id
            ]);

            if ($StudentProgress->save()) {
                $msg = 'true';
            } else {
                $msg = 'false';
            }
        } else {
            $msg = 'true';
        }
        $response = array(
            'msg' => $msg,
        );
        return \Response::json($response);
    }

    public function nextView($item) {
        $Items = StorylineItem::find($item);
        if (!empty($Items->required)) {
            $progress = StudentProgress::where([['storyline_item_id', $item], ['student_id', auth()->user()->id]])->first();
            if (!empty($progress)) {
                $msg = 'true';
            } else {
                $msg = 'false';
            }
        } else {
            $msg = 'true';
        }

        $response = array(
            'msg' => $msg,
        );

        return \Response::json($response);
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
    public function compare($a, $b) {
        if ($a['lft'] == $b['lft']) {
            return 0;
        }
        return ($a['lft'] < $b['lft']) ? -1 : 1;
    }

}
