<?php namespace Unisa\Pages\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Asset;
use Unisa\Storycore\Models\Storycore;
use BackendMenu;
use BackendAuth;
use Input;
use Request;
use Flash;

class Pages extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
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
         $this->vars['filters'] = (is_array(Input::get('chr')) ? array_filter(Input::get('chr')) : array());
    }

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

    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }
    public function listExtendQueryBefore($query){

        foreach ($this->vars['filters'] as $value) {
            if($value != ''){
                $query->orWhere('page_name', 'like', "%{$value}%");
                $query->orWhere('page_title', 'like', "%{$value}%");
                $query->orWhere('meta_keyword', 'like', "%{$value}%");
                $query->orWhere('meta_description', 'like', "%{$value}%");
                $query->orWhere('summary', 'like', "%{$value}%");    
            }
        }   

        $user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);
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

    public function onCreatestory(){
        $storyData = array('story_name'=>Input::get('story_name'), 'description'=>Input::get('description'), 'user_id'=>BackendAuth::getUser()->id);
        $stories = new Storycore;
        $stories->fill($storyData);
        $stories->save();

        $stories->pages()->sync(Input::get('pages'));
        Flash::success('Storyline created successfully');
    }
}