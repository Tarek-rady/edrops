<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PayoutRequest;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\PayoutRequest as PayoutRequestModel;

class WalletController extends Controller
{
    use ApiResponseTrait ;

    public function index() {
        $user = auth()->user();
        $wallets = $user->country->wallets;

        return view('dashboard.user.wallet.index', compact('user', 'wallets'));
    }



    public function payout_request(PayoutRequest $request){

        $user = auth()->user();

        $payout = new PayoutRequestModel();
        $payout->user_id = $user->id;
        $payout->amount = $request->amount;
        $payout->method = $request->method;
        $payout->type = 'user';

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
