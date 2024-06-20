<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\RoleRepository;
use Illuminate\Http\Request;

class RoleService
{
    use HelperTrait;
    protected $roleRepo ;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo    = $roleRepo ;
    }

    public function get_roles(){
        $roles = $this->roleRepo->query();
        return $this->columns($roles);
    }

    public function columns($roles){
        return DataTables($roles)
        ->editColumn('created_at' , function($role){
            return $role->created_at->format('y-m-d');
        })
        ->addColumn('action', 'dashboard.backend.roles.actions')
        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_role(Request $request , $data){
        $role = $this->roleRepo->create($data);
        $this->permissions($request , $role);
        $this->stocks($request , $role);
    }

    public function update_role(Request $request , $data , $role){

        $role->update($data);
        $this->permissions($request , $role);
        $this->stocks($request , $role);
    }

    public function permissions($request , $role){
        if(isset($request->permissions)){
            $role->syncPermissions($request->permissions);
        }
    }

    public function stocks($request , $role){
        if(isset($request->stocks)){
            $role->stocks()->Sync($request->stocks);
        }
    }

    public function deleteRelo($role){
       if($role->stocks() != null){
          $role->stocks()->delete();
          $role->delete();
       }
    }


}
