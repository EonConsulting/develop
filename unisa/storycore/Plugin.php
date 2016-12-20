<?php namespace Unisa\Storycore;

use System\Classes\PluginBase;
use Event;

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

    public function boot(){
        Event::listen('eloquent.deleting: Unisa\Storycore\Models\Storycore', function ($record) {
            $file = 'assets/'.$record->id.'.xml';
            if(file_exists($file)){
                unlink($file);
            }
        });
    }
}
