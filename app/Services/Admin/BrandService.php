<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\CategoryRepository;
use Illuminate\Http\Request;

class BrandService
{
    use HelperTrait;
    protected $brandRepo ;

    public function __construct(CategoryRepository $brandRepo)
    {
        $this->brandRepo    = $brandRepo ;
    }

    public function get_brands(){

        $brands = $this->brandRepo->query()->where('type' , 'brand');
        return $this->columns($brands);
    }

    public function columns($brands){
        return DataTables($brands)
        ->editColumn('name' , function($brand){
            return $brand->name;
        })
        ->editColumn('created_at' , function($brand){
            return $brand->created_at->format('y-m-d');
        })
        ->editColumn('products' , function($brand){
            return $brand->brand_products()->count();

        })
        ->addColumn('action', 'dashboard.backend.brands.actions')

        ->rawColumns(['action' ])
        ->make(true);
    }

    public function add_brand(Request $request , $data){
        $data['type'] = 'brand' ;
        $this->addImage($request, $data, 'img', 'brands');
        $brand =$this->brandRepo->create($data);
    }

    public function update_brand(Request $request , $data , $brand){
        $this->updateImg($request, $data, 'img', 'brands' , $brand);
        $brand->update($data);
    }


}
