<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Mail\SendCodeMail;
use App\Models\SallerProduct;
use App\Repositories\Sql\AdminRepository;
use App\Repositories\Sql\ProductRepository;
use App\Repositories\Sql\ProfitRepository;
use App\Repositories\Sql\PullRepository;
use App\Repositories\Sql\SallerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SallerService
{
    use HelperTrait;
    protected $sallerRepo , $adminRepo , $productRepo , $pullRepo , $profitRepo;

    public function __construct(SallerRepository $sallerRepo , AdminRepository $adminRepo , ProductRepository $productRepo , PullRepository $pullRepo , ProfitRepository $profitRepo)
    {
        $this->sallerRepo = $sallerRepo ;
        $this->adminRepo  = $adminRepo ;
        $this->productRepo= $productRepo ;
        $this->pullRepo   = $pullRepo ;
        $this->profitRepo = $profitRepo ;
    }

    public function get_new_sallers(){

        $sallers = $this->sallerRepo->query()->where('is_active' , 0);
        return $this->columns($sallers);
    }

    public function get_sallers(){

        $sallers = $this->sallerRepo->query()->where('is_active' , 1);
        return $this->columns($sallers);
    }


    public function columns($sallers){
        return DataTables($sallers)
        ->filterColumn('country', function($query , $keyword) {
            $query->whereRelation('country' , 'id' , $keyword);
        })

        ->filterColumn('city', function($query , $keyword) {
            $query->whereRelation('city' , 'id' , $keyword);
        })
        ->editColumn('country' , function($saller){
            return $saller->country->name ;
        })
        ->editColumn('city' , function($saller){
            return $saller->city->name ;
        })
        ->addColumn('action', 'dashboard.backend.sallers.actions')

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_saller(Request $request ){
        $data_admin = $request->only('name' , 'email');
        $data_admin['type'] = 'saller' ;
        $data_admin['password'] = bcrypt($request->password) ;
        $data_admin['email_verified_at'] =  now() ;
        $data_admin['remember_token'] = Str::random(10) ;
        $admin = $this->adminRepo->create($data_admin);
        $this->data_saller($request , $admin);
    }

    public function data_saller($request , $admin){

        $data = $request->except('admin_id' , 'password');
        $this->addImage($request, $data, 'img', 'sallers');
        $this->addImage($request, $data, 'logo', 'sallers');
        $this->addImage($request, $data, 'passport', 'sallers');
        $saller = $admin->saller()->create($data);
        $this->talk_products($saller);
        $this->send_mail($saller , $admin);

    }

    public function talk_products($saller){
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
    }

    public function send_mail($saller , $admin){
        if($saller){
            $details = [
                'title' =>  url('active-saller/' . $admin->id)
            ];
            Mail::to($saller->email)->send(new SendCodeMail($details));
        }
    }

    public function update_saller(Request $request , $saller){
        $data_admin = $request->only('name' , 'email');
        if(request()->has('password') && $request->password != null){
            $data_admin['password'] = bcrypt($request->password);
        }

        $saller->admin->update($data_admin);
        $this->update_saller_data($request , $saller);

    }

    public function update_saller_data($request , $saller){
        $data = $request->except('admin_id' , 'password' , 'id');
        $this->updateImg($request, $data, 'img', 'sallers' , $saller);
        $this->updateImg($request, $data, 'logo', 'sallers' , $saller);
        $this->updateImg($request, $data, 'passport', 'sallers' , $saller);
        $saller->update($data);
    }

    public function delete_saller($saller){

        if ($saller->img) {
            Storage::delete($saller->img);
        }

        $saller->admin()->delete();
    }

    public function change_active($request){
        $saller = $this->sallerRepo->findOne($request->id);

        if($request->is_active == 1){
            $is_active = 1 ;
         }else{
             $is_active = 0 ;
         }

         $saller->update([
             'is_active'    => $is_active
         ]);

         $saller->admin->update([
             'is_active'    => $is_active
         ]);
    }

    public function pulls($saller_id){
        $pulls = $this->pullRepo->query()->where('saller_id', $saller_id);
        return DataTables($pulls)

        ->editColumn('admin' , function($pull){
            return $pull->admin->name;
        })
        ->editColumn('created_at' , function($pull){
            return date('D, d M Y - h:ia', strtotime($pull->created_at));
        })
        ->make(true);
    }

    public function profits($saller_id){
        $profits = $this->profitRepo->query()->where('saller_id', $saller_id);
        return DataTables($profits)

        ->editColumn('admin' , function($profit){
            return $profit->admin->name;
        })
        ->editColumn('order', function($profit) {
            return '<a href="' . route('admin.orders.show', $profit->order_id) . '">'.$profit->order->code.'</a>';
        })
        ->editColumn('created_at' , function($profit){
            return date('D, d M Y - h:ia', strtotime($profit->created_at));
        })
        ->addColumn('action', 'dashboard.backend.profits.actions')
        ->rawColumns(['action' , 'order'])
        ->make(true);
    }

    public function change_verify($admin){
        $admin->update([
            'is_verify' => 1
        ]);


        $admin->saller()->update([
             'is_verify' => 1
        ]);
    }

}
