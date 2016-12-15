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

    /**
     * Adds custom formwidget of select2 multiselct field
     * @return [type] [description]
     */
    public function registerFormWidgets(){
    	return [
    		'Unisa\Storycore\FormWidgets\PageBox'=>[
    			'label'=>'PageBox Field',
    			'code'=>'pagebox'
    		]
    	];
    }
}
