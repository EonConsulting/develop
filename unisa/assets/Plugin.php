<?php namespace Unisa\Assets;

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

    public function boot(){
        Event::listen('eloquent.deleting: Unisa\Assets\Models\Asset', function ($record) {
            $file = 'assets/'.BackendAuth::getUser()->id.'/'.$record->id.'.htm';
            if(file_exists($file)){
                unlink($file);
            }
        });
    }
}
