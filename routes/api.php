<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AdminController;

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

Route::group([

    'middleware' => 'api',

], function ($router) {

    // Route::post('login', [AuthController::class,'login']);
    // Route::post('register', [AuthController::class,'register']);
    // Route::post('logout', [AuthController::class,'logout']);
    // Route::post('/check_otp',[AuthController::class,'check_otp']);
    // Route::post('/setnewpassword',[AuthController::class,'setnewpassword']);
    // Route::post('/forgetmail',[AuthController::class,'forgetmail']);
    // Route::post('/updatePassword',[AuthController::class,'updatePassword']);
    // Route::get('/forgetPassword',[AuthController::class,'forgetPage']);
    // Route::get('/verify',[AuthController::class,'fillotp']);
    // Route::get('/changePassword',[AuthController::class,'setPass']);
    // Route::get('/register',[AuthController::class,'registerPage']);
    // Route::get('/login',[AuthController::class,'loginPage']);



});
// Route::get('/user',[DataController::class,'getdata']);

// Route::post('upload', [DataController::class,'upload']);


Route::middleware(['admin'])->group(function () {
    // Admin-only routes
//     Route::get('/users', [AdminController::class,'userdata']);
// Route::get('/userdata/{id}', [AdminController::class,'showFiles']);
// Route::get('/download/{filename}', [AdminController::class,'download']);
// Route::get('/userdata/{id}/status/{status}',[AdminController::class,'updateStatus']);
// Route::get('/userdata/{id}/view', [AdminController::class,'viewFile']);
    // ...
});

Route::post('/updateprofile',[AuthController::class,'updateProfile']);

