<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StepRequest;
use App\Repositories\Sql\StaticPageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FeautureController extends Controller
{
    protected $feautureRepo ;

    public function __construct(StaticPageRepository $feautureRepo)
    {
        $this->middleware('permission:feautures-read')->only(['index']);
        $this->middleware('permission:feautures-create')->only(['create', 'store']);
        $this->middleware('permission:feautures-update')->only(['edit', 'update']);
        $this->middleware('permission:feautures-delete')->only(['destroy']);
        $this->feautureRepo = $feautureRepo ;

    }


    public function get_feautures()
    {
        $feautures = $this->feautureRepo->query()->where('type' , 'feauture');
        return DataTables($feautures)
        ->editColumn('title' , function($feauture){
            return $feauture->title;
        })
        ->editColumn('created_at' , function($feauture){
            return $feauture->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.feautures.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {

        return view('dashboard.backend.feautures.index');
    }


    public function create()
    {
         return view('dashboard.backend.feautures.create');
    }


    public function store(StepRequest $request)
    {

       $data = $request->except('img' , 'type');

       $data['type'] = 'feauture' ;
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('feautures');
        }

        $this->feautureRepo->create($data);

        return redirect(route('admin.feautures.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $feauture = $this->feautureRepo->findOne($id);
        return view('dashboard.backend.feautures.edit' , compact('feauture'));

    }


    public function update(StepRequest $request, $id)
    {
         $feauture = $this->feautureRepo->findOne($id);
         $data = $request->except('img' );

          if ($request->hasFile('img')) {

            Storage::delete($feauture->img);

            $data['img'] = $request->file('img')->store('feautures');

        } else {
            $data['img'] = $feauture->img;
        }

        $feauture->update($data);
        return redirect(route('admin.feautures.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $feauture = $this->feautureRepo->findOne($id);

        if ($feauture->img) {
            Storage::delete($feauture->img);
        }

        $feauture->delete();

               return redirect(route('admin.feautures.index'))->with('success', __('models.deleted_successfully'));

    }
}
