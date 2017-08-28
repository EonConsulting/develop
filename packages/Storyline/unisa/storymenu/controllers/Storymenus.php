<?php namespace Unisa\Storymenu\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Storymenus extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'storymenu.manage_menu' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Unisa.Storymenu', 'menu');
    }
}