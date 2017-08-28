<?php namespace Unisa\Pages\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Unisa\Assets\Models\Asset;
use BackendAuth;

/**
 * AssetBox Form Widget
 */
class AssetBox extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'unisa_pages_asset_box';

    /**
     * Widget Details 
     */
    public function widgetDetails()
    {
        return [
            'name'=>'AssetBox',
            'description'=> 'Field for adding assets'
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
        return $this->makePartial('assetbox');
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
        $this->vars['assets'] = Asset::all()->where('is_published', 1)->where('user_id', BackendAuth::getUser()->id)->lists('asset_name', 'id');
        $this->vars['selectedValues'] = ($this->getLoadValue() != '' ? $this->getLoadValue() : array());
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/assetbox.css', 'unisa.storylines');
        $this->addJs('js/assetbox.js', 'unisa.storylines');

        $this->addCss('css/select2.css', 'unisa.storylines');
        $this->addJs('js/select2.js', 'unisa.storylines');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return $value;
    }

}
