<?php namespace Unisa\Ltiobject\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use BackendAuth;

class Ltiobject extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'lti.manage_ltiobject' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Ltiobject', 'lti_object', 'manage_lti_object');
    }

    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }

    public function listExtendQueryBefore($query){
        $user_id = BackendAuth::getUser()->id;

        $query->where('user_id', '=', $user_id);
    }
}