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

        $styles = [];
        $scripts = [];
        $custom_scripts = [];

        $menu = '';
        if(function_exists('storyline_menu')) {
            $menu = storyline_menu()->getMenuHTML($config, $config);
        }

        $nav = '';
        if(function_exists('storyline_nav')) {
            $nav = storyline_nav()->getNavHTML($config);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        return view('eon.lti::config', ['config' => $config, 'taxonomy' => $this->taxonomy->get($config), 'PageSL' => $config, 'menu' => $menu, 'nav' => $nav, 'styles' => $styles, 'scripts' => $scripts, 'custom_scripts' => $custom_scripts]);
    }

    public function single($config, $single) {

        $styles = [];
        $scripts = [];
        $custom_scripts = [];

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

        $nav = '';
        if(function_exists('storyline_nav')) {
            $nav = storyline_nav()->getNavHTML($config, $single);
            $styles = array_merge($styles, storyline_nav()->getStyles());
            $scripts = array_merge($scripts, storyline_nav()->getScripts());
            $custom_scripts[] = storyline_nav()->getCustomScripts();
        }

        return view('eon.lti::single', ['parent_config' => $config, 'story' => $story, 'page' => $file, 'menu' => $menu, 'previous' => $previous, 'next' => $next, 'nav' => $nav, 'styles' => $styles, 'scripts' => $scripts, 'custom_scripts' => $custom_scripts]);
    }

}