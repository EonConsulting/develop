<?php
namespace EONConsulting\Storyline\Core\Controllers;

use EONConsulting\Storyline\Core\Flow\XMLTaxonomy;
use JoshHarington\LaravelTsugi\Controllers\TsugiController;

class LTIController extends TsugiController {

    protected $taxonomy;

    /**
     * LTIController constructor.
     */
    public function __construct() {
        $this->taxonomy = new XMLTaxonomy;
    }

    public function index() {
        return view('eon.lti::index', ['taxonomy' => $this->taxonomy->index()]);
    }

    public function config($config) {

        $menu = '';
        if(function_exists('storyline_menu')) {
            $menu = storyline_menu()->getMenuHTML($config, $config);
        }

        return view('eon.lti::config', ['config' => $config, 'taxonomy' => $this->taxonomy->get($config), 'PageSL' => $config, 'menu' => $menu]);
    }

    public function single($config, $single) {

        $story = $this->taxonomy->getStoryline($config, $single);

        $file = '/vendor/storyline/core/html/' . $single . '.html';

        $menu = '';
        if(function_exists('storyline_menu')) {
            $menu = storyline_menu()->getMenuHTML($config, $single);
        }

        $previous = $this->taxonomy->getPreviousPage($config, $single);
        $previous['href'] = route('lti.single', [$previous['parent_config'], $previous['link']]);

        $next = $this->taxonomy->getNextPage($config, $single);
        $next['href'] = route('lti.single', [$next['parent_config'], $next['link']]);

        return view('eon.lti::single', ['parent_config' => $config, 'story' => $story, 'page' => $file, 'menu' => $menu, 'previous' => $previous, 'next' => $next]);
    }

}