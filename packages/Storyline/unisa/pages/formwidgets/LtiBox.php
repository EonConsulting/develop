<?php namespace Unisa\Pages\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Unisa\ltiobject\Models\Ltiobject;
use BackendAuth;

/**
 * LtiBox Form Widget
 */
class LtiBox extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'unisa_pages_lti_box';

    /**
     * Widget Details 
     */
    public function widgetDetails()
    {
        return [
            'name'=>'LtiBox',
            'description'=> 'Field for adding LTI Objects'
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
        return $this->makePartial('ltibox');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['id'] = $this->model->id;
        $this->vars['lti'] = Ltiobject::all()->where('user_id', BackendAuth::getUser()->id)->lists('object_name', 'id');
        $this->vars['selectedValues'] = ($this->getLoadValue() != '' ? $this->getLoadValue() : array());
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/ltibox.css', 'Unisa.Pages');
        $this->addJs('js/ltibox.js', 'Unisa.Pages');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
