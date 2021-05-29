<?php

namespace App\Http\Controllers;

use App\Models\AllOwner;
use App\Models\Driver;
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function showVehicleForm(){
        $data['driver']=Driver::all();
        $data['type']=Type::all();
        return view('newVehicle' ,compact('data'));
    }

    public function insertVehicle(Request $request){


        try {
            DB::beginTransaction();
            $owner =new AllOwner();
            $vehicle= new Vehicle();

            $vehicle->model_name=Crypt::encryptString($request->cmname);
            $vehicle->model_number=Crypt::encryptString($request->cmnumber);
            $vehicle->color=Crypt::encryptString($request->ccolor);
            $vehicle->model_year=Crypt::encryptString($request->cmyear);
            $vehicle->manufacture=Crypt::encryptString($request->cmanufacture);
            $vehicle->plate_number=$request->cplatenumber;
            $vehicle->type_id=$request->ctype;
            $vehicle->save();

            if (AllOwner::orderBy('created_at','desc')->first()){
                $oid=AllOwner::orderBy('created_at','desc')->first();
                $owner->id=$oid->id+1;
            }else{
                $owner->id=1;
            }
            $id=DB::select('select drivers.id as Did from users inner join drivers on drivers.id=users.profile_id and profile_type LIKE ? and users.profile_id = ? ',['%Driver%',$request->driver]);
            $owner->driver_id=$id[0]->Did;
            $owner->car_id=$vehicle->id;
            $owner->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }


        return redirect(route('showVehicleForm'))->with('vehicleinsertSuccess','Vehicle Inserted Successfully');
    }


    public function showVehicleList(){
        $vehicles = DB::select('select *,vehicles.id as vid from vehicles inner join types on vehicles.type_id = types.id  inner join all_owners on all_owners.car_id=vehicles.id inner join drivers on drivers.id=all_owners.driver_id ');
        return view("VehicleList",compact('vehicles'));
    }
}
