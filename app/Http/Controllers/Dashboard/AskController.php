<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermRequest;
use App\Repositories\Sql\TermsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AskController extends Controller
{
    protected $askRepo ;

    public function __construct(TermsRepository $askRepo)
    {
        $this->middleware('permission:asks-read')->only(['index']);
        $this->middleware('permission:asks-create')->only(['create', 'store']);
        $this->middleware('permission:asks-update')->only(['edit', 'update']);
        $this->middleware('permission:asks-delete')->only(['destroy']);
        $this->askRepo = $askRepo ;

    }


    public function get_asks()
    {
        $asks = $this->askRepo->query()->where('type' , 'asks');
        return DataTables($asks)
        ->editColumn('name' , function($ask){
            return $ask->name;
        })
        ->editColumn('created_at' , function($ask){
            return $ask->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.asks.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {

         return view('dashboard.backend.asks.index');
    }


    public function create()
    {
         return view('dashboard.backend.asks.create');
    }


    public function store(TermRequest $request)
    {

       $data = $request->except('type');
       $data['type'] = 'asks' ;
       $this->askRepo->create($data);
        return redirect(route('admin.asks.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $ask = $this->askRepo->findOne($id);

        return view('dashboard.backend.asks.edit' , compact('ask'));

    }


    public function update(TermRequest $request, $id)
    {
        $ask = $this->askRepo->findOne($id);
        $data = $request->except('type');
        $data['type'] = 'asks' ;
        $ask->update($data);
        return redirect(route('admin.asks.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
         $ask = $this->askRepo->findOne($id)->delete();

        return redirect(route('admin.asks.index'))->with('success', __('models.deleted_successfully'));

    }
}
