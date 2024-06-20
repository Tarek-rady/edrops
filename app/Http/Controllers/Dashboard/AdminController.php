<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Role;
use App\Repositories\Sql\AdminRepository;
use App\Repositories\Sql\RoleRepository;
use App\Services\Admin\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminController extends Controller
{

    protected $adminRepo , $roleRepo , $adminService;


    public function __construct(AdminRepository $adminRepo , RoleRepository $roleRepo , AdminService $adminService )
    {

        $this->middleware('permission:admins-read')->only(['index']);
        $this->middleware('permission:admins-create')->only(['create', 'store']);
        $this->middleware('permission:admins-update')->only(['edit', 'update']);
        $this->middleware('permission:admins-delete')->only(['destroy']);
        $this->adminRepo    = $adminRepo ;
        $this->roleRepo     = $roleRepo ;
        $this->adminService = $adminService ;
    }

    public function get_admins()
    {
        return $this->adminService->get_admins();
    }


    public function index()
    {
        $roles = $this->roleRepo->getAll();
        return view('dashboard.backend.admins.index' , compact('roles'));
    }


    public function create()
    {
        $roles = $this->roleRepo->getAll();
        return view('dashboard.backend.admins.create' , compact('roles') );
    }


    public function store(AdminRequest $request)
    {


        $data = $request->except('password' , 'img' , 'email_verified_at' , 'remember_token' , 'role_id' , 'type');
        $this->adminService->add_admin($request , $data);
        return redirect(route('admin.admins.index'))->with('success', __('models.added_successfully'));

    }


    public function edit($id)
    {
        $admin = $this->adminRepo->findOne($id);
        $roles = $this->roleRepo->getAll();

        return view('dashboard.backend.admins.edit' , compact('admin' , 'roles'));
    }


    public function update(AdminRequest $request, $id)
    {
        $admin = $this->adminRepo->findOne($id);
        $data = $request->except('password' , 'img' , 'role_id');

        $this->adminService->update_admin($request , $data , $admin);
        return redirect(route('admin.admins.index'))->with('success', __('models.added_successfully'));
    }


    public function destroy($id)
    {
        $admin = $this->adminRepo->findOne($id);
        if ($admin->img) {
            Storage::delete($admin->img);
        }
        $admin->delete();
        return redirect(route('admin.admins.index'))->with('success', __('models.deleted_successfully'));
    }

    public function profile()
    {
        $admin = Auth::user();
        return view('dashboard.profile' , compact('admin'));
    }

    public function updateProfile(AdminRequest $request)
    {
        $admin = Auth::user();
        $data = $request->except('password' , 'img' );

        $this->adminService->update_admin($request , $data , $admin);


        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
    }

}


