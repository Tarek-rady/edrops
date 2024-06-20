<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Sql\CategoryRepository;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class CategoryController extends Controller
{
    protected $categoryRepo , $categoryService;

    public function __construct(CategoryRepository $categoryRepo , CategoryService $categoryService)
    {
        $this->middleware('permission:categories-read')->only(['index']);
        $this->middleware('permission:categories-create')->only(['create', 'store']);
        $this->middleware('permission:categories-update')->only(['edit', 'update']);
        $this->middleware('permission:categories-delete')->only(['destroy']);
        $this->categoryRepo    = $categoryRepo ;
        $this->categoryService = $categoryService ;

    }

    public function get_categories()
    {
        return $this->categoryService->get_categories();

    }

    public function index()
    {

         return view('dashboard.backend.categories.index');
    }


    public function create()
    {
         return view('dashboard.backend.categories.create');
    }


    public function store(CategoryRequest $request)
    {

       $data = $request->except('img' , 'type');
       $this->categoryService->add_category($request , $data);
        return redirect(route('admin.categories.index'))->with('success', __('models.added_successfully'));

    }


    public function edit($id)
    {
        $category = $this->categoryRepo->findOne($id);
        return view('dashboard.backend.categories.edit' , compact('category'));

    }


    public function update(CategoryRequest $request, $id)
    {
         $category = $this->categoryRepo->findOne($id);
         $data = $request->except('img');
         $this->categoryService->update_category($request , $data , $category);
        return redirect(route('admin.categories.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $category = $this->categoryRepo->findOne($id);

        if ($category->img) {
            Storage::delete($category->img);
        }

        $category->delete();

        return redirect(route('admin.categories.index'))->with('success', __('models.deleted_successfully'));

    }

    public function export()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }



}
