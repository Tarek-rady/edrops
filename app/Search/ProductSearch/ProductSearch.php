<?php
namespace App\Search\ProductSearch;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductSearch
{
 public static function apply(Request $filters)
    {
        $query = 
            static::applyDecoratorsFromRequest(
                $filters, (new Product)->whereHas('sallers', function($query){
                    return $query->where('saller_id', auth('admin')->user()->saller->id)->where('saller_products.type', 'products');
                })->newQuery()
            );

        // return static::getResults($query);
        return $query;
    }
    
    private static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {
        foreach ($request->all() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }

        }
        return $query;
    }
    
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\Filters\\' . 
            str_replace(' ', '', 
                ucwords(str_replace('_', ' ', $name)));
    }
    
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    private static function getResults(Builder $query)
    {
        return $query->get();
    }
}
