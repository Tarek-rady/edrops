<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Repositories\Sql\CountryRepository;
use App\Services\Admin\CountryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CountryController extends Controller
{
    protected $countryRepo , $countryService;

    public function __construct(CountryRepository $countryRepo , CountryService $countryService)
    {
        $this->middleware('permission:countries-read')->only(['index']);
        $this->middleware('permission:countries-create')->only(['create', 'store']);
        $this->middleware('permission:countries-update')->only(['edit', 'update']);
        $this->middleware('permission:countries-delete')->only(['destroy']);
        $this->countryRepo = $countryRepo ;
        $this->countryService = $countryService ;
    }


    public function get_countries()
    {

        return $this->countryService->get_countries();

    }

    public function index()
    {

         return view('dashboard.backend.countries.index');
    }


    public function create()
    {
         return view('dashboard.backend.countries.create');
    }


    public function store(CountryRequest $request)
    {

       $data = $request->except('img' , 'wallet_ar','wallet_en');
       $this->countryService->add_country($request , $data );
        return redirect(route('admin.countries.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $country = $this->countryRepo->findOne($id);
        return view('dashboard.backend.countries.edit' , compact('country'));

    }


    public function update(CountryRequest $request, $id)
    {
         $country = $this->countryRepo->findOne($id);
         $data = $request->except('img' , 'wallet_ar','wallet_en');
         $this->countryService->update_country($request , $data , $country);

        return redirect(route('admin.countries.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $country = $this->countryRepo->findOne($id);

        if ($country->img) {
            Storage::delete($country->img);
        }

        $country->delete();

        return redirect(route('admin.countries.index'))->with('success', __('models.deleted_successfully'));

    }
}
