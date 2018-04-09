<?php

namespace EONConsulting\Core\Converters\Components;

use Facades\ {
    EONConsulting\Core\Converters\CourseToHtml
};

class Menu
{

    protected $items;

    static public function make($items)
    {
        $menu = new self();

        $menu->items = $items;

        return $menu;
    }

    /**
     * Build the navigation menu
     *
     * @param $current_item
     * @return string
     */
    public function build($current_item)
    {
        $menu = '';

        foreach ($this->items as $item)
        {
            $menu .= $this->buildItems($item, $current_item);
        }

        return $menu;
    }

    /**
     * Build the navigation menu
     *
     * @param $node
     * @param $current_item
     * @return string
     */
    public function buildItems($node, $current_item)
    {
        $relative_path = CourseToHtml::getRelativePath($current_item, $node);

        $file = $relative_path .  $node->get('filename');

        $html = '';

        if ($node->get('is_leaf'))
        {
            return "<li><a href=\"{$file}\">{$node->get('name')}</a></li>";

        } else {

            $html .= "<li><a href=\"{$file}\">{$node->get('name')}</a>\n<ul>";

            if($children = $node->get('children'))
            {
                foreach ($children as $child)
                {
                    $html.= $this->buildItems($child, $current_item);
                }
            }

            $html .= "</ul>\n</li>";
        }

        return $html;
    }
}