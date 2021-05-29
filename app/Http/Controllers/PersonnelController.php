<?php

namespace App\Http\Controllers;

use App\Models\DriverViolation;
use Illuminate\Http\Request;
use App\Models\Violation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PersonnelController extends Controller
{
    public function index(){
        return view('layouts.personnel');
    }

    public function showViolationForm(){
        $violations=Violation::all();
        return view('personnelNewViolation',compact('violations'));
    }

    public function checkforAutomobile(){
       $number =$_GET['data'];
       $driverid=DB::select('select *  from all_owners inner join vehicles on vehicles.id = all_owners.car_id and vehicles.plate_number = ? ',[$number]);
       if ($driverid == ""){
           return -1;
       }else{
           return json_encode($driverid);
       }
    }
    public function insertDriverViolation(Request $request){
        try {
            DB::beginTransaction();
            $id=Auth::guard()->user()->id;
            $personnel_id =DB::select("select personnels.id as id from users inner join personnels on users.profile_id=personnels.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Personnel', $id]);
            $DV=new DriverViolation();
            $DV->personnel_id=$personnel_id[0]->id;
            $DV->driver_id=$request->driver_id;
            $DV->violation_id=$request->violation_type;
            $DV->location=Crypt::encryptString($request->violation_location);
            $DV->transaction_status=Crypt::encryptString(0);
            $DV->plate_number=$request->automobile_number;
            $DV->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return redirect(route('showViolationForm'))->with('insertDVmessage','Driver Violation Inserted Successfully');
    }

    public function showPersonnelViolationList(){
        $id = Auth::guard()->user()->id;
        $personnel_id =DB::select("select personnels.id as id from users inner join personnels on users.profile_id=personnels.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Personnel', $id]);
        $data=DB::select('select *,driver_violations.id as DID,driver_violations.created_at as vdate from driver_violations  inner join violations on violations.id= driver_violations.violation_id inner join drivers on drivers.id=driver_violations.driver_id inner join all_owners on all_owners.driver_id=drivers.id inner join vehicles on vehicles.id=all_owners.car_id  and driver_violations.personnel_id = ? ',[$personnel_id[0]->id]);
        return view('personnelViolation_list',compact('data'));
    }
}
