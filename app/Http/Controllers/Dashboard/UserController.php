<?php

namespace App\Http\Controllers\Dashboard;

use App\Exports\UserExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Repositories\Sql\CountryRepository;
use App\Repositories\Sql\UserRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    protected $userRepo , $countryRepo  , $userService;

    public function __construct(UserRepository $userRepo , CountryRepository $countryRepo , UserService $userService )
    {
        $this->middleware('permission:users-read')->only(['index']);
        $this->middleware('permission:users-create')->only(['create', 'store']);
        $this->middleware('permission:users-update')->only(['edit', 'update']);
        $this->middleware('permission:users-delete')->only(['destroy']);
        $this->userRepo    = $userRepo ;
        $this->countryRepo = $countryRepo ;
        $this->userService = $userService ;

    }


    public function get_new_users()
    {
        return $this->userService->get_new_users();
    }

    public function get_users()
    {
       return $this->userService->get_users();

    }

    public function users()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.users.users' , compact('countries'));
    }

    public function index()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.users.index' , compact('countries'));
    }


    public function create()
    {
        $countries = $this->countryRepo->getAll();
        return view('dashboard.backend.users.create' , compact('countries'));
    }


    public function store(UserRequest $request)
    {

       $data = $request->except('img' , 'password' , 'code');
       $this->userService->add_user($request , $data);
        return redirect(route('admin.users.index'))->with('success', __('models.added_successfully'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = $this->userRepo->findOne($id);
        $countries = $this->countryRepo->getAll();

        return view('dashboard.backend.users.edit' , compact('user' , 'countries'));

    }


    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepo->findOne($id);
        $data = $request->except('img' , 'password');
        $this->userService->update_user($request , $data , $user);
        return redirect(route('admin.users.index'))->with('success', __('models.updated_successfully'));

    }


    public function destroy($id)
    {
        $user = $this->userRepo->findOne($id);
        $this->userService->delete_user($user);
        return redirect(route('admin.users.index'))->with('success', __('models.deleted_successfully'));

    }


    public function changeActiveUser(Request $request){
        $user = $this->userRepo->findOne($request->id);

        $this->userService->change_active($user , $request);

        return response()->json(['success' => __('models.status_update')]);
    }


    public function export()
    {
        return Excel::download(new UserExport, 'users.xlsx');
    }

    public function finish_page($id){
        $user = $this->userRepo->findOne($id);

        $user->update([
           'is_verify' => 1
        ]);
        return view('dashboard.backend.users.finish');
    }
}
