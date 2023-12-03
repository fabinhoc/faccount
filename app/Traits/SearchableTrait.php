<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait SearchableTrait
{
    public static function applyFilters(Builder $query, Request $request)
    {
        return static::applyDecoratorsFromRequest(
                $request,
                $query
            );
    }

    private static function applyDecoratorsFromRequest(Request $filters, Builder $query) {
        foreach ($filters->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }

        return $query;
    }

    private static function createFilterDecorator($name)
    {
        return 'App\\Searches\\Filters\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
