<?php

namespace EONConsulting\Exports\Filters;

interface FilterContract {

    /*
     * Handle the filter
     */
    public function handle();

    /**
     * Get The html Dom
     *
     * @return string $html
     */
    public function getHtml();
}