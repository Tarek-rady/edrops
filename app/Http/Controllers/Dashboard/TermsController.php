<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\TermExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermRequest;
use App\Repositories\Sql\CategoryRepository;
use App\Repositories\Sql\StaticPageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TermsController extends Controller
{
    protected $termRepo , $categoryRepo;

    public function __construct(StaticPageRepository $termRepo , CategoryRepository $categoryRepo)
    {
        $this->middleware('permission:terms-read')->only(['index']);
        $this->middleware('permission:terms-create')->only(['create', 'store']);
        $this->middleware('permission:terms-update')->only(['edit', 'update']);
        $this->middleware('permission:terms-delete')->only(['destroy']);
        $this->termRepo = $termRepo ;
        $this->categoryRepo = $categoryRepo ;

    }


      public function get_terms()
    {
        $terms = $this->termRepo->query();
        return DataTables($terms)
        ->editColumn('type' , function($term){
            return $term->type->name;
        })
        ->addColumn('desc', 'dashboard.backend.terms.modal')
        ->editColumn('created_at' , function($term){
            return $term->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.terms.actions')

        ->rawColumns(['action' , 'desc'])
        ->make(true);

    }

    public function index()
    {

         return view('dashboard.backend.terms.index');
    }


    public function create()
    {
         $categories = $this->categoryRepo->getWhere(['type' => 'ask']);
         return view('dashboard.backend.terms.create' , compact('categories'));
    }


    public function store(TermRequest $request)
    {

       $data = $request->all();
        $this->termRepo->create($data);


        return redirect(route('admin.terms.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $term = $this->termRepo->findOne($id);
        $categories = $this->categoryRepo->getWhere(['type' => 'ask']);

        return view('dashboard.backend.terms.edit' , compact('term' , 'categories'));

    }


    public function update(Request $request, $id)
    {
         $term = $this->termRepo->findOne($id);
         $data = $request->all();


        $term->update($data);
        return redirect(route('admin.terms.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $term = $this->termRepo->findOne($id)->delete();
        return redirect(route('admin.terms.index'))->with('success', __('models.deleted_successfully'));


    }


    public function export()
    {
        return Excel::download(new TermExport, 'terms.xlsx');
    }
}
