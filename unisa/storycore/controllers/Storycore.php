<?php namespace Unisa\Storycore\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Storycore extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'storycore.manage_story' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Storycore', 'storycore', 'manage_storycore');
    }
}