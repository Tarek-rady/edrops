<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\BannerExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Repositories\Sql\BannerRepository;
use App\Services\Admin\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BannerController extends Controller
{
    protected $bannerRepo , $bannerService;

    public function __construct(BannerRepository $bannerRepo , BannerService $bannerService)
    {
        $this->middleware('permission:banners-read')->only(['index']);
        $this->middleware('permission:banners-create')->only(['create', 'store']);
        $this->middleware('permission:banners-update')->only(['edit', 'update']);
        $this->middleware('permission:banners-delete')->only(['destroy']);
        $this->bannerRepo    = $bannerRepo ;
        $this->bannerService = $bannerService ;

    }


    public function get_banners()
    {
        return $this->bannerService->get_banners();

    }

    public function index()
    {
        return view('dashboard.backend.banners.index');
    }


    public function create()
    {
        return view('dashboard.backend.banners.create');
    }


    public function store(BannerRequest $request)
    {

       $data = $request->except('img' , 'status');
       $this->bannerService->add_banner($request, $data);
        return redirect(route('admin.banners.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $banner = $this->bannerRepo->findOne($id);
        return view('dashboard.backend.banners.edit' , compact('banner'));

    }


    public function update(BannerRequest $request, $id)
    {
        $banner = $this->bannerRepo->findOne($id);
        $data = $request->except('img' );
        $this->bannerService->update_banner($request, $data , $banner);
        return redirect(route('admin.banners.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $banner = $this->bannerRepo->findOne($id);
        $this->bannerService->delete($banner);
        return redirect(route('admin.banners.index'))->with('success', __('models.deleted_successfully'));

    }


    public function changeBannerstatus(Request $request){
        $this->bannerService->change_status($request);
        return response()->json(['success' => __('models.status_update')]);
    }

    public function export()
    {
        return Excel::download(new BannerExport, 'banners.xlsx');
    }
}
