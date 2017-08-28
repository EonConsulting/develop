<?php namespace Unisa\Storymenu;

use System\Classes\PluginBase;
use Unisa\Storycore\Models\Storycore as StoryModel;
use Unisa\Storymenu\Models\Storymenu as MenuModel;
use URL;
use BackendAuth;

class Plugin extends PluginBase
{
	/**
     * @var array Plugin dependencies
     */
    public $require = ['Unisa.Storycore'];

    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
		StoryModel::extend(function($model) {
            $model->bindEvent('model.afterSave', function() use ($model) {
            	$menuData = ['story_id'=>$model->id, 'menu_title'=>$model->story_name, 'page_url'=>URL::to('/'), 'description'=>$model->story_name, 'user_id'=>BackendAuth::getUser()->id];
            	$menu = MenuModel::where(['story_id'=>$model->id, 'user_id'=>BackendAuth::getUser()->id])->first();
            	if(!$menu){
            		$menu = new MenuModel;
            	}
            	$menu->fill($menuData);
            	$menu->save();	
            });
        });
    }
}
