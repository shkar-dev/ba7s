<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PersonnelController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome',function (){
    return view('layouts.adminDashboard');
});

//----------------------------------- Admin -------------------------------
Route::get('/admin',[AdminController::class,'index'])->name('showAdmin');
//personnel
Route::get('/newPersonnel',[AdminController::class,'showNewPersonnel'])->name('showNewPersonnel');
Route::get('/personnelList',[AdminController::class,'showPersonnelList'])->name('showPersonnelList');
Route::post('/newPersonnel',[AdminController::class,'insertPersonnel'])->name('insertPersonnel');

//driver
Route::get('newDriver',[AdminController::class,'showNewDriver'])->name('showNewDriver');
Route::get('DriverList',[AdminController::class,'showDriverList'])->name('showDriverlList');
//vehicle



//----------------------------------- Driver -------------------------------
Route::get('/driver',[DriverController::class,'index'])->name('showDriver');

//----------------------------------- Personnel -------------------------------
Route::get('/personnel',[PersonnelController::class,'index'])->name('showPersonnel');
