<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\UserRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendCodeMail;

class AuthController extends Controller
{
    protected $userRepository , $countryRepo;

    public function __construct(UserRepository $userRepository , CountryRepository $countryRepo)
    {
        $this->userRepository = $userRepository;
        $this->countryRepo = $countryRepo ;
    }

    public function showregisterForm()
    {

        $countries = $this->countryRepo->getAll() ;
        return view('dashboard.auth.user-register' , compact('countries'));
    }

    public function register(UserRequest $request)
    {


        $fake = Factory::create();
        $data = $request->except('password' , 'code');
        $data['code'] =$fake->unique()->numberBetween(10000000 , 99999999) ;
        $data['password'] = bcrypt($request->password) ;
        $user = $this->userRepository->create($data);
        if($user){
            $details = [
                'title' =>  url('active-user/' . $user->id)
            ];
            Mail::to($user->email)->send(new SendCodeMail($details));
        }
        return redirect(route('user.login'))->with('success', __('models.added_successfully'));
    }

    public function showLoginForm()
    {

        return \view('dashboard.auth.user-login');
    }

    public function login(AuthRequest $request)
    {

        //attempt to log admin

        if (auth()->attempt(['email' => $request->email, 'password' =>$request->password , 'is_active' => 1 , 'is_verify' => 1 ])) {

             return \redirect()->intended(route('user.home'))->with('success', 'تم تسجيل الدخول بنجاح');
            }else{

            return redirect()->route('user.login')->with('error', 'البريد الالكترونى او كلمة المرور غير صحيحة');
        }



    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect()->route('user.login');
    }



    public function profile(){

        $user = auth()->user() ;
        return view('dashboard.user.portfolio.show' , compact('user'));

    }

    public function edit(){

        $user = auth()->user() ;
        $countries = $this->countryRepo->getAll();
        return view('dashboard.user.portfolio.edit' , compact('user' , 'countries'));

    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->findOne($id);
        $fake = Factory::create();
        $data = $request->except('img' , 'password');
        if(request()->has('password') && $request->password != null){
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('img')) {

            Storage::delete($user->img);

            $data['img'] = $request->file('img')->store('users');

        } else {
            $data['img'] = $user->img;
        }

        $user->update($data);
        return redirect(route('user.edit-profile'))->with('success', __('models.updated_successfully'));

    }






}
