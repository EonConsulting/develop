<?php namespace Unisa\Taxonomy\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;

class Taxonomies extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'taxonomy.manage_taxo' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Taxonomy', 'taxonomy');
    }

    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }
}