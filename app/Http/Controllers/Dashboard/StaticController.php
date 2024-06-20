<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StaticRequest;
use App\Repositories\Sql\StaticPageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StaticController extends Controller
{
    protected $staticRepo ;

    public function __construct(StaticPageRepository $staticRepo)
    {
        $this->middleware('permission:statics-read')->only(['index']);
        $this->middleware('permission:statics-create')->only(['create', 'store']);
        $this->middleware('permission:statics-update')->only(['edit', 'update']);
        $this->middleware('permission:statics-delete')->only(['destroy']);
        $this->staticRepo = $staticRepo ;

    }


    public function get_statics()
    {
        $statics = $this->staticRepo->query()->where('type' , 'static');
        return DataTables($statics)

        ->editColumn('title' , function($static){
            return $static->title;
        })

        ->editColumn('created_at' , function($static){
            return $static->created_at->format('y-m-d');
        })

        ->addColumn('action', 'dashboard.backend.statics.actions')

        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {
        return view('dashboard.backend.statics.index');
    }


    public function create()
    {
         return view('dashboard.backend.statics.create');
    }


    public function store(StaticRequest $request)
    {

       $data = $request->except('img' , 'type');

       $data['type'] = 'static' ;
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('statics');
        }

        $this->staticRepo->create($data);

        return redirect(route('admin.statics.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $static = $this->staticRepo->findOne($id);
        return view('dashboard.backend.statics.edit' , compact('static'));

    }


    public function update(StaticRequest $request, $id)
    {
         $static = $this->staticRepo->findOne($id);
         $data = $request->except('img' );

          if ($request->hasFile('img')) {

            Storage::delete($static->img);

            $data['img'] = $request->file('img')->store('statics');

        } else {
            $data['img'] = $static->img;
        }

        $static->update($data);
        return redirect(route('admin.statics.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $static = $this->staticRepo->findOne($id);

        if ($static->img) {
            Storage::delete($static->img);
        }

        $static->delete();
        return redirect(route('admin.statics.index'))->with('success', __('models.deleted_successfully'));

    }
}
