<?php

namespace App\Services\Admin;
use App\Http\Controllers\Dashboard\HelperTrait;
use App\Repositories\Sql\UserRepository;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendCodeMail;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use HelperTrait;
    protected $userRepo ;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo    = $userRepo ;
    }

    public function get_new_users(){
        $users = $this->userRepo->query()->where('is_active' , 0);
        return $this->columns($users);
    }

    public function get_users(){
        $users = $this->userRepo->query()->where('is_active' , 1);
        return $this->columns($users);
    }


    public function columns($users){
        return DataTables($users)
        ->filterColumn('country', function($query , $keyword) {
            $query->whereRelation('country' , 'id' , $keyword);
        })

        ->filterColumn('city', function($query , $keyword) {
            $query->whereRelation('city' , 'id' , $keyword);
        })
        ->editColumn('country' , function($user){
            return $user->country->name ;
        })
        ->editColumn('city' , function($user){
            return $user->city->name ;
        })
        ->addColumn('action', 'dashboard.backend.users.actions')

        ->rawColumns(['action'])
        ->make(true);
    }

    public function add_user(Request $request , $data){
        $fake = Factory::create();
        $data['code'] =  $fake->numberBetween(10000000 , 99999999) ;
        $this->addImage($request, $data, 'img', 'users');
        $data['password'] = bcrypt($request->password) ;
        $user = $this->userRepo->create($data);
        $this->send_mail($user);


    }

    public function send_mail($user){
        if($user){
            $details = [
                'title' =>  url('active-user/' . $user->id)
            ];
            Mail::to($user->email)->send(new SendCodeMail($details));
        }
    }

    public function update_user(Request $request , $data , $user){
        $this->updateImg($request, $data, 'img', 'users' , $user);
        if(request()->has('password') && $request->password != null){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
    }

    public function delete_user($user){
        if ($user->img) {
            Storage::delete($user->img);
        }
        $user->delete();
    }

    public function change_active($user , $request){
        if($request->is_active == 1){
            $is_active = 1 ;
         }else{
             $is_active = 0 ;
         }
         $user->update([
             'is_active'    => $is_active
         ]);

    }


}
