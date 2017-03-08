<?php

namespace EONConsulting\CKEditorPlugin\ViewComposers;

use Illuminate\View\View;
use EONConsulting\CKEditorPlugin\Http\Controllers\ListDomainsController;

class ListDomainsComposer
{
    public $domains = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct(ListDomainsController $domains)
    {
       $this->domains = $domains->index();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('domains', $this->domains);
        //View::share('domains');

    }
}