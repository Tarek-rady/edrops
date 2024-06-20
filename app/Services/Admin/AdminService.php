<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class AdminService
{
    use HelperTrait;
    protected $adminRepo ;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo    = $adminRepo ;
    }

    public function get_admins(){

        $admins = $this->adminRepo->query()->where('type' , 'admin');
        return $this->columns($admins);
    }

    public function columns($admins){
        return DataTables($admins)

        ->editColumn('roles', function ($admin) {
            return $admin->roles->map(function ($admin_roles) {
                return '<span class="badge rounded-pill bg-info">' . $admin_roles->name . '</span><br>';
            })->implode('');
        })


        ->editColumn('created_at' , function($admin){
            return '<span class="badge rounded-pill border border-light text-body">'.$admin->created_at->format('y-m-d').'</span>';

        })
        ->addColumn('action', 'dashboard.backend.admins.actions')

        ->rawColumns(['action' , 'roles'  , 'created_at'])
        ->make(true);
    }

    public function add_admin(Request $request , $data){
        $data['type'] = 'admin' ;
        $data['password'] = bcrypt($request->password) ;
        $data['email_verified_at'] =  now() ;
        $data['remember_token'] = Str::random(10) ;
        $this->addImage($request, $data, 'img', 'admins');
        $admin =$this->adminRepo->create($data);
        $this->roles($request , $admin);

    }


    public function update_admin(Request $request , $data , $admin){

        if(request()->has('password') && $request->password != null){
            $data['password'] = bcrypt($request->password);
        }

        $this->updateImg($request, $data, 'img', 'admins' , $admin);
        $admin->update($data);
        $this->roles($request , $admin);
    }


    public function roles($request , $admin){
        if(isset($request->role_id)){
            $admin->syncRoles(['admin' => $request->role_id]);
        }
    }

    public function update_profile(){

    }


}
