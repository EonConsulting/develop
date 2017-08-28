<?php namespace Unisa\Taxonomy\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Unisa\Storycore\Models\Storycore;
use BackendAuth;

/**
 * storyBox Form Widget
 */
class StoryBox extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'unisa_taxonomy_story_box';

    /**
     * Widget Details 
     */
    public function widgetDetails()
    {
        return [
            'name'=>'StoryBox',
            'description'=> 'Field for adding stories'
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
        return $this->makePartial('storybox');
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
        $this->vars['stories'] = Storycore::all()->where('user_id', BackendAuth::getUser()->id)->lists('story_name', 'id');
        $this->vars['selectedValues'] = ($this->getLoadValue() != '' ? $this->getLoadValue() : array());
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/storybox.css', 'unisa.taxonomy');
        $this->addCss('css/select2.css', 'unisa.storycore');
        $this->addJs('js/storybox.js', 'unisa.taxonomy');
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
