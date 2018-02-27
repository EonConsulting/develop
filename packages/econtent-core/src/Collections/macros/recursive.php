<?php

use Illuminate\Support\Collection;

/*
 * Turn the collection into a recursive collection.
 *
 * @return mixed
 */
Collection::macro('recursive', function ()
{
    return $this->map(function ($value)
    {
        if (is_array($value) || is_object($value))
        {
            return collect($value)->recursive();
        }

        return $value;
    });
});