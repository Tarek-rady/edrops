<?php

namespace App\Search\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Category implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        if($value == null)
            return $builder;
            
        return $builder->where('category_id', $value);
    }
}