<?php namespace Unisa\Storycore\Models;
use BackendAuth;

/**
 * Model
 */
class StoriesExport extends \Backend\Models\ExportModel {
    public function exportData($columns, $sessionKey = null) {
        $stories = Storycore::with([
        	'pages'=>function($query){$query->addSelect(['page_name']);}
        ])->where('user_id', BackendAuth::getUser()->id)->get();
        $stories->each(function($subscriber) use ($columns) {
        	//print_r($columns);die;
            $subscriber->addVisible($columns);
        });
        $collection = collect($stories->toArray());
        $data = $collection->map(function ($item) {
            if(is_array($item)){
                foreach($item as $key => $value) {
                    if(is_array($value)) {
                    	if($key == 'pages'){
                    		$item[$key] = implode(', ', array_column($value, 'page_name'));
                    	}else{
                    		$item[$key] = json_encode($value);
                    	}
                    }
                }
            }
            return $item;
        });

        return $data->toArray();
    }
}