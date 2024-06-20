<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\StockRepository;


class UserController extends Controller
{
    protected $stockRepo , $categoryRepo , $countryRepo;

    public function __construct(StockRepository $stockRepo , CategoryRepository $categoryRepo , CountryRepository $countryRepo)
    {
        $this->stockRepo    = $stockRepo ;
        $this->categoryRepo = $categoryRepo ;
        $this->countryRepo  = $countryRepo ;
    }


    public function get_stocks()
    {

        $stocks_data = $this->stockRepo->query();

        return DataTables($stocks_data)

            ->filterColumn('country', function ($query, $keyword) {
                $query->whereRelation('country', 'id', $keyword);
            })
            ->filterColumn('city', function ($query, $keyword) {
                $query->whereRelation('city', 'id', $keyword);
            })
            ->editColumn('name', function ($stock) {
                return $stock->name;
            })
            ->editColumn('country', function ($stock) {
                return $stock->country->name;
            })
            ->editColumn('city', function ($stock) {
                return $stock->city->name;
            })

            ->editColumn('created_at', function ($stock) {
                return $stock->created_at->format('y-m-d');
            })


        ->make(true);
    }


    public function stocks()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.user.stocks.index' , compact('countries'));
    }

    public function get_categories()
    {
        $categories = $this->categoryRepo->query()->where('type' , 'category');
        return DataTables($categories)

        ->editColumn('name' , function($category){
            return $category->name ;
        })

        ->editColumn('products' , function($category){
            return $category->products()->count();
        })

        ->editColumn('created_at' , function($category){
            return $category->created_at->format('y-m-d');
        })

        ->make(true);

    }

    public function categories()
    {
         return view('dashboard.user.categories.index');
    }


    public function get_brands()
    {
        $brands = $this->categoryRepo->query()->where('type' , 'brand');
        return DataTables($brands)

        ->editColumn('name' , function($brand){
            return $brand->name ;
        })

        ->editColumn('products' , function($brand){
            return $brand->brand_products()->count();
        })

        ->editColumn('created_at' , function($brand){
            return $brand->created_at->format('y-m-d');
        })

        ->make(true);

    }

    public function brands()
    {
         return view('dashboard.user.brands.index');
    }


    public function country_stocks($country_id){

        if(app()->getLocale() == 'ar'){
          return  Stock::where('country_id' , $country_id)->pluck('name_ar' , 'id');
        }else{
            return  Stock::where('country_id' , $country_id)->pluck('name_en' , 'id');
        }
    }



}
