<?php namespace Unisa\Assets\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;
use Input;
use ApplicationException;
use Db;

class Assets extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'assets.manage_assets' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Assets', 'assets', 'manage_assets');
    }
    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }

    public function listExtendQueryBefore($query){
        $user_id = BackendAuth::getUser()->id;

        $query->where('user_id', '=', $user_id);
    }
    public function formBeforeSave($model){
        $attributes = Input::get('Assets');
        $rec = Db::table($model->table)->where('asset_name', $attributes['asset_name'])->pluck('asset_name');
        if($rec != ''){
            throw new ApplicationException('Asset Name already exists Please provide different one.');
        }
    }
    public function formAfterSave($model =null){
        $attributes = $model->attributes;
        if($attributes['is_published']){
            $dir = 'assets';
            if(!is_dir($dir)){
                mkdir($dir);
            }
            $ext = '.htm';
            $file = $dir.'/'.$attributes['file_name'].$ext;
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
            file_put_contents($file,$attributes['content']);
        }
        
    }
}