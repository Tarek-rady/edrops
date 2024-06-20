<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Sql\ProfitRepository;
use App\Repositories\Sql\PullRepository;
use App\Repositories\Sql\PayoutRequestRepository;
use App\Repositories\Sql\UserRepository;

class ProfitUserController extends Controller
{



    protected $profitRepo , $pullRepo , $payoutRepo , $userRepo;
    public function __construct(ProfitRepository $profitRepo , PullRepository $pullRepo , UserRepository $userRepo , PayoutRequestRepository $payoutRepo)
    {

        $this->profitRepo = $profitRepo ;
        $this->pullRepo   = $pullRepo ;
        $this->payoutRepo = $payoutRepo ;
        $this->userRepo = $userRepo ;
    }


    public function get_profits()
    {
        $user = auth()->user();
        $profits = $this->profitRepo->query()->where('type' , 'user')->where('user_id' , $user->id);
        return DataTables($profits)
        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })
        ->editColumn('user' , function($profit){
            return $profit->user->name;
        })
        ->editColumn('admin' , function($profit){
            return $profit->admin->name;
        })
        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })
        ->make(true);

    }

    public function index()
    {

        return view('dashboard.user.user-profits.index');
    }

    public function get_pulls()
    {
        $user = auth()->user();
        $pulls = $this->pullRepo->query()->where('type' , 'user')->where('user_id' , $user->id);
        return DataTables($pulls)
        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })
        ->editColumn('user' , function($pull){
            return $pull->user->name;
        })
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

         return view('dashboard.user.user-pulls.index' );
    }


    public function get_payouts()
    {
        $user = auth()->user();
        $payouts = $this->payoutRepo->query()->where('type' , 'user')->where('user_id' , $user->id);
        return DataTables($payouts)

        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })
        ->editColumn('user' , function($payout){
            return $payout->user->name;
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
        $users = $this->userRepo->getAll();
        return view('dashboard.user.user-payouts.index' , compact('users'));
    }

    public function update(Request $request, $id)
    {
        $payout = $this->payoutRepo->findOne($id);

        $payout->update([
            'status' => $request->status
        ]);
        return redirect(route('admin.payouts.index'))->with('success', __('models.updated_successfully'));

    }
}
