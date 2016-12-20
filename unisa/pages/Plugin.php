<?php namespace Unisa\Pages;

use System\Classes\PluginBase;
use Event;
use BackendAuth;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    /**
     * Custom formwidgets added to the plugin
     * @return void 
     */
    public function registerFormWidgets(){
    	return [
    		'Unisa\Pages\FormWidgets\AssetBox'=>[
    			'label'=>'AssetBox Field',
    			'code'=>'assetbox'
    		],
            'Unisa\Pages\FormWidgets\PreviewBox'=>[
                'label'=>'Asset Preivew',
                'code'=>'previewbox'
            ],
            'Unisa\Pages\FormWidgets\LtiBox'=>[
                'label'=>'LTI Object',
                'code'=>'ltibox'
            ]
    	];
    }

    public function boot(){
        Event::listen('eloquent.deleting: Unisa\Pages\Models\Page', function ($record) {
            $file = 'assets/'.BackendAuth::getUser()->id.'/pages/'.$record->id.'.htm';
            if(file_exists($file)){
                unlink($file);
            }
        });
    }
}
