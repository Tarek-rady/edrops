<?php

namespace App\Search\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchQuery implements Filter
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

        return $builder->where(function($builder) use ($value) {
                $builder->where('name_ar', 'like', '%' . $value . '%')
                    ->orWhere('name_en', 'like', '%' . $value . '%')
                    ->orWhere('sku', $value );
            });
    }
}