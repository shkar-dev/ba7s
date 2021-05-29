<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PersonnelController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;
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
//
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/welcome',function (){
    return view('layouts.adminDashboard');
});


Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin',[AdminController::class,'index'])->name('showAdmin');
//personnel
    Route::get('/newPersonnel',[AdminController::class,'showNewPersonnel'])->name('showNewPersonnel');
    Route::get('/personnelList',[AdminController::class,'showPersonnelList'])->name('showPersonnelList');
    Route::post('/newPersonnel',[AdminController::class,'insertPersonnel'])->name('insertPersonnel');
    Route::get('/editPersonnel/{id}',[AdminController::class,'showEditPersonnel'])->name('showEditPersonnel');
    Route::post('/editPersonnel',[AdminController::class,'UpdatePersonnel'])->name('UpdatePersonnel');
    Route::post('/personnelList',[AdminController::class,'deletePersonnel'])->name('deletePersonnel');


//vehicle
    Route::get('/vType',[AdminController::class,'showVehicleType'])->name('showVehicleType');
    Route::post('/vType',[AdminController::class,'insertVType'])->name('insertVType');
    Route::get('/VTypeList',[AdminController::class,'VTypeList'])->name('showVTypeList');


    Route::get('/showVehicleForm',[VehicleController::class,'showVehicleForm'])->name('showVehicleForm');
    Route::post('/insertVehicle',[VehicleController::class,'insertVehicle'])->name('insertVehicle');
    Route::get('/vehiclesList',[VehicleController::class,'showVehicleList'])->name('showVehicleList');


//licence
    Route::get('/Ltype',[AdminController::class,'showLicenceType'])->name('showLicenceType');
    Route::post('/Ltype',[AdminController::class,'insertLtype'])->name('insertLtype');
    Route::get('/LTypeList',[AdminController::class,'LTypeList'])->name('showLTypeList');

//admin violation type
    Route::get('/violationType',[\App\Http\Controllers\ViolationController::class,'index'])->name('showViolationType');
    Route::post('ViolationType',[\App\Http\Controllers\ViolationController::class,'insert'])->name('insertViolationType');
    Route::get('ViolationList',[\App\Http\Controllers\ViolationController::class,'violationList'])->name('showViolationList');
    Route::get('/updateViolation/{id}',[\App\Http\Controllers\ViolationController::class,'showUpdateViolation'])->name('showUpdateViolation');
    Route::post('/updateViolation',[\App\Http\Controllers\ViolationController::class,'updateViolation'])->name('updateViolation');


//driver
    Route::get('newDriver',[AdminController::class,'showNewDriver'])->name('showNewDriver');
    Route::get('DriverList',[AdminController::class,'showDriverList'])->name('showDriverlList');
    Route::post('/newDriver',[AdminController::class,'insertDriver'])->name('insertDriver');
    Route::get('/editDriver/{id}',[AdminController::class,'showEditDriver'])->name('showEditDriver');
    Route::post('/updateDriver',[AdminController::class,'UpdateDriver'])->name('UpdateDriver');

});

Route::middleware(['auth','driver'])->group(function(){
    //----------------------------------- Driver -------------------------------
    Route::get('/driver',[DriverController::class,'index'])->name('showDriver');
    Route::get('/driver-unPaidViolation',[DriverController::class,'driverUnpaiedViolation'])->name('driverUnPaiedViolation');
    Route::post('/afterpayment',[DriverController::class,'Payment'])->name('afterPayment');
    Route::get('/paidViolation',[DriverController::class,'showPaidViolation'])->name('showPaidViolation');
    Route::get('/driverInformation',[DriverController::class,'showDriverInformation'])->name('showDriverInformation');
    Route::get('/driverVehicleInformation',[DriverController::class,'showDriverVehicleInformation'])->name('showDriverVehicleInformation');

});

Route::middleware(['auth','personnel'])->group(function(){
    //----------------------------------- Personnel -------------------------------
    Route::get('/personnel',[PersonnelController::class,'index'])->name('showPersonnel');
    Route::get('/personnel-violation',[PersonnelController::class,'showViolationForm'])->name('showViolationForm');
    Route::get('/checkforAutomobile',[PersonnelController::class,'checkforAutomobile'])->name('checkforAutomobile');
    Route::post('/insertDriverViolation',[PersonnelController::class,'insertDriverViolation'])->name('insertDriverViolation');
    Route::get('/showPersonnelViolationList',[PersonnelController::class,'showPersonnelViolationList'])->name('showPersonnelViolationList1');
});







