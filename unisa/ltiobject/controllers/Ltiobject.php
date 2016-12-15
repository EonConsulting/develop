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

    /**
     * adds id of the user who is adding new record
     * @param  Object $model Database model object
     * @return void        
     */
    public function formBeforeCreate($model){
        $model->user_id = BackendAuth::getUser()->id;
    }

    /**
     * Adds the conditional parameters to select query.
     * @param  Object $query Database query object
     * @return void
     */
    public function listExtendQueryBefore($query){
        $user_id = BackendAuth::getUser()->id;

        $query->where('user_id', '=', $user_id);
    }
}