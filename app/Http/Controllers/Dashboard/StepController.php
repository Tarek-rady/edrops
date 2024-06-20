<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StepRequest;
use App\Repositories\Sql\StaticPageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StepController extends Controller
{
    protected $stepRepo ;

    public function __construct(StaticPageRepository $stepRepo)
    {
        $this->middleware('permission:steps-read')->only(['index']);
        $this->middleware('permission:steps-create')->only(['create', 'store']);
        $this->middleware('permission:steps-update')->only(['edit', 'update']);
        $this->middleware('permission:steps-delete')->only(['destroy']);
        $this->stepRepo = $stepRepo ;

    }


    public function get_steps()
    {
        $steps = $this->stepRepo->query()->where('type' , 'step');
        return DataTables($steps)
        ->editColumn('title' , function($step){
            return $step->title;
        })
        ->editColumn('created_at' , function($step){
            return $step->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.steps.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {

         return view('dashboard.backend.steps.index');
    }


    public function create()
    {
         return view('dashboard.backend.steps.create');
    }


    public function store(StepRequest $request)
    {

       $data = $request->except('img' , 'type');
       $data['type'] = 'step' ;
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('steps');
        }
        $this->stepRepo->create($data);
        return redirect(route('admin.steps.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $step = $this->stepRepo->findOne($id);

        return view('dashboard.backend.steps.edit' , compact('step'));

    }


    public function update(StepRequest $request, $id)
    {
         $step = $this->stepRepo->findOne($id);
         $data = $request->except('img' );

          if ($request->hasFile('img')) {

            Storage::delete($step->img);

            $data['img'] = $request->file('img')->store('steps');

        } else {
            $data['img'] = $step->img;
        }

        $step->update($data);
        return redirect(route('admin.steps.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $step = $this->stepRepo->findOne($id);

        if ($step->img) {
            Storage::delete($step->img);
        }

        $step->delete();

        return redirect(route('admin.steps.index'))->with('success', __('models.deleted_successfully'));

    }
}
