<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Sql\ProfitRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfitController extends Controller
{
    protected $profitRepo , $sallerRepo;

    public function __construct(ProfitRepository $profitRepo , SallerRepository $sallerRepo)
    {
        $this->middleware('permission:profits-read')->only(['index']);
        $this->middleware('permission:profits-create')->only(['create', 'store']);
        $this->middleware('permission:profits-update')->only(['edit', 'update']);
        $this->middleware('permission:profits-delete')->only(['destroy']);
        $this->profitRepo = $profitRepo ;
        $this->sallerRepo = $sallerRepo ;

    }


    public function get_profits()
    {
        $profits = $this->profitRepo->query()->where('type' , 'saller');
        return DataTables($profits)
        ->editColumn('saller' , function($profit){
            return '<a href="' . route('admin.sallers.show', $profit->saller_id) . '">'.$profit->saller->name.'</a>';
        })
        ->editColumn('admin' , function($profit){
            return $profit->admin->name;
        })
        ->editColumn('order', function($profit) {
            return '<a href="' . route('admin.orders.show', $profit->order_id) . '">'.$profit->order->code.'</a>';
        })
        ->editColumn('product', function($profit) {
            return '<a href="' . route('admin.products.show', $profit->product_id) . '">'.$profit->product->name.'</a>';
        })
        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })
        ->addColumn('action', 'dashboard.backend.profits.actions')
        ->rawColumns(['action' , 'order' , 'saller' , 'product'])
        ->make(true);

    }

    public function index()
    {
        $sallers = $this->sallerRepo->getAll(); ;
         return view('dashboard.backend.profits.index' , compact('sallers'));
    }






}
