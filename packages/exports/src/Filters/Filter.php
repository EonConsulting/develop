<?php

namespace EONConsulting\Exports\Filters;

use EONConsulting\Exports\Filters\FilterContract;

class Filter
{

    /*
     * Filter
     *
     * @var $filter
     */
    protected $filter;

    /**
     * Filter constructor.
     *
     * @param \EONConsulting\Exports\Filters\FilterContract $filter
     */
    public function __construct(FilterContract $filter)
    {
        $this->filter = $filter;

        $this->filter->handle();
    }

    /**
     * Get the content from the filter
     *
     * @return string
     */
    public function getContent()
    {
        return (string) $this->filter->getHtml();
    }


}

