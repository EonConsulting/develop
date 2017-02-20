<?php
namespace EONConsulting\Storyline\Core\Controllers;

use EONConsulting\LaravelLTI\Http\Controllers\LTIBaseController;
use EONConsulting\Storyline\Core\Flow\XMLTaxonomy;

class LTIController extends LTIBaseController {

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
        $custom_styles = [];
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

        $tag_cloud = '';
        if(function_exists('storyline_tag_cloud')) {
            $word_list = storyline_tag_cloud()->generateWordList(storyline_core()->getMostCommonWords());
            $tag_cloud = storyline_tag_cloud()->getHTML();
            $styles = array_merge($styles, storyline_tag_cloud()->getStyles());
            $scripts = array_merge($scripts, storyline_tag_cloud()->getScripts());
            $custom_styles[] = storyline_tag_cloud()->getCustomStyles();
            $custom_scripts[] = storyline_tag_cloud()->getCustomScripts($word_list);
        }

        $breadcrumb = '';
        if(function_exists('storyline_breadcrumbs')) {
            $breadcrumb = storyline_breadcrumbs()->getBreadcrumbs($config);
            $styles = array_merge($styles, storyline_breadcrumbs()->getStyles());
        }

        return view('eon.lti::config', ['config' => $config, 'taxonomy' => $this->taxonomy->get($config), 'PageSL' => $config, 'menu' => $menu, 'nav' => $nav, 'styles' => $styles, 'scripts' => $scripts, 'custom_scripts' => $custom_scripts, 'custom_styles' => $custom_styles, 'tag_cloud' => $tag_cloud, 'breadcrumb' => $breadcrumb]);
    }

    public function single($config, $single) {

        $styles = [];
        $scripts = [];
        $custom_styles = [];
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

        $tag_cloud = '';
        if(function_exists('storyline_tag_cloud')) {
            $word_list = storyline_tag_cloud()->generateWordList(storyline_core()->getMostCommonWords());
            $tag_cloud = storyline_tag_cloud()->getHTML();
            $styles = array_merge($styles, storyline_tag_cloud()->getStyles());
            $scripts = array_merge($scripts, storyline_tag_cloud()->getScripts());
            $custom_styles[] = storyline_tag_cloud()->getCustomStyles();
            $custom_scripts[] = storyline_tag_cloud()->getCustomScripts($word_list);
        }

        $breadcrumb = '';
        if(function_exists('storyline_breadcrumbs')) {
            $breadcrumb = storyline_breadcrumbs()->getBreadcrumbs($single, $config);
            $styles = array_merge($styles, storyline_breadcrumbs()->getStyles());
        }

        return view('eon.lti::single', ['parent_config' => $config, 'story' => $story, 'page' => $file, 'menu' => $menu, 'previous' => $previous, 'next' => $next, 'nav' => $nav, 'styles' => $styles, 'scripts' => $scripts, 'custom_scripts' => $custom_scripts, 'custom_styles' => $custom_styles, 'tag_cloud' => $tag_cloud, 'breadcrumb' => $breadcrumb]);
    }

}