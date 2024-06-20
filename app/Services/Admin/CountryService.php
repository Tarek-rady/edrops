<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\countryRepository;
use Illuminate\Http\Request;

class CountryService
{
    use HelperTrait;
    protected $countryRepo ;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo    = $countryRepo ;
    }

    public function get_countries(){

        $countries = $this->countryRepo->query();
        return $this->columns($countries);
    }

    public function columns($countries){
        return DataTables($countries)
        ->editColumn('name' , function($country){
            return $country->name;
        })

        ->editColumn('created_at' , function($country){
            return $country->created_at->format('y-m-d');
        })


        ->addColumn('action', 'dashboard.backend.countries.actions')

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_country(Request $request , $data){
        $this->addImage($request, $data, 'img', 'countries');
        $country =$this->countryRepo->create($data);
        $this->wallets($request , $country);
    }

    public function update_country(Request $request , $data , $country){
        $this->updateImg($request, $data, 'img', 'countries' , $country);
        $country->update($data);
        $this->wallets($request , $country);

    }

    public function wallets($request , $country){
        if(isset($request->wallet_ar)){
            if($country->wallets() != null){
                $country->wallets()->delete();
            }

            foreach ($request->wallet_ar as $key => $wallet) {
                $country->wallets()->create([
                    'name_ar' =>$wallet ,
                    'name_en' => $request->wallet_en[$key] ,

                ]);
            }
        }
    }


}
