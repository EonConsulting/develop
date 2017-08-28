<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use Unisa\Ltiobject\Models\Ltiobject;
use Unisa\Assets\Models\Asset;
use Unisa\Pages\Models\Page;
use Unisa\Storycore\Models\Storycore as StoryModel;
use BackendMenu;
use Backend;
use BackendAuth;
use Db;
use Redirect;
use Input;

class Storycore extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
        'Unisa\Storycore\Controllers\ImportController',
        'Unisa\Storycore\Controllers\ExportController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

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

    /**
     * fucntion to call extrenal functions of same controller
     * @param  string $functionName Name of the function   
     * @param  array  $args         argument
     * @return void               
     */
    public function call_ext_func($functionName='index',$args = array())
    {
        $this->$functionName($args);
    }
    
    public function formAfterSave($model = null){
        
        $strXML = '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL;
        $xmlName = $model['id'].'.xml';
        
        /**
         * Creating the content to be written in xml file
         */
        $xmlPage='<storyline_collection>'.PHP_EOL;
        foreach ($model->pages as $key=>$page) {
            $pageDetails = Page::find($page['id']);
            $xmlAsset = '';
            foreach ($pageDetails->assets as $asset) {
                $assetDetails = Asset::find($asset->id);
                $assetFile = 'assets/'.BackendAuth::getUser()->id.'/'.$assetDetails->file_name.'.htm';
                
                /**
                 * Adding asset files in zip
                 */
                if(file_exists($assetFile)){
                    $xmlAsset .= $assetDetails->file_name.',';
                }
                
            }
            $lti = '';
            foreach ($pageDetails->ltiobject as $object) {
                $ltiDetails = Ltiobject::find($object->id);
                $lti .= $ltiDetails->object_name.',';
            }
            $img ='';
            if($pageDetails->image){
                $img = basename($pageDetails->image->getPath());
            }
            $xmlPage .= '<storyline id="s'.($key+1).'" type="leaf" name="'.$pageDetails->page_name.'" title="'.$pageDetails->page_title.'" link="'.$pageDetails->id.'" summary="'.$pageDetails->meta_description.'" assets="'.rtrim($xmlAsset, ',').'" objects="'.rtrim($lti, ',').'" img="'.$img.'"/>'.PHP_EOL;       
        }
        $xmlPage .='</storyline_collection>'.PHP_EOL;
        $strXML .= '<storyline id="s0" title="'.$model['story_name'].'" config="'.$model['id'].'" link="" summary="'.$model['description'].'" img="">'.PHP_EOL.$xmlPage.'</storyline>'.PHP_EOL;        

        file_put_contents('assets/'.$xmlName, $strXML);
    }
}