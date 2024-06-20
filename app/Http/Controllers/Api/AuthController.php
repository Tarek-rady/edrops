<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\Api\UserResource;
use App\Repositories\Sql\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Requests\Api\ChangePassRequest;
use App\Http\Requests\Api\ForgetPassRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    use ApiResponseTrait ;
    protected $userRepo;

    public function __construct(UserRepository $userRepo )
    {
        $this->userRepo = $userRepo ;
    }


    public function register(RegisterRequest $request){
        $data = $request->except('password', 'email_verified_at', 'remember_token' , 'img');

        $data['email_verified_at'] =  now();
        $data['remember_token'] = Str::random(10);
        $data['password'] = bcrypt($request->password);
        if ($request->hasFile('img')) {
            $data['img'] = $request->file('img')->store('users');
        }
        $user = $this->userRepo->create($data);



        $token = $user->createToken('tokens')->plainTextToken;


        $data = [
            'user' => new UserResource($user),
            'token'  => $token
        ];

        return $this->ApiResponse($data, 'user created successfully', 200);
    }



    public function login(LoginRequest $request)
    {

        if($request->type == 'email'){

            $user = $this->userRepo->getWhere([ ['email' , $request->email]  , ['is_active' , 0 ]])->first();
            if ($user &&  Hash::check($request->password, $user->password)) {

                $token = $user->createToken('token')->plainTextToken;


                $data = [
                    'user' => new UserResource($user),
                    'token'  => $token
                ];

                return $this->ApiResponse($data, 'user login successfully', 200);
            }else{

                return $this->ApiResponse(null ,'Email & Password does not match with our record.', 403);
            }

        }elseif($request->type == 'gmail' ){


            $user = $this->userRepo->getWhere([ ['email' , $request->email]  , ['is_active' , 0 ] , ['uid' , $request->uid ]])->first();


            if($user){
                $token = $user->createToken('token')->plainTextToken;
                $data = [
                    'user' => new UserResource($user),
                    'token'  => $token
                ];

                return $this->ApiResponse($data, 'user login successfully', 200);
            }else{
                return $this->notFoundResponse();

            }

        }

    }


    public function update_profile(UpdateUserRequest $request)
    {
        $user = $this->userRepo->findWhere(['id' => auth()->user()->id]);

        if ($user) {

            $data = $request->except('img');

            if ($request->hasFile('img')) {
                if($user->img){
                    Storage::delete($user->img);
                    $data['img'] = $request->file('img')->store('users');
                }else{
                    $data['img'] = $request->file('img')->store('users');
                }

            } else {
                $data['img'] = $user->img;
            }
            $user->update($data);
            $token = $user->createToken('tokens')->plainTextToken;

            $data = [
                'user' => new UserResource($user),
                'token'  => $token
            ];

            return $this->ApiResponse($data, 'user update successfully', 200);
        }
    }


    public function get_profile()
    {



        $user = $this->userRepo->findWhere(['id' => auth()->user()->id]);


        if ($user) {
            return $this->ApiResponse(new UserResource($user), 'user found successfully', 200);
        } else {
            return $this->notFoundResponse();
        }
    }


    public function reset_password(ForgetPassRequest $request)
    {

        $user = $this->userRepo->findWhere(['id' => auth()->user()->id]);

        if ($user) {

            $user->update(['password' => bcrypt($request->password)]);
            return $this->ApiResponse(true, 'password update successfully', 200);
        } else {
            return $this->notFoundResponse();
        }
    }

    public function change_Password(ChangePassRequest $request)
    {

        $user = auth()->user();

        if ($user) {

            if (Hash::check($request->old_password, $user->password) ){
                $user->update(['password' => bcrypt($request->password)]);

                $user = $this->userRepo->findWhere(['id' => auth()->user()->id]);
                $token = $user->createToken('token')->plainTextToken;



                $data = [
                    'user' => new UserResource($user),
                    'token'  => $token
                ];

                return $this->ApiResponse($data, __('api.change_password_success'), 200);
            } else {

                return $this->ApiResponse(null, __('api.old_password_not_found'), 422);
            }
        } else {

            return $this->ApiResponse(null, __('api.token_not_found'), 404);
        } // end of else user

    } // end of change password

    public function delete_profile()
    {
        $user = $this->userRepo->findWhere(['id' => auth()->user()->id]);

        if ($user) {

            $user->delete();
            return $this->ApiResponse(true, 'account deleted successfully', 200);
        } else {
            return $this->notFoundResponse();
        }
    }

    public function logout(Request $request)
    {

        $token =  $request->user()->tokens()->delete();
        return $this->ApiResponse(true, 'user logout successfully');
    }




}
