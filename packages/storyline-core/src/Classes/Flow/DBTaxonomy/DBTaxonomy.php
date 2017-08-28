<?php
/**
 * Created by PhpStorm.
 * User: jharing10
 * Date: 2017/03/21
 * Time: 10:36 AM
 */

namespace EONConsulting\Storyline\Core\Flow;


use App\Models\Course;

class DBTaxonomy {
    /**
     * @var array
     */
    protected $trees;
    /**
     * @var array
     */
    protected $course;

    public function __construct() {
        $this->trees = [];
        $this->course = [];
    }

    public function set_course(Course $course) {
        $this->course = $course;
    }

    public function get_course_taxonomy(Course $course) {
        $storyline = $course->latest_storyline();

        $tree = null;

        if(isset($storyline->items)) {
            $items = $storyline->items;

            $tree = $this->get_storyline($items->toArray());
        }

        return $tree;
    }

    private function get_storyline(array $elements, $parentId = false) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->get_storyline($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                    $element['type'] = 'branch';
                } else {
                    $element['type'] = 'leaf';
                }

                if(array_key_exists('file_name', $element) && !is_null($element['file_name']) && array_key_exists('file_url', $element) && !is_null($element['file_url'])) {
                    $element['files'] = [
                        ['name' => $element['file_name'], 'url' => $element['file_url']]
                    ];
                    $element['config'] = $element['file_name'];
                }

                if(array_key_exists('description', $element)) {
                    $element['summary'] = $element['description'];
                }

                if(array_key_exists('name', $element)) {
                    $element['title'] = $element['name'];
                }

                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function getMenu($config = false, $trees = []) {
        $menu = [];

        if(count($trees) == 0)
            $trees = ($config) ? $this->trees[$config] : $this->trees;

        foreach($trees as $tree) {
            try {
                $link = (array_key_exists('link', $tree)) ? $tree['link'] : $tree['id'];
                $menu[] = [
                    'config' => (array_key_exists('config', $tree)) ? $tree['config'] : $link,
                    'title' => $tree['name'],
                    'children' => (array_key_exists('children', $tree)) ? $this->getMenu(false, $tree['children']) : []
                ];
            } catch (\Exception $e) {
                dd($tree);
            }

        }

        return $menu;
    }
}
