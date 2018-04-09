<?php

namespace EONConsulting\Core\Converters\Components;

class ItemTransformer
{

    /**
     * Transform each item in the collection using a callback.
     *
     * @param  callable  $callback
     * @return $this
     */
    static public function transform($nodes, $path = '', $level = 0)
    {
        $collection = [];

        $level++;

        foreach($nodes as $node) {

            $collection[] = [
                'id' => $node->id,
                'name' => $node->name,
                'is_leaf' => $node->isLeaf(),
                'filename' => str_slug($node->name) . '.html',
                'path' => $path,
                'level' => $level,
                'content' => optional($node->content)->body,
                'children' => self::transform(
                    $node->children,
                    self::transformPath($path, $node, $level),
                    $level
                ),
            ];
        }

        return collect($collection);
    }

    /**
     * Create a full folder for the storyline item
     *
     * @param $path
     * @param $node
     * @param int $level
     * @return string
     */
    static public function transformPath($path, $node, $level = 0)
    {
        if($level < 1)
        {
            return $path;
        }

        return ltrim($path . '/' . str_slug($node->name), '/');
    }

}