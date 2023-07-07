<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


    // your routes here
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::get('logout', [AuthController::class,'logout']);
    Route::post('/check_otp',[AuthController::class,'check_otp']);
    Route::post('/setnewpassword',[AuthController::class,'setnewpassword']);
    Route::post('/forgetmail',[AuthController::class,'forgetmail']);
    Route::post('/updatePassword',[AuthController::class,'updatePassword']);
    Route::get('/forgetPassword',[AuthController::class,'forgetPage']);
    Route::get('/verify',[AuthController::class,'fillotp']);
    Route::get('/changePassword',[AuthController::class,'setPass']);
    Route::get('/register',[AuthController::class,'registerPage']);
    Route::get('/login',[AuthController::class,'loginPage']);





Route::middleware(['role:0'])->group(function () {
    Route::get('/users', [AdminController::class,'userdata']);
Route::get('/userdata/{id}', [AdminController::class,'showFiles']);
Route::get('/download/{filename}', [AdminController::class,'download']);
Route::get('/userdata/{id}/status/{status}',[AdminController::class,'updateStatus']);
Route::get('/userdata/{id}/view', [AdminController::class,'viewFile']);
});

Route::middleware(['role:1'])->group(function () {
   
    Route::get('/user',[DataController::class,'getdata']);
    Route::post('/upload', [DataController::class,'upload']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('updateprofle', [AuthController::class,'updateProfile']);
    Route::get('updatepage', [AuthController::class,'updatepage']);
    Route::view('/fileAccess','fileAccess');
    // Route::view('/structure','structure');
    Route::get('/unstructure', [DataController::class,'unstructure']);
    // Route::get('/location', [DataController::class,'location']);
    // Route::get('/designation', [DataController::class,'designation']);
    Route::get('/structure',[DataController::class,'structure']);


});