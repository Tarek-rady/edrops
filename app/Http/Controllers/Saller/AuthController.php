<?php

namespace App\Http\Controllers\Saller;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Requests\Admin\SallerRequest;
use App\Http\Requests\Saller\RegisterRequest;
use App\Http\Requests\Saller\UpdateprofileRequest;
use App\Models\City;
use App\Repositories\Sql\AdminRepository;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeMail;
use App\Models\SallerProduct;
use App\Repositories\Sql\ProductRepository;

class AuthController extends Controller
{
    protected $adminRepo , $countryRepo , $sallerRepo , $productRepo;

    public function __construct(AdminRepository $adminRepo , CountryRepository $countryRepo , SallerRepository $sallerRepo , ProductRepository $productRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->countryRepo    = $countryRepo;
        $this->sallerRepo      = $sallerRepo;
        $this->productRepo      = $productRepo;
    }

    public function showregisterForm()
    {

        $countries = $this->countryRepo->getAll() ;
        return view('dashboard.auth.saller-register' , compact('countries'));
    }

    public function register(SallerRequest $request)
    {

        $data_admin = $request->only('name' , 'email');
        $data_admin['type'] = 'saller' ;
        $data_admin['password'] = bcrypt($request->password) ;
        $data_admin['email_verified_at'] =  now() ;
        $data_admin['remember_token'] = Str::random(10) ;
        $admin =$this->adminRepo->create($data_admin);

        $data = $request->except('admin_id' , 'password');
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('sallers');
        }

        if ($request->hasFile('passport')) {
            $data['passport'] = $request->file('passport')->store('sallers');
        }

        $saller =  $admin->saller()->create($data);


        $products = $this->productRepo->getWhere(['type' => 'public']);

        if(isset($products)){
            foreach ($products as $product) {
               SallerProduct::create([
                'product_id' => $product->id ,
                'saller_id'  => $saller->id ,
                'type'       => 'products' ,
               ]);
            }
        }
        if($saller){
            $details = [
                'title' =>  url('active-saller/' . $admin->id)
            ];
            Mail::to($saller->email)->send(new SendCodeMail($details));
        }


        return redirect(route('saller.login'))->with('success', __('models.added_successfully'));
    }

    public function showLoginForm()
    {

        return view('dashboard.auth.saller-login');
    }

    public function login(AuthRequest $request)
    {

        //attempt to log admin
        if (auth('admin')->attempt(['email' => $request->email, 'password' =>$request->password , 'type' => 'saller' , 'is_active' => 1 ,'is_verify' => 1 ])) {
            return \redirect()->intended(route('saller.home'))->with('success', 'تم تسجيل الدخول بنجاح');
        }else{
            return redirect()->back()->with('error', 'البريد الالكترونى او كلمة المرور غير صحيحة');
        }



    }

    public function logout(Request $request)
    {
        auth('admin')->logout();
        return redirect()->route('saller.login');
    }


    public function country_cities($country_id) {
       return   City::where('country_id' , $country_id)->pluck('name_ar' , 'id');
    }


    public function profile(){
        $admin = auth('admin')->user();
        $saller = $admin->saller ;
        return view('dashboard.saller.portfolio.show' , compact('saller'));

    }

    public function edit(){
        $admin = auth('admin')->user();
        $saller = $admin->saller ;
        $countries = $this->countryRepo->getAll();
        return view('dashboard.saller.portfolio.edit' , compact('saller' , 'countries'));

    }

    public function update(UpdateprofileRequest $request, $id)
    {

        $saller = $this->sallerRepo->findOne($id);
        $data_admin = $request->only('name' , 'email');
        if(request()->has('password') && $request->password != null){
            $data_admin['password'] = bcrypt($request->password);
        }
        $saller->admin->update($data_admin);

        $data = $request->except('admin_id' , 'password' , 'id' , 'logo' , 'passport' , 'img');


        if ($request->hasFile('img') && $saller->img) {

            Storage::delete($saller->img);

            $data['img'] = $request->file('img')->store('sallers');

        } else {
            $data['img'] = $request->img ?  $request->file('img')->store('sallers') : null;
        }


        if ($request->hasFile('logo') && $saller->logo) {

            Storage::delete($saller->logo);

            $data['logo'] = $request->file('logo')->store('sallers');

        } else {
            $data['logo'] =  $request->logo ? $request->file('logo')->store('sallers') : null;
        }

        if ($request->hasFile('passport') && $saller->passport) {

            Storage::delete($saller->passport);

            $data['passport'] = $request->file('passport')->store('sallers');

        } else {
            $data['passport'] =  $request->passport ? $request->file('passport')->store('sallers') : null;
        }

        $saller->update($data);
        return redirect(route('saller.home'))->with('success', __('models.updated_successfully'));

    }

}
