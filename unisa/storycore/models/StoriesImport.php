<?php namespace Unisa\Storycore\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Unisa\Pages\Models\Page;
use BackendAuth;

use Model;

/**
 * Model
 */
class StoriesImport extends \Backend\Models\ImportModel
{
    protected $rules = [];
    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {
            $pageArr = array();
            $storyData = ['story_name'=>trim($data['story_name']), 'description'=>$data['description'], 'user_id'=>BackendAuth::getUser()->id];
           // print_r($storyData);die;
            try {
                $story = Storycore::where('story_name', trim($data['story_name']))->where('user_id', BackendAuth::getUser()->id)->firstOrFail();
                $story->fill($storyData);
                $story->save();
                $this->logUpdated();

                //$story->pages()->detach();
            }
            catch (ModelNotFoundException $ex) {
                $story = new Storycore;
                $story->fill($storyData);
                $story->save();
                $this->logCreated();
            }
            catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }

            if($data['pages'] != ''){
                $pageNames = explode(',', $data['pages']);
                foreach ($pageNames as $page) {
                    $pg = Page::firstOrCreate(['page_name' => trim($page), 'user_id'=>BackendAuth::getUser()->id]);
                    $pageArr[] = $pg->id;
                }
                $story->pages()->sync($pageArr);
            }
        }
    }
    public function getCityOptions($keyValue = null) {
        return ['New-York' => 'New-York','Los Angeles'=>'Los Angeles'];
    }
}