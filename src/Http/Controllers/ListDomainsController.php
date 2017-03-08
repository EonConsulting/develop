<?php
/**
 * Created by PhpStorm.
 * User: Peace Ngara
 * Date: 3/5/2017
 * Time: 10:39 AM
 */

namespace EONConsulting\CKEditorPlugin\Http\Controllers;
use App\Http\Controllers\Controller;
use EONConsulting\CKEditorPlugin\CKEditorPlugin;
use EONConsulting\LaravelLTI\LaravelLTI;
use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;


class ListDomainsController extends LTIBaseController  {
    /**
     * @var $domain_list
     */
    public $domain_list = [];

    protected $hasLTI = false;

    /**
     * @return true
     */

    public function index() {

        //Return a List of Available resources
        return $this->domain_list = laravel_lti()->get_domains();

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function getDomainsList() {

        //Define a Getter for the Set Index()

        $this->domain_list = $this->index();

        $domains = $this->domain_list;

        return view('plugin', compact($domains));

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     *[$this->domain_list = $this->index()
    */
    public function getDomainsListAPI($domainjs) {

        //

    }
}
