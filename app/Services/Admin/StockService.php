<?php

namespace App\Services\Admin;

use App\Http\Controllers\Api\Traits\GetRoleStocks;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Models\RoleStock;
use App\Models\Stock;
use App\Repositories\Sql\StockRepository;
use Illuminate\Http\Request;

class StockService
{
    use HelperTrait , GetRoleStocks;
    protected $stockRepo ;

    public function __construct(StockRepository $stockRepo)
    {
        $this->stockRepo    = $stockRepo ;
    }

    public function get_stocks($unique_stocks){

        $stocks_data = $this->stockRepo->query()->whereIn('id', $unique_stocks);
        return $this->columns($stocks_data);
    }

    public function columns($stocks_data){
        return DataTables($stocks_data)
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
        ->addColumn('action', 'dashboard.backend.stocks.actions')
        ->filterColumn('country', function ($query, $keyword) {
            $query->whereRelation('country', 'id', $keyword);
        })
        ->filterColumn('city', function ($query, $keyword) {
            $query->whereRelation('city', 'id', $keyword);
        })

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_stock(Request $request , $data){
        $stock = $this->stockRepo->create($data);
        RoleStock::create([
            'role_id'  => 1 ,
            'stock_id' => $stock->id
        ]);
    }

    public function update_stock(Request $request , $data , $stock){
        $stock->update($data);
    }

    public function get_products($products){

        return DataTables($products)

        ->filterColumn('category', function($query , $keyword) {
            $query->whereRelation('category' , 'id' , $keyword);
        })
        ->filterColumn('brand', function($query , $keyword) {
            $query->whereRelation('brand' , 'id' , $keyword);
        })

        ->filterColumn('country', function($query , $keyword) {
            $query->whereRelation('country' , 'id' , $keyword);
        })

        ->filterColumn('store', function($query , $keyword) {
            $query->whereRelation('store' , 'id' , $keyword);
        })


        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })



        ->editColumn('category' , function($product){
            return $product->category->name ;
        })

        ->editColumn('brand' , function($product){
            if($product->brand){
                return  $product->brand->name ;
            }else{
                return 'not found' ;
            }
        })

        ->editColumn('country' , function($product){
            return $product->country->name ;
        })

        ->editColumn('user' , function($product){
            if(isset($product->user)){
                return $product->user->name ;
            }else{
                return '-' ;
            }
        })

        ->editColumn('store' , function($product){
            return $product->store->name ;
        })


        ->addColumn('action', 'dashboard.backend.products.actions')
        ->rawColumns(['action' ])
        ->make(true);
    }

    public function stocks($country_id ) {
        $unique_stocks = $this->getStocks();

        if(app()->getLocale() == 'ar'){
            return  Stock::where('country_id' , $country_id)->whereIn('id', $unique_stocks)->pluck('name_ar' , 'id');
          }else{
              return  Stock::where('country_id' , $country_id)->whereIn('id', $unique_stocks)->pluck('name_en' , 'id');
          }
    }



}
