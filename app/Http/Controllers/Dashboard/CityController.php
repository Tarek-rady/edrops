<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
use App\Repositories\Sql\CityRepository;
use App\Repositories\Sql\CountryRepository;
use App\Services\Admin\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CityController extends Controller
{
    protected $cityRepo , $countryRepo , $cityService;

    public function __construct(CityRepository $cityRepo , CountryRepository $countryRepo , CityService $cityService)
    {
        $this->middleware('permission:cities-read')->only(['index']);
        $this->middleware('permission:cities-create')->only(['create', 'store']);
        $this->middleware('permission:cities-update')->only(['edit', 'update']);
        $this->middleware('permission:cities-delete')->only(['destroy']);
        $this->cityRepo    = $cityRepo ;
        $this->countryRepo = $countryRepo ;
        $this->cityService = $cityService ;

    }


    public function get_cities()
    {
        return $this->cityService->get_cities();

    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.cities.index' , compact('countries'));
    }


    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.cities.create' , compact('countries'));
    }


    public function store(CityRequest $request)
    {

       $data = $request->all();
       $this->cityService->add_city($request , $data);
        return redirect(route('admin.cities.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $countries = $this->countryRepo->getAll();
        $city = $this->cityRepo->findOne($id);

        return view('dashboard.backend.cities.edit' , compact('countries' , 'city'));

    }


    public function update(CityRequest $request, $id)
    {
        $city = $this->cityRepo->findOne($id);
        $data = $request->all();
        $this->cityService->update_city($request , $data , $city);

        return redirect(route('admin.cities.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $admin = $this->cityRepo->findOne($id)->delete();
        return redirect(route('admin.cities.index'))->with('success', __('models.deleted_successfully'));

    }

    public function country_cities($country_id) {

        return $this->cityService->countries($country_id);
    }
}
