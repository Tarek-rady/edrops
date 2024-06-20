<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\CurrencyRepository;
use Illuminate\Http\Request;

class CurrencyService
{
    use HelperTrait;
    protected $currencyRepo ;

    public function __construct(CurrencyRepository $currencyRepo)
    {
        $this->currencyRepo    = $currencyRepo ;
    }

    public function get_currencies(){

        $currencies = $this->currencyRepo->query();
        return $this->columns($currencies);

    }

    public function columns($currencies){
        return DataTables($currencies)
        ->editColumn('name' , function($currency){
            return $currency->name;
        })
        ->editColumn('created_at' , function($currency){
            return $currency->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.currencies.actions')


        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_currency(Request $request , $data){
        $this->currencyRepo->create($data);
    }

    public function update_currency(Request $request , $data , $currency){
        
        $currency->update($data);
    }


}
