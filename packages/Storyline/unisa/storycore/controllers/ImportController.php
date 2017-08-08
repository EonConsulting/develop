<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use Unisa\Pages\Models\Page;
use Unisa\Ltiobject\Models\Ltiobject;
use Unisa\Storycore\Models\Storycore as StoryModel;
use Unisa\Storycore\Controllers\Storycore;
use Unisa\Pages\Controllers\Pages;
use System\Models\File;
use BackendMenu;
use Backend;
use BackendAuth;
use Input;
use Validator;
use Redirect;
use Flash;
use ZipArchive;
use Event;
/**
 * Import Controller Back-end Controller
 */
class ImportController extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Unisa.Storycore', 'storycore', 'importcontroller');
    }
    
    /**
     * Loads view of Import form
     * @return [type] [description]
     */
    public function import(){
        return $this->makePartial('import_form');
    }

    /**
     * Processes the import functionality
     * @return [type] [description]
     */
    public function doimport(){
        $import =  Input::file('imp_file');
        
        $user_id = BackendAuth::getUser()->id; 
        $file = array('imp_file' => $import);
        // setting up rules
        $rules = array('imp_file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            Flash::error('Please select zip file to upload');
            return Redirect::back();
        }
        else {
            // checking file is valid.
            if ($import->isValid()) {
                $destinationPath = 'uploads/temp_import/'.BackendAuth::getUser()->id; // upload path
                $extension = $import->getClientOriginalExtension(); // getting imp_file extension
              
                /**
                 * validating zip file only
                 */
                if($extension != 'zip'){
                    Flash::error('Please upload valid zip file'); 
                    return Redirect::back();
                }

                $fileName = $import->getClientOriginalName(); 
                $dir = substr($fileName, 0, -4);
                $import->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
              
                $zip = new ZipArchive;
                if($zip->open($destinationPath.'/'.$fileName)){
                    $zip->extractTo($destinationPath.'/'.$dir.'/');
                    $zip->close();
                }
                
                $dirPath = $destinationPath.'/'.$dir;
                $xmlFile = glob($dirPath.'/*.xml');
                if(empty($xmlFile) || !file_exists($xmlFile[0])){
                    Flash::error('Please upload zip file with valid sturcture.'); 
                    return Redirect::back();
                }
                $feed = file_get_contents($xmlFile[0]);
                $xml = simplexml_load_string($feed);
                //$xml = simplexml_load_file($destinationPath.'/'.$dir.'/storylines.xml'); 
                
                /**
                 * Fetching data from XML file and importing accordingly
                 */
                $pageArr = array();
                foreach ($xml->storyline_collection->storyline as $story) {
                    $assets = ($story['assets'] != '' ? explode(',', $story['assets']) : array());
                    $assetArr = array();
                    foreach ($assets as $asset) {
                        if(($assetId = $this->manage_asset($asset, $dirPath.'/assets')));
                        {
                            $assetArr[] = $assetId;
                        }

                    }
                    $ltis = ($story['objects'] != '' ? explode(',', $story['objects']) : array());
                    $ltiArr = array();
                    foreach ($ltis as $lti) {
                        if(($ltiId = $this->manage_lti($lti, $dirPath.'/objects'))){
                            $ltiArr[] = $ltiId;
                        }
                    }
                    if(($pageId = $this->manage_page($story, $assetArr, $ltiArr, $dirPath.'/images'))){
                        $pageArr[] = $pageId;
                    }

                }
                
                $this->manage_story($xml, $pageArr);
                //rename($xmlFile[0], 'assets/'.basename($xmlFile[0]));

                /**
                 * Removing ZIP file and extracted folder after finishing import
                 */
                unlink($destinationPath.'/'.$fileName);
                $this->rrmdir($dirPath);
                Flash::success('Storylines imported successfully.'); 
                return Redirect::back();
            }
            else {
                Flash::error('uploaded file is not valid');
                return Redirect::back();
            }
        }   
    }
    
    /**
     * importing assets
     * @param  array  $asset     array of assets to be imported
     * @param  string $assetPath temp path of extracted asset directory
     * @return int            asset from database table
     */
    protected function manage_asset($asset =array(), $assetPath =''){
        $user_id = BackendAuth::getUser()->id;
        $assetId = 0;
        $assetFile = $assetPath.'/'.$asset.'.htm';

        /**
         * process further if asset file is exist
         */
        if(file_exists($assetFile)){
            $assetInfo = pathinfo($assetFile);
            $content = file_get_contents($assetFile);
            $assetData = ['asset_name'=>$asset, 'file_name'=>$assetInfo['filename'], 'description'=>$assetInfo['filename'], 'content'=>$content, 'user_id'=>$user_id, 'is_published'=>1];
            $assets = Asset::where('user_id',$user_id)->where('file_name', $asset)->first();
            if(!$assets){
                $assets = new Asset;
            }
            $assets->fill($assetData);
            $assets->save();

            $assetId = $assets->id;

            /**
             * performing the version control of assets if there is already exist
             * @var string
             */
            $dir = 'assets/'.$user_id;
            if(!is_dir($dir)){
                mkdir($dir, 0777, true);
            }
            $file = $dir.'/'.$asset.'.htm';
            if(file_exists($file)){
                $flag = false;
                $i = 1;
                $pathinfo = pathinfo($file);
                while(!$flag){
                    $dir_temp = $dir.'/old_assets';
                    if(!is_dir($dir_temp)){
                        mkdir($dir_temp);
                    }
                    $newfile = $dir_temp.'/'.$pathinfo['filename'].'_v'.$i.'.'.$pathinfo['extension'];
                    if(!file_exists($newfile)){
                        rename($file, $newfile);
                        $flag = true;
                    }else{
                        $i++;
                    }
                }
            }
            rename($assetFile, $file);
            
           
        }
        return $assetId;
    }

    protected function manage_lti($lti = '', $objPath=''){
        $user_id = BackendAuth::getUser()->id;
        $ltiId = 0;
        $objFile = $objPath.'/'.$lti.'.htm';

        if(file_exists($objFile)){
            $assetInfo = pathinfo($objFile);
            $content = explode('===', file_get_contents($objFile));
            if(count($content) >=4){
                $ltiData = ['object_name'=>$lti, 'description'=>$lti, 'endpoint_url'=>$content[1], 'launcher_url'=>$content[0], 'key'=>$content[2], 'secret'=>$content[3], 'user_id'=>$user_id];
                $LTIObj = Ltiobject::where('user_id',$user_id)->where('object_name', $lti)->first();
            }
            
            if(!$LTIObj){
                $LTIObj = new Ltiobject;
            }
            $LTIObj->fill($ltiData);
            $LTIObj->save();

            $ltiId = $LTIObj->id;            
           
        }
        return $ltiId;

    }

    /**
     * Importing the Pages from XML file
     * @param  object $page     object of page
     * @param  array  $assetIds assets to padde in page
     * @return [type]           [description]
     */
    protected function manage_page($page, $assetIds = array(), $ltiIds = array(), $imgPath = ''){
        $user_id = BackendAuth::getUser()->id;
        $pageData = ['page_name'=>$page['name'], 'page_title'=>$page['title'], 'meta_keyword'=>$page['title'], 'meta_description'=>$page['title'], 'user_id'=>$user_id];
        $pages = Page::where('page_name', $page['name'])->where('user_id',$user_id)->first();
        if(!$pages){
            $pages = new Page;
        }
        $pages->fill($pageData);
        $pages->save();
        if($page['img'] != ''){
            $imgFile = $imgPath.'/'.$page['img'] ;
            
            if(file_exists($imgFile)){
                $pages->image()->create(['data' => $imgFile]);
            }
        }
        $pageId = $pages->id;

        /**
         * relatively linking assets to page
         */
        $pages->assets()->sync($assetIds);
        $pages->ltiobject()->sync($ltiIds);

        $pageController = new Pages;
        $pageController->call_ext_func('formAfterSave',$pages);
       // Event::fire('Pages.formAfterSave', [$pages]);

        return $pageId;
    }

    /**
     * Importing stories from XML file
     * @param  object  $story   array of stories
     * @param  array  $pageArr array of pages to be linked to storyline
     * @return [type]          [description]
     */
    protected function manage_story($story = array(), $pageArr = array()){
        $user_id = BackendAuth::getUser()->id;
        $storyData = ['story_name'=>trim($story['title']), 'description'=>$story['summary'], 'user_id'=>$user_id];
        $stories = StoryModel::where('story_name', trim($story['title']))->where('user_id', $user_id)->first();
        if(!$stories){
            $stories = new StoryModel;
        }
        $stories->fill($storyData);
        $stories->save();
        
        /**
         * relatively linking pages to assets
         */
        $stories->pages()->sync($pageArr);

        $storyController = new Storycore;
        $storyController->call_ext_func('formAfterSave',$stories);

 //     Event::fire('unisa.storycore.formAfterSave', [$stories]);
    }

    /**
     * UDF to recursively delete temp directory
     * @param  String $dir DirectoryPath
     * @return void      [description]
     */
    public function rrmdir($dir) { 
        if (is_dir($dir)) { 
            $objects = scandir($dir); 
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (is_dir($dir."/".$object))
                        $this->rrmdir($dir."/".$object);
                    else
                    unlink($dir."/".$object); 
                } 
            }
            rmdir($dir); 
        } 
    }
}