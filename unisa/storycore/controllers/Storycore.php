<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use Unisa\Pages\Models\Page;
use Unisa\Storycore\Models\Storycore as StoryModel;
use BackendMenu;
use Backend;
use BackendAuth;
use Input;
use Validator;
use Redirect;
use Flash;
use ZipArchive;
use Db;
use ApplicationException;

class Storycore extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    //public $importExportConfig = 'config_import_export.yaml';
    

    public $requiredPermissions = [
        'storycore.manage_story' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Storycore', 'storycore', 'manage_storycore');
    }
    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }
    public function listExtendQueryBefore($query){
        $user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);
    }
    public function formAfterSave($model = null){
        //echo '<pre>';print_r($model);die;

        $strXML = '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL;
        $xmlStory = '';
        $xmlName = $model['id'].'.xml';
        /**
         * Creating the content to be written in xml file
         */
        
        $xmlPage='<storyline_collection>'.PHP_EOL;
        foreach ($model->pages as $key=>$page) {
            $pageDetails = Page::find($page['id']);
            $assets = Db::table('unisa_pages_page_assets')->where('page_id', $page['id'])->select('asset_id')->get();
            $xmlAsset = '';
            foreach ($assets as $asset) {
                $assetDetails = Asset::find($asset->asset_id);
                $assetFile = 'assets/'.BackendAuth::getUser()->id.'/'.$assetDetails->file_name.'.htm';
                /**
                 * Adding asset files in zip
                 */
                if(file_exists($assetFile)){
                    $xmlAsset .= $assetDetails->file_name.',';
                }
                
            }
            $xmlPage .= '<storyline id="s'.($key+1).'" type="leaf" title="'.$pageDetails->page_title.'" link="'.$pageDetails->id.'" summary="'.$pageDetails->meta_description.'" assets="'.rtrim($xmlAsset, ',').'" img=""/>'.PHP_EOL;       
        }
        $xmlPage .='</storyline_collection>'.PHP_EOL;
        $xmlStory .= '<storyline id="s0" title="'.$model['story_name'].'" config="'.$model['id'].'" link="" summary="'.$model['description'].'" img="">'.PHP_EOL.$xmlPage.'</storyline>'.PHP_EOL;        
            
        $strXML .= $xmlStory;
        file_put_contents('assets/'.$xmlName, $strXML);
    }

    /**
     * Export the selected storyline to zip file
     * @return type
     */
    public function onExport(){
        $stories = Input::get('checked');
        if(count($stories) >1){
            throw new ApplicationException('Please select maximum one storyline');
        }
        $downloadPath = 'uploads/temp_export/'.BackendAuth::getUser()->id;
        $archive_file = $downloadPath.'/'.rand(11111,99999).'.zip';
        if(!is_dir($downloadPath)){
            mkdir($downloadPath, 0777, true);
        }

        $zip = new ZipArchive;
        if ($zip->open($archive_file, ZIPARCHIVE::CREATE )) {
            $xmlName = '';
            /**
             * Creating the content to be written in xml file
             */
            foreach ($stories as $story) {
                $storyDetails = StoryModel::find($story);
                $xmlName = $storyDetails->id.'.xml';
                $pages = Db::table('unisa_storycore_story_pages')->where('storycore_id', $story)->select('page_id')->get();
                
                foreach ($pages as $key=>$page) {
                    $pageDetails = Page::find($page->page_id);
                    $assets = Db::table('unisa_pages_page_assets')->where('page_id', $page->page_id)->select('asset_id')->get();
                    $xmlAsset = '';
                    foreach ($assets as $asset) {
                        $assetDetails = Asset::find($asset->asset_id);
                        $assetFile = 'assets/'.BackendAuth::getUser()->id.'/'.$assetDetails->file_name.'.htm';

                        /**
                         * Adding asset files in zip
                         */
                        if(file_exists($assetFile)){
                            $zip->addFile($assetFile,'assets/'.$assetDetails->file_name.'.htm');
                        }
                        
                    }   
                }  
            }
            $zip->addFile('assets/'.$xmlName,$xmlName);
            $zip->close();

            /**
             * return download URL in ajax response
             */
            return (Backend::url('unisa\storycore\storycore\download?file='.basename($archive_file)));
            

        }
        //add each files of $file_name array to archive
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
        
        $file = array('imp_file' => $import);
        // setting up rules
        $rules = array('imp_file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to(Backend::url('unisa\storycore\storycore\import'))->withInput()->withErrors($validator);
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
                    return Redirect::to(Backend::url('unisa\storycore\storycore\import'));
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
                if(!file_exists($xmlFile[0])){
                    Flash::error('Please upload zip file with valid sturcture.'); 
                    return Redirect::to(Backend::url('unisa\storycore\storycore/import'));
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
                    if(($pageId = $this->manage_page($story, $assetArr))){
                        $pageArr[] = $pageId;
                    }
                }
                
                $this->manage_story($xml, $pageArr);

                /**
                 * Removing ZIP file and extracted folder after finishing import
                 */
                unlink($destinationPath.'/'.$fileName);
                $this->rrmdir($destinationPath);
                Flash::success('Storylines imported successfully.'); 
                return Redirect::to(Backend::url('unisa\storycore\storycore'));
            }
            else {
                Flash::error('uploaded file is not valid');
                return Redirect::to(Backend::url('unisa\storycore\storycore\import'));
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

    /**
     * Importing the Pages from XML file
     * @param  object $page     object of page
     * @param  array  $assetIds assets to padde in page
     * @return [type]           [description]
     */
    protected function manage_page($page, $assetIds = array()){
        $user_id = BackendAuth::getUser()->id;
        $pageData = ['page_name'=>$page['title'], 'page_title'=>$page['title'], 'meta_keyword'=>$page['title'], 'meta_description'=>$page['title'], 'user_id'=>$user_id];
        $pages = Page::where('page_title', $page['title'])->where('user_id',$user_id)->first();
        if(!$pages){
            $pages = new Page;
        }
        $pages->fill($pageData);
        $pages->save();

        $pageId = $pages->id;

        /**
         * relatively linking assets to page
         */
        $pages->assets()->sync($assetIds);
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
        $storyData = ['story_name'=>trim($story['title']), 'description'=>$story['description'], 'user_id'=>$user_id];
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
    

    /**
     * Code to 
     * @return [type] [description]
     */
    public function download(){
        $archive_file = 'uploads/temp_export/'.BackendAuth::getUser()->id.'/'.Input::get('file');
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="'.basename($archive_file).'"');
        header("Content-length: " . filesize($archive_file));
        header("Pragma: no-cache");
        header("Expires: 0");
        ob_clean();
        flush();
        readfile($archive_file);
        unlink($archive_file);
        exit;
    }
}