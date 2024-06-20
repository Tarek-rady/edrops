<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Controller;
use App\Repositories\Sql\PayoutRequestRepository;
use App\Repositories\Sql\ProfitRepository;
use App\Repositories\Sql\PullRepository;

class SallerController extends Controller
{


    protected $profitRepo , $pullRepo  , $payoutRepo;

    public function __construct(ProfitRepository $profitRepo , PullRepository $pullRepo , PayoutRequestRepository $payoutRepo)
    {

        $this->profitRepo  = $profitRepo ;
        $this->pullRepo    = $pullRepo ;
        $this->payoutRepo = $payoutRepo ;

    }



    public function get_profits()
    {
        $saller = auth('admin')->user()->saller ;
        $profits = $this->profitRepo->query()->where('saller_id' , $saller->id);
        return DataTables($profits)
        ->editColumn('saller' , function($profit){
            return $profit->saller->name;
        })
        ->editColumn('admin' , function($profit){
            return $profit->admin->name;
        })

        ->editColumn('order' , function($profit){
            return $profit->order->code;
        })

        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })
        ->make(true);

    }

    public function profits()
    {

        return view('dashboard.saller.profits.index');

    }

    public function get_pulls()
    {
        $saller = auth('admin')->user()->saller ;

        $pulls = $this->pullRepo->query()->where('saller_id' , $saller->id);
        return DataTables($pulls)

        ->editColumn('admin' , function($pull){
            return $pull->admin->name;
        })
        ->editColumn('created_at' , function($pull){
            return date('D, d M Y - h:ia', strtotime($pull->created_at));
        })

        ->make(true);

    }


    public function pulls()
    {
         return view('dashboard.saller.pulls.index');
    }

    public function get_payouts()
    {
        $saller = auth('admin')->user()->saller ;
        $payouts = $this->payoutRepo->query()->where('saller_id' , $saller->id );
        return DataTables($payouts)


        ->editColumn('saller' , function($payout){
            return $payout->saller->name;
        })
        ->editColumn('wallet_name' , function($payout){
            return $payout->wallet ? $payout->wallet->name : '';
        })
        ->editColumn('created_at' , function($payout){
            return date('D, d M Y - h:ia', strtotime($payout->created_at));
        })
        ->make(true);

    }

    public function payouts()
    {
        return view('dashboard.saller.payouts.index' );
    }

    public function change_currency($currency_id)
    {
        $saller = auth('admin')->user()->saller;
        $saller->currency = $currency_id;
        $saller->save();

        return redirect()->back()->with('success', __('models.currency_changed_successfully'));;
    }

}
