<?php namespace Unisa\Pages;

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
}
