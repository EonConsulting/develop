<?php namespace Unisa\Searchpages\Controllers;

use Backend\Classes\Controller;
use Unisa\Storycore\Models\Storycore;
use Unisa\Pages\Models\Page;
use Backend;
use BackendMenu;
use BackendAuth;
use Redirect;
use Input;
use Flash;
use Event;

class Searchpages extends Controller
{
    public $implement = ['Backend\Behaviors\ListController'];

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'page.search_pages' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Searchpages', 'search_pages', 'sub_search_pages');
        $this->vars['filters'] = (is_array(Input::get('chr')) ? array_filter(Input::get('chr')) : array());
    }

    /**
     * applies query search filters if passed
     * @param  Object $query database query object
     * @return void        
     */
    public function listExtendQueryBefore($query){

        foreach ($this->vars['filters'] as $value) {
            if($value != ''){
                $query->orWhere('page_name', 'like', "%{$value}%");
                $query->orWhere('page_title', 'like', "%{$value}%");
                $query->orWhere('meta_keyword', 'like', "%{$value}%");
                $query->orWhere('meta_description', 'like', "%{$value}%");
                $query->orWhere('summary', 'like', "%{$value}%");    
            }
        }   

        /*$user_id = BackendAuth::getUser()->id;
        $query->where('user_id', '=', $user_id);*/
    }

    /**
     * adds custom column to the list
     * @param  Object $list list object
     * @return void       
     */
    public function listExtendColumns($list){

        $list->addColumns([
            'action' => [
                'label'     => 'Action',
                'sortable'  => false,
                'searchable'=> false,
                'type'      => 'partial',
                'path'      => '$/unisa/searchpages/controllers/searchpages/_action_column.htm',
                'cssClass'  => 'nolink'
            ]
        ]);
    }

    /**
     * Creates a storyline with the collection of selected pages.
     * @return [type] [description]
     */
    public function onCreatestory(){
        $storyData = array('story_name'=>Input::get('story_name'), 'description'=>Input::get('description'), 'user_id'=>BackendAuth::getUser()->id);
        $stories = new Storycore;
        $stories->fill($storyData);
        $stories->save();

        $stories->pages()->sync(Input::get('pages'));
        Event::fire('Storycore.formAfterSave', [$stories]);

        Flash::success('Storyline created successfully');
    }

    /**
     * Creates a copy of the database records and redirects to update mode
     * @return [type] [description]
     */
    public function onClone(){
        $rowId = Input::get('page');
        $page = Page::find($rowId);
        $newPage = $page->replicate();
        $newPage->save();

        $newPage->assets()->sync($page->assets);
        Event::fire('Pages.formAfterSave', [$newPage]);
        
        return Redirect::to(Backend::url("unisa\pages\pages\update", $newPage->id));
    }

}