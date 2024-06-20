<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\AdminRepository;
use Illuminate\Http\Request;

class UserRepo
{
    use HelperTrait;
    protected $adminRepo ;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepo    = $adminRepo ;
    }

    public function get_admins(){

        $admins = $this->adminRepo->query();
        return $this->columns($admins);
    }

    public function columns($admins){
        return DataTables($admins)

        ->editColumn('created_at' , function($admin){
            return $admin->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.admins.actions')
        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_admin(Request $request , $data){
        $this->addImage($request, $data, 'img', 'admins');
        $admin =$this->adminRepo->create($data);
    }

    public function update_admin(Request $request , $data , $admin){
        $this->updateImg($request, $data, 'img', 'admins' , $admin);
        $admin->update($data);
    }


}
