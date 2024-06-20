<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Models\Role;
use App\Repositories\Sql\RoleRepository;
use App\Repositories\Sql\StockRepository;
use App\Services\Admin\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RoleController extends Controller
{
    protected $roleRepo , $stockRepo , $roleService;

    public function __construct(RoleRepository $roleRepo , StockRepository $stockRepo , RoleService $roleService)
    {

        $this->middleware('permission:roles-read')->only(['index']);
        $this->middleware('permission:roles-create')->only(['create', 'store']);
        $this->middleware('permission:roles-update')->only(['edit', 'update']);
        $this->middleware('permission:roles-delete')->only(['destroy']);

        $this->roleRepo    = $roleRepo ;
        $this->stockRepo   = $stockRepo ;
        $this->roleService = $roleService ;
    }

    public function get_roles()
    {
        return $this->roleService->get_roles();
    }

    public function index()
    {

         return view('dashboard.backend.roles.index');
    }


    public function create()
    {
        $stocks = $this->stockRepo->getAll();
        return view('dashboard.backend.roles.create' , compact('stocks'));
    }


    public function store(RoleRequest $request)
    {

       $data = $request->only('name');
       $this->roleService->add_role($request , $data);
        return redirect(route('admin.roles.index'))->with('success', __('models.added_successfully'));

    }

    public function edit($id)
    {
        $role  = $this->roleRepo->findOne($id);
        $stocks = $this->stockRepo->getAll();
        return view('dashboard.backend.roles.edit' , compact('role' , 'stocks'));

    }


    public function update(RoleRequest $request, $id)
    {
        $role = $this->roleRepo->findOne($id);
        $data = $request->only('name');
        $this->roleService->update_role($request , $data , $role);
        return redirect(route('admin.roles.index'))->with('success', __('models.added_successfully'));

    }


    public function destroy($id)
    {
        $role = $this->roleRepo->findOne($id);
        $this->roleService->deleteRelo($role);
        return redirect(route('admin.roles.index'))->with('success', __('models.deleted_successfully'));

    }


}
