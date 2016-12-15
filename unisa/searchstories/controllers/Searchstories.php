<?php namespace Unisa\Searchstories\Controllers;

use Backend\Classes\Controller;
use Unisa\Storycore\Models\Storycore;
use Backend;
use BackendMenu;
use BackendAuth;
use Input;
use Redirect;
use Flash;
use Event;

class Searchstories extends Controller
{
    public $implement = ['Backend\Behaviors\ListController',];
    
    public $requiredPermissions = [
        'stories.search_stories' 
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Searchstories', 'search_stories', 'sub_search_story');
        $this->vars['filters'] = (is_array(Input::get('chr')) ? array_filter(Input::get('chr')) : array());
    }

    /**
     * adds the additional parameters to query before execute
     * @param  Object $query Database query object
     * @return void        
     */
    public function listExtendQueryBefore($query){
        foreach ($this->vars['filters'] as $value) {
            if($value != ''){
                $query->orWhere('story_name', 'like', "%{$value}%");
                $query->orWhere('description', 'like', "%{$value}%");
            }
        }  
        /*$user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);*/
    }

    /**
     * extends custom column to list
     * @param  Object $list list object
     * @return [type]       [description]
     */
    public function listExtendColumns($list){

        $list->addColumns([
            'action' => [
                'label'     => 'Action',
                'sortable'  => false,
                'searchable'=> false,
                'type'      => 'partial',
                'path'      => '$/unisa/searchstories/controllers/searchstories/_action_column.htm',
                'cssClass'  => 'nolink'
            ]
        ]);
    }

    /**
     * Copies the database record and redirects to update mode
     * @return [type] [description]
     */
    public function onClone(){
        $storyId = Input::get('story');
        $story = Storycore::find($storyId);

        if($story){
            $newStory = $story->replicate();
            $newStory->save();

            $newStory->pages()->sync($story->pages);
            Event::fire('Storycore.formAfterSave', [$newStory]);
            
            return Redirect::to(Backend::url("unisa\storycore\storycore\update", $newStory->id));

        }else{
            Flash::error('Something went wrong Please try again.');
        }
    }
}