<?php namespace Unisa\Storycore\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Unisa\Pages\Models\Page;
use BackendAuth;

/**
 * PageBox Form Widget
 */
class PageBox extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'unisa_storycore_page_box';

    /**
     * Widget Details 
     */
    public function widgetDetails()
    {
        return [
            'name'=>'PageBox',
            'description'=> 'Field for adding Pages'
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function init()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('pagebox');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName().'[]';
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['id'] = $this->model->id;
        $this->vars['pages'] = Page::all()->where('user_id', BackendAuth::getUser()->id)->lists('page_name', 'id');
        $this->vars['selectedValues'] = ($this->getLoadValue() != '' ? $this->getLoadValue() : array());
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/pagebox.css', 'unisa.storycore');
        $this->addCss('css/select2.css', 'unisa.storycore');
        $this->addJs('js/pagebox.js', 'unisa.storycore');
        $this->addJs('js/select2.js', 'unisa.storycore');

    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
