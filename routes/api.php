<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('lang')->group(function () {



    Route::post('/register' , [AuthController::class , 'register']);
    Route::post('/login' , [AuthController::class , 'login']);




    // ========================= routes auth driver ========================================
    Route::middleware('auth:sanctum')->group(function () {

        // auth user

        Route::group(['prefix' => 'user'] , function(){
            Route::post('/update-profile'  , [AuthController::class , 'update_profile']);
            Route::post('/delete-profile'  , [AuthController::class , 'delete_profile']);
            Route::get('/get-profile'      , [AuthController::class , 'get_profile']);
            Route::get('/delete-profile'   , [AuthController::class , 'delete_profile']);
            Route::post('/reset-password'  , [AuthController::class , 'reset_password']);
            Route::post('/change-password' , [AuthController::class , 'change_Password']);
            Route::post('/logout'          , [AuthController::class , 'logout']);

        });


    });
    // ====================== routes not auth ===========================================

     Route::get('home'              , [HomeController::class , 'home']);
     Route::get('setting'           , [HomeController::class , 'setting']);
     Route::get('news'              , [HomeController::class , 'news']);
     Route::get('news-details/{id}' , [HomeController::class , 'news_details']);



















});
