<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\BrandExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Repositories\Sql\CategoryRepository;
use App\Services\Admin\BrandService;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    protected $brandRepo , $brandService;

    public function __construct(CategoryRepository $brandRepo , BrandService $brandService)
    {
        $this->middleware('permission:brands-read')->only(['index']);
        $this->middleware('permission:brands-create')->only(['create', 'store']);
        $this->middleware('permission:brands-update')->only(['edit', 'update']);
        $this->middleware('permission:brands-delete')->only(['destroy']);
        $this->brandRepo    = $brandRepo ;
        $this->brandService = $brandService ;

    }

    public function get_brands()
    {
        return $this->brandService->get_brands();


    }

    public function index()
    {

         return view('dashboard.backend.brands.index');
    }


    public function create()
    {
         return view('dashboard.backend.brands.create');
    }


    public function store(BrandRequest $request)
    {

       $data = $request->except('img' , 'type');
       $this->brandService->add_brand($request , $data );

        return redirect(route('admin.brands.index'))->with('success', __('models.added_successfully'));

    }


    public function edit($id)
    {
        $brand = $this->brandRepo->findOne($id);
        return view('dashboard.backend.brands.edit' , compact('brand'));

    }


    public function update(BrandRequest $request, $id)
    {
         $brand = $this->brandRepo->findOne($id);
         $data = $request->except('img' );
         $this->brandService->update_brand($request , $data , $brand);
        return redirect(route('admin.brands.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $brand = $this->brandRepo->findOne($id);

        if ($brand->img) {
            Storage::delete($brand->img);
        }

        $brand->delete();

        return redirect(route('admin.brands.index'))->with('success', __('models.deleted_successfully'));

    }

    public function export()
    {
        return Excel::download(new BrandExport, 'brands.xlsx');
    }



}
