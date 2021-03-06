<?php
/**
 * User: zach
 * Date: 01/20/2014
 * Time: 14:34:49 pm
 */

namespace Elasticsearch\Endpoints\Indices\Upgrade;

use Elasticsearch\Common\Exceptions;
use Elasticsearch\Endpoints\AbstractEndpoint;

/**
 * Class Post
 *
 * @category Elasticsearch
 * @package Elasticsearch\Endpoints\Indices
 * @author   Zachary Tong <zachary.tong@elasticsearch.com>
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache2
 * @link     http://elasticsearch.org
 */
class Post extends AbstractEndpoint
{

    /**
     * @return string
     */
    protected function getURI()
    {
        $index = $this->index;
        $uri = "/_upgrade";

        if (isset($index) === true) {
            $uri = "/$index/_upgrade";
        }


        return $uri;
    }


    /**
     * @return string[]
     */
    protected function getParamWhitelist()
    {
        return [
            'allow_no_indices',
            'expand_wildcards',
            'ignore_unavailable',
            'wait_for_completion',
            'only_ancient_segments',
        ];
    }


    /**
     * @return string
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
