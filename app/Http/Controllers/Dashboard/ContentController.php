<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermRequest;
use App\Repositories\Sql\TermsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ContentController extends Controller
{
    protected $termRepo ;

    public function __construct(TermsRepository $termRepo)
    {
        $this->middleware('permission:contents-read')->only(['index']);
        $this->middleware('permission:contents-create')->only(['create', 'store']);
        $this->middleware('permission:contents-update')->only(['edit', 'update']);
        $this->middleware('permission:contents-delete')->only(['destroy']);
        $this->termRepo = $termRepo ;

    }


      public function get_contents()
    {
        $contents = $this->termRepo->query()->where('type' , 'terms');
        return DataTables($contents)
        ->editColumn('name' , function($contents){
            return $contents->name;
        })
        ->editColumn('created_at' , function($contents){
            return $contents->created_at->format('y-m-d');
        })

        ->addColumn('action', 'dashboard.backend.contents.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {

         return view('dashboard.backend.contents.index');
    }


    public function create()
    {
         return view('dashboard.backend.contents.create');
    }


    public function store(TermRequest $request)
    {

       $data = $request->except('type');
       $data['type'] = 'terms' ;

       $this->termRepo->create($data);


        return redirect(route('admin.contents.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $content = $this->termRepo->findOne($id);

        return view('dashboard.backend.contents.edit' , compact('content'));

    }


    public function update(TermRequest $request, $id)
    {
        $content = $this->termRepo->findOne($id);
        $data = $request->except('type');
        $data['type'] = 'terms' ;
        $content->update($data);
        return redirect(route('admin.contents.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $content = $this->termRepo->findOne($id)->delete();

               return redirect(route('admin.contents.index'))->with('success', __('models.deleted_successfully'));

    }
}
