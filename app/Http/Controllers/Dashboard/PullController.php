<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Sql\PullRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PullController extends Controller
{
    protected $pullRepo , $sallerRepo;

    public function __construct(PullRepository $pullRepo , SallerRepository $sallerRepo)
    {
        $this->middleware('permission:pulls-read')->only(['index']);
        $this->middleware('permission:pulls-create')->only(['create', 'store']);
        $this->middleware('permission:pulls-update')->only(['edit', 'update']);
        $this->middleware('permission:pulls-delete')->only(['destroy']);
        $this->pullRepo   = $pullRepo ;
        $this->sallerRepo = $sallerRepo ;

    }


    public function get_pulls()
    {
        $pulls = $this->pullRepo->query()->where('type' , 'saller');
        return DataTables($pulls)
        ->filterColumn('saller', function ($query, $keyword) {
            $query->whereRelation('saller', 'id', $keyword);
        })
        ->editColumn('saller' , function($pull){
            return '<a class="breadcrumb-item"" href="' . route('admin.sallers.show', $pull->saller_id) . '">'.$pull->saller->name.'</a>';
        })
        ->editColumn('admin' , function($pull){
            return $pull->admin->name;
        })
        ->editColumn('created_at' , function($pull){
            return date('D, d M Y - h:ia', strtotime($pull->created_at));
        })

        ->rawColumns([ 'saller'])
        ->make(true);

    }

    public function index()
    {

        $sallers = $this->sallerRepo->getAll();
        return view('dashboard.backend.pulls.index' , compact('sallers'));
    }


    public function edit($id)
    {
        $saller = $this->sallerRepo->findOne($id);
        return view('dashboard.backend.pulls.edit' , compact('saller'));
    }


    public function store(Request $request){
        $data = $request->only('pull' , 'amount');
        $data['saller_id'] = $request->saller_id ;
        $data['admin_id'] = auth('admin')->user()->id;
        $data['type']  = 'saller' ;
        $this->pullRepo->create($data);

        $saller = $this->sallerRepo->findOne($request->saller_id);
        $saller->update([
           'amount' => $saller->amount - $request->pull
        ]);

        return redirect(route('admin.pulls.index'))->with('success', __('models.updated_successfully'));
    }














}
