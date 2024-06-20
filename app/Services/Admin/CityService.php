<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Models\City;
use App\Repositories\Sql\CityRepository;
use Illuminate\Http\Request;

class CityService
{
    use HelperTrait;
    protected $cityRepo ;

    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepo    = $cityRepo ;
    }

    public function get_cities(){
        $cities = $this->cityRepo->query();
        return $this->columns($cities);

    }

    public function columns($cities){
        return DataTables($cities)
        ->filterColumn('country', function($query , $keyword) {
            $query->whereRelation('country' , 'id' , $keyword);
        })
        ->editColumn('name' , function($city){
            return  $city->name;
        })
        ->editColumn('country' , function($city){
            return $city->country->name;
        })
        ->editColumn('created_at' , function($city){
            return $city->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.cities.actions')
        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_city(Request $request , $data){
        $this->cityRepo->create($data);
    }

    public function update_city(Request $request , $data , $city){
        $city->update($data);
    }

    public function countries($country_id){
        if(app()->getLocale() == 'ar'){
            return  City::where('country_id' , $country_id)->pluck('name_ar' , 'id') ;
       }else{
            return  City::where('country_id' , $country_id)->pluck('name_en' , 'id') ;
       }
    }


}
