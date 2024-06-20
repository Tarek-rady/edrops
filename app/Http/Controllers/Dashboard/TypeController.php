<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\TypeExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Repositories\Sql\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    protected $categoryRepo ;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->middleware('permission:categories-read')->only(['index']);
        $this->middleware('permission:categories-create')->only(['create', 'store']);
        $this->middleware('permission:categories-update')->only(['edit', 'update']);
        $this->middleware('permission:categories-delete')->only(['destroy']);
        $this->categoryRepo = $categoryRepo ;

    }

    public function get_types()
    {
        $types = $this->categoryRepo->query()->where('type' , 'ask');
        return DataTables($types)
        ->editColumn('created_at' , function($type){
            return '<span class="badge rounded-pill border border-light text-body">'.$type->created_at->format('y-m-d').'</span>';
        })
        ->editColumn('asks' , function($type){
            return '<span class="badge bg-info-subtle text-info badge-border">'.$type->asks()->count().'</span>';
        })
        ->addColumn('action', 'dashboard.backend.types.actions')

        ->rawColumns(['action' , 'asks'  , 'created_at'])
        ->make(true);

    }

    public function index()
    {

         return view('dashboard.backend.types.index');
    }


    public function create()
    {
         return view('dashboard.backend.types.create');
    }


    public function store(Request $request)
    {

       $data = $request->except('img' , 'type');
       $data['type'] = 'ask' ;
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('types');
        }


        $this->categoryRepo->create($data);


        return redirect(route('admin.types.index'))->with('success', __('models.added_successfully'));

    }


    public function edit($id)
    {
        $category = $this->categoryRepo->findOne($id);
        return view('dashboard.backend.types.edit' , compact('category'));

    }


    public function update(Request $request, $id)
    {
         $category = $this->categoryRepo->findOne($id);


        $category->update($request->all());
        return redirect(route('admin.types.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $category = $this->categoryRepo->findOne($id)->delete();
        return redirect(route('admin.types.index'))->with('success', __('models.deleted_successfully'));

    }


    public function export()
    {
        return Excel::download(new TypeExport, 'types.xlsx');
    }



}
