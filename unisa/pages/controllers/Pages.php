<?php namespace Unisa\Pages\Controllers;

use Backend\Classes\Controller;
use Unisa\Assets\Models\Assets;
use BackendMenu;
use BackendAuth;
use Input;
use Request;

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
    }
    public function onPreview(){
        $assets = Input::get('pages');
        $frames = '';
        if(!empty($assets)){
            $files = Assets::find($assets)->lists('file_name');
            foreach ($files as $key => $value) {
                if(file_exists('assets/'.$value.'.htm')){
                    $frames .= file_get_contents('assets/'.$value.'.htm');
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
        $user_id = BackendAuth::getUser()->id;

        $query->where('user_id', '=', $user_id);
    }
}