<?php namespace Unisa\Pages\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use ApplicationException;
use BackendMenu;
use BackendAuth;
use Input;
use Db;

class Pages extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController', 'Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'pages.manage_pages' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Pages', 'pages', 'manage_pages');
    }

    /**
     * Ajax handle to show the preview of selected assets on form
     * @return [type] [description]
     */
    public function onPreview(){
        $assets = Input::get('pages');
        $frames = '';
        if(!empty($assets)){
            $files = Asset::find($assets)->lists('file_name');
            foreach ($files as $key => $value) {
                $file = 'assets/'.BackendAuth::getUser()->id.'/'.$value.'.htm';
                if(file_exists($file)){
                    $frames .= file_get_contents($file);
                    // '<iframe class="asset-frames" src="'.url('/assets/'.$value.'.htm').'"></iframe>';

                }
            }
        }
        return ['assets'=>$frames];

    }

    /**
     * adds the extra fields before creating the form
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }

    /**
     * applies query search filters if passed
     * @param  Object $query database query object
     * @return void        
     */
    public function listExtendQueryBefore($query){

        /*$user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);*/
    }

    /**
     * checking whether Page name is already exist
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public function formBeforeSave($model){
        $attributes = Input::get('Page');
        if($model->id){
            $rec = Db::table($model->table)->where('page_name', '=', $attributes['page_name'])->where('id', '!=', $model->id)->pluck('page_name');
        }
        else{     
            $rec = Db::table($model->table)->where('page_name', $attributes['page_name'])->pluck('page_name');
        }
        if($rec){
            throw new ApplicationException('Page name already exists Please provide different one.');
        }
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

    /**
     * Creating html page file to add content of selected assets
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public function formAfterSave($model =null){
        $assetArr = array();
        $dirPath = 'assets/'.BackendAuth::getUser()->id.'/';
        foreach ($model->assets as $key => $asset) {
            $assetArr[] = $asset->file_name.'.htm';
        }
        $this->generatePage($assetArr, $model->id, $dirPath);
    }

    /**
     * Generates htm page from the collection of selected assets.
     * @param  array   $assetArr array selected asset Ids
     * @param  integer $pageId   Id of the page 
     * @param  string  $dirPath  Directory path to fetch assets.
     * @return void            
     */
    protected function generatePage($assetArr = array(), $pageId=0, $dirPath=''){
        if(!empty($assetArr) && $pageId >0){
            $pageContent = '';
            foreach ($assetArr as $asset) {
                if(file_exists($dirPath.$asset)){
                    $pageContent .= file_get_contents($dirPath.$asset);
                }
            }
            $path = 'assets/'.BackendAuth::getUser()->id.'/pages';
            if(!is_dir($path)){
                mkdir($path, 0777, true);
            }
            file_put_contents($path.'/'.$pageId.'.htm', $pageContent);
        }
    }
}