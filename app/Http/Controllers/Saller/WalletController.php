<?php

namespace App\Http\Controllers\saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Saller\PayoutRequest;
use App\Models\Wallet;
use App\Models\PayoutRequest as PayoutRequestModel;

class WalletController extends Controller
{
    use ApiResponseTrait ;

    public function index() {
        $admin = auth('admin')->user();
        $seller = $admin->saller;
        $wallets = $seller->country->wallets;

       

        return view('dashboard.saller.wallet.index', compact('seller', 'wallets'));
    }

    public function my_payouts() {

        $seller = auth('admin')->user()->saller;
        $payouts = PayoutRequestModel::where('saller_id', $seller->id)->get();

        return DataTables($payouts)
            ->editColumn('status' , function($payout){
                return '<span class="badge rounded-pill border border-light text-body">'. __("models.".$payout->status) .'</span>';

            })
            ->editColumn('created_at' , function($payout){
                return '<span class="badge rounded-pill border border-light text-body">'.$payout->created_at->diffForHumans().'</span>';

            })
            ->rawColumns(['status', 'created_at'])
            ->make(true);
    }

    public function payout_request(PayoutRequest $request){

        $seller = auth('admin')->user()->saller;

        $payout = new PayoutRequestModel();
        $payout->saller_id = $seller->id;
        $payout->amount = $request->amount;
        $payout->method = $request->method;
        $payout->type = 'saller';

        if($request->method == 'bank') {
            $payout->account_holder_name = $request->account_holder_name;
            $payout->iban = $request->iban;
            $payout->swift_code = $request->swift_code;

        }elseif($request->method == 'wallet') {
            $payout->wallet_name = $request->wallet_name;
            $payout->wallet_no = $request->wallet_no;

        }else {
            $payout->english_name = $request->english_name;
            $payout->phone = $request->phone;
            $payout->country = $request->country;
            $payout->city = $request->city;
        }

        $payout->save();

        return response([
            'success' => true,
            'message' => 'تم إرسال طلبك بنجاح'
        ]);

    }

}
