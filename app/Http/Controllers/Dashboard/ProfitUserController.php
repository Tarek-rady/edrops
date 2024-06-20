<?php

namespace App\Http\Controllers\Dashboard;

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
        $this->middleware('permission:profits-read')->only(['index']);
        $this->middleware('permission:profits-create')->only(['create', 'store']);
        $this->middleware('permission:profits-update')->only(['edit', 'update']);
        $this->middleware('permission:profits-delete')->only(['destroy']);
        $this->profitRepo = $profitRepo ;
        $this->pullRepo   = $pullRepo ;
        $this->payoutRepo = $payoutRepo ;
        $this->userRepo = $userRepo ;
    }


    public function get_profits()
    {
        $profits = $this->profitRepo->query()->where('type' , 'user');
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
        ->editColumn('order', function($profit) {
            return '<a href="' . route('admin.orders.show', $profit->order_id) . '">'.$profit->order->code.'</a>';
        })
        ->editColumn('product', function($profit) {
            return '<a href="' . route('admin.products.show', $profit->product_id) . '">'.$profit->product->name.'</a>';
        })
        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })

        ->rawColumns([ 'product' , 'order'])
        ->make(true);

    }

    public function index()
    {
        $users = $this->userRepo->getAll();

        return view('dashboard.backend.user-profits.index' , compact('users'));
    }

    public function get_pulls()
    {
        $pulls = $this->pullRepo->query()->where('type' , 'user');
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
        $users = $this->userRepo->getAll();

         return view('dashboard.backend.user-pulls.index' , compact('users'));
    }



    public function store(Request $request){
        $data = $request->only('pull' , 'amount');
        $data['user_id'] = $request->user_id ;
        $data['admin_id'] = auth('admin')->user()->id;
        $data['type']  = 'user' ;
        $this->pullRepo->create($data);

        $user = $this->userRepo->findWhere(['id' => $request->user_id]);
        $user->update([
           'amount' => $user->amount - $request->pull
        ]);

        return redirect(route('admin.user-pulls'))->with('success', __('models.updated_successfully'));
    }


    public function get_payouts()
    {
        $payouts = $this->payoutRepo->query()->where('type' , 'user');
        return DataTables($payouts)

        ->filterColumn('user', function($query , $keyword) {
            $query->whereRelation('user' , 'id' , $keyword);
        })
        ->editColumn('user' , function($payout){
            return $payout->user->name;
        })

        ->editColumn('wallet_name' , function($payout){
            return $payout->wallet ?$payout->wallet->name : '';
        })
        ->editColumn('created_at' , function($payout){
            return date('D, d M Y - h:ia', strtotime($payout->created_at));
        })
        ->addColumn('action', 'dashboard.backend.user-payouts.actions')
        ->rawColumns(['action'])
        ->make(true);

    }

    public function payouts()
    {
        $users = $this->userRepo->getAll();
        return view('dashboard.backend.user-payouts.index' , compact('users'));
    }

    public function update(Request $request, $id)
    {
        $payout = $this->payoutRepo->findOne($id);

        $payout->update([
            'status' => $request->status
        ]);

        $user = $this->userRepo->findWhere(['id' => $payout->user_id]);


        if($request->status == 'accept'){
           return view('dashboard.backend.user-pulls.edit' , compact('payout' , 'user'));
        }

        return redirect(route('admin.user-payouts'))->with('success', __('models.updated_successfully'));

    }
}
