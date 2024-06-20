<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Sql\ProfitAppRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfitAppController extends Controller
{
    protected $profitRepo ;

    public function __construct(ProfitAppRepository $profitRepo)
    {
        $this->middleware('permission:profitApps-read')->only(['index']);
        $this->middleware('permission:profitApps-create')->only(['create', 'store']);
        $this->middleware('permission:profitApps-update')->only(['edit', 'update']);
        $this->middleware('permission:profitApps-delete')->only(['destroy']);
        $this->profitRepo = $profitRepo ;

    }


    public function get_profits()
    {
        $profits = $this->profitRepo->query();
        return DataTables($profits)
        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })
        ->editColumn('product' , function($profit){
            return '<a class="breadcrumb-item"" href="' . route('admin.products.show', $profit->product_id) . '">'.$profit->product->name.'</a>';
        })

        ->rawColumns(['product'])
        ->make(true);

    }

    public function index()
    {

        return view('dashboard.backend.profits-app.index');

    }




}
