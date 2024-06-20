<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Sql\PayoutRequestRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PayoutRequestController extends Controller
{
    protected $payoutRepo , $sallerRepo;

    public function __construct(PayoutRequestRepository $payoutRepo , SallerRepository $sallerRepo)
    {
        $this->middleware('permission:payout_requests-read')->only(['index']);
        $this->middleware('permission:payout_requests-create')->only(['create', 'store']);
        $this->middleware('permission:payout_requests-update')->only(['edit', 'update']);
        $this->middleware('permission:payout_requests-delete')->only(['destroy']);
        $this->payoutRepo  = $payoutRepo ;
        $this->sallerRepo = $sallerRepo ;

    }


    public function get_payouts()
    {
        $payouts = $this->payoutRepo->query()->where('type' , 'saller');
        return DataTables($payouts)

        ->filterColumn('saller', function($query , $keyword) {
            $query->whereRelation('saller' , 'id' , $keyword);
        })
        ->editColumn('saller' , function($payout){
            return $payout->saller->name;
        })
        ->editColumn('wallet_name' , function($payout){
            return $payout->wallet ? $payout->wallet->name : '';
        })
        ->editColumn('created_at' , function($payout){
            return date('D, d M Y - h:ia', strtotime($payout->created_at));
        })
        ->addColumn('action', 'dashboard.backend.payouts.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function index()
    {
        $sallers = $this->sallerRepo->getAll();
        return view('dashboard.backend.payouts.index' , compact('sallers'));
    }

    public function update(Request $request, $id)
    {
        $payout = $this->payoutRepo->findOne($id);

        $payout->update([
            'status' => $request->status
        ]);

        if($request->status == 'accept'){
            $saller = $this->sallerRepo->findWhere(['id' => $payout->saller_id]);
             return view('dashboard.backend.pulls.edit' , compact('payout' , 'saller'));
        }
        return redirect(route('admin.payouts.index'))->with('success', __('models.updated_successfully'));

    }



}
