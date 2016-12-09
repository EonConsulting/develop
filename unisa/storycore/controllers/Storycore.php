<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use Unisa\Pages\Models\Page;
use BackendMenu;
use Backend;
use BackendAuth;
use Db;

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
        /*$user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);*/
    }
    
    public function formAfterSave($model = null){
        //echo '<pre>';print_r($model);die;

        $strXML = '<?xml version="1.0" encoding="UTF-8" ?>'.PHP_EOL;
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
        $strXML .= '<storyline id="s0" title="'.$model['story_name'].'" config="'.$model['id'].'" link="" summary="'.$model['description'].'" img="">'.PHP_EOL.$xmlPage.'</storyline>'.PHP_EOL;        

        file_put_contents('assets/'.$xmlName, $strXML);
    }
}