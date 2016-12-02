<?php namespace Unisa\Storycore;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }
    public function registerFormWidgets(){
    	return [
    		'Unisa\Storycore\FormWidgets\PageBox'=>[
    			'label'=>'PageBox Field',
    			'code'=>'pagebox'
    		]
    	];
    }
}
