<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SallerRequest;
use App\Repositories\Sql\AdminRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\ProfitRepository;
use App\Repositories\Sql\PullRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Sql\PointRepository;
use App\Repositories\Sql\ProductRepository;
use App\Services\Admin\SallerService;

class SallerController extends Controller
{
    protected $sallerRepo  , $adminRepo , $countryRepo , $sallerService;

    public function __construct(SallerRepository $sallerRepo , AdminRepository $adminRepo , CountryRepository $countryRepo ,  SallerService $sallerService)
    {
        $this->middleware('permission:sallers-read')->only(['index']);
        $this->middleware('permission:sallers-create')->only(['create', 'store']);
        $this->middleware('permission:sallers-update')->only(['edit', 'update']);
        $this->middleware('permission:sallers-delete')->only(['destroy']);
        $this->sallerRepo  = $sallerRepo  ;
        $this->adminRepo   = $adminRepo   ;
        $this->countryRepo = $countryRepo ;
        $this->sallerService= $sallerService   ;
    }


    public function get_new_sallers()
    {
        return $this->sallerService->get_new_sallers();
    }

    public function get_sallers()
    {
       return $this->sallerService->get_sallers();

    }

    public function new_sallers()  {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.sallers.sallers' , compact('countries'));

    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.sallers.index' , compact('countries'));
    }


    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.sallers.create' , compact('countries'));
    }


    public function store(SallerRequest $request)
    {
        $this->sallerService->add_saller($request);
        return redirect(route('admin.sallers.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        $saller = $this->sallerRepo->findOne($id);
        return view('dashboard.backend.sallers.show' , compact('saller'));

    }


    public function edit($id)
    {
        $saller = $this->sallerRepo->findOne($id);
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.sallers.edit' , compact('saller' , 'countries' ));

    }


    public function update(SallerRequest $request, $id)
    {
        $saller = $this->sallerRepo->findOne($id);
        $this->sallerService->update_saller($request  , $saller);
        return redirect(route('admin.sallers.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $saller = $this->sallerRepo->findOne($id);
         $this->sallerService->delete_saller($saller);


        return redirect(route('admin.sallers.index'))->with('success', __('models.deleted_successfully'));

    }

    public function changeActiveSaller(Request $request){
        $this->sallerService->change_active($request);
        return response()->json(['success' => __('models.status_update')]);
    }


    public function get_pulls(Request $request)
    {
        $saller_id = $request->query('saller_id');
        return $this->sallerService->pulls($saller_id);
    }

    public function get_profits(Request $request)
    {
        $saller_id = $request->query('saller_id');
        return $this->sallerService->profits($saller_id);
    }

    public function finish_page($id){
        $admin = $this->adminRepo->findOne($id);
        $this->sallerService->change_active($admin);


        return view('dashboard.backend.sallers.finish');
    }
}
