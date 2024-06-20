<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\BannerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    use HelperTrait;
    protected $bannerRepo ;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepo    = $bannerRepo ;
    }

    public function get_banners(){
        $banners = $this->bannerRepo->query();
        return $this->columns($banners);
    }

    public function columns($banners){
        return DataTables($banners)
        ->editColumn('title' , function($banner){
            return $banner->title;
        })
        ->editColumn('created_at' , function($banner){
            return $banner->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.banners.actions')
        ->rawColumns(['action' ])
        ->make(true);
    }

    public function add_banner(Request $request , $data){
        $this->addImage($request, $data, 'img', 'banners');
        $data['status'] = 'active' ;
        $banner =$this->bannerRepo->create($data);
    }

    public function update_banner(Request $request , $data , $banner){
        $this->updateImg($request, $data, 'img', 'banners' , $banner);
        $banner->update($data);
    }

    public function delete($banner){
        if ($banner->img) {
            Storage::delete($banner->img);
        }
        $banner->delete();
    }

    public function change_status($request){
        $banner = $this->bannerRepo->findOne($request->id);

        $banner->update([
            'status'    => $request->status
        ]);
    }
}
