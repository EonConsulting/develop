<?php namespace Unisa\Taxonomy;

use System\Classes\PluginBase;

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

    public function registerFormWidgets(){
    	return [
    		'Unisa\Taxonomy\FormWidgets\StoryBox'=>[
    			'label'=>'StoryBox Field',
    			'code'=>'storybox'
    		]
    	];
    }
}
