<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Repositories\Sql\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendCodeMail;
use App\Mail\SendPassword;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(AdminRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function showLoginForm()
    {

        return \view('dashboard.auth.login');
    }

    public function login(AuthRequest $request)
    {

        //attempt to log admin
        if (auth('admin')->attempt(['email' => $request->email, 'password' =>$request->password , 'type' => 'admin' ])) {
            return \redirect()->intended(route('admin.home'))->with('success', 'تم تسجيل الدخول بنجاح');
        }else{
            return redirect()->back()->with('error', 'البريد الالكترونى او كلمة المرور غير صحيحة');
        }



    }

    public function logout(Request $request)
    {
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }


    public function forget_password(){
        return view('dashboard.auth.forget');
    }


    public function reset_password(Request $request){

        if(isset($request->email)){
            $details = [
              'title' =>    Str::random(8)
            ];
            Mail::to($request->email)->send(new SendPassword($details));

            return redirect()->back()->with('success', __('تم الارسال عبر الميل'));

        }
    }






}
