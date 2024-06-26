<?php

use App\Http\Controllers\DepartmentTestController;
use App\Http\Controllers\EmployeeTestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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
Route::get('/register',function()
{
    return view('register');
});
Route::get('/login',function(){
    return view( 'login');
});
Route::get('/profile',function(){
    return view( 'Profile');
});
Route::get('/departments', [DepartmentTestController::class , 'index']);
Route::get('/employees'  ,[EmployeeTestController::class,'index']);

