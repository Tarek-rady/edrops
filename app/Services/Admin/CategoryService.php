<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    use HelperTrait;
    protected $categoryRepo ;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo    = $categoryRepo ;
    }

    public function get_categories(){

        $categories = $this->categoryRepo->query()->where('type' , 'category');
        return $this->columns($categories);
    }

    public function columns($categories){
        return DataTables($categories)

        ->editColumn('name' , function($category){
            return $category->name ;
        })

        ->editColumn('products' , function($category){
            return $category->products()->count();
        })

        ->editColumn('created_at' , function($category){
            return $category->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.categories.actions')

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_category(Request $request , $data){
        $data['type'] = 'category' ;
        $this->addImage($request, $data, 'img', 'categories');
        $category =$this->categoryRepo->create($data);
    }

    public function update_category(Request $request , $data , $category){
        $this->updateImg($request, $data, 'img', 'categories' , $category);
        $category->update($data);
    }


}
