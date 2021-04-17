<?php

namespace App\Http\Controllers;

use App\Models\AllOwner;
use App\Models\Licence;
use App\Models\Licence_Type;
use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Vehicle;
use App\Models\Driver;
use App\Models\Type;

class AdminController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function showNewPersonnel(){
        return view('newPersonnel');
    }
    public function insertPersonnel(Request $request){

            $request->validate([
                'fname'=>'required|string',
                'lname'=>'required|string',
                'email'=>'required|email|unique:users',
                'username'=>'required|string',
                'password'=>'required',
                'phone'=>'required|max:11',
            ]);
            $personnel=new Personnel();
            $personnel->fname=$request->fname;
            $personnel->lname=$request->lname;
            $personnel->phone=$request->phone;
            $personnel->save();
            $personnel->profile()->create([
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);

        return  redirect(route('showNewPersonnel'))->with('newPersonnelMsg','New Personnel Added Successfully');
    }



    public function showPersonnelList(){
        $personnels=DB::select('select *,users.id as uid from users inner join personnels on personnels.id =users.profile_id and users.profile_type = ?',['App\Models\Personnel']);
        return view('personnelsList',compact('personnels'));
    }


    public function showEditPersonnel($id){
        $data = DB::select('select *,users.id as uid from users inner join personnels on users.profile_id=personnels.id and personnels.id = ? ',[$id]);
        return view('editPersonnel',compact('data'));
    }

    public function UpdatePersonnel(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'username'=>'required'
        ]);
        $user=User::find($request->userID);
        $personnel=Personnel::find($request->personnelID);
        $user->username=$request->username;
        $user->email=$request->email;
        if ($request->password != ""){
            $user->password=Hash::make($request->password);
        }
        $user->save();
        $personnel->fname=$request->fname;
        $personnel->lname=$request->lname;
        $personnel->phone=$request->phone;
        $personnel->save();
        return redirect(route('showEditPersonnel',$request->personnelID))->with('updateSuccessMSG','Information Updated Successfully');
    }

    public function deletePersonnel(Request $request){
       Personnel::destroy($request->personnelID);
       User::destroy($request->userID);
       return redirect(route('showPersonnelList'))->with('deletePersonnelMSG','Information Deleted Successfully');
    }



//         driver functions

    public function showNewDriver(){

        $data['type']=Type::all();
        $data['Ltype']=Licence_Type::all();

        return view('newDriver',compact('data'));
    }
    public function showDriverList(){
        return view('driverList');
    }

    public function insertDriver(Request $request){
//        $request->validate([
//
//        ]);

        $vehicle= new Vehicle();
        $driver = new Driver();
        $licence=new Licence();
        $owner =new AllOwner();

        $licence->number =$request->lnumber;
        $licence->create_date =$request->lcdate;
        $licence->expire_date =$request->ledate;
        $licence->type=$request->ltype;
        $licence->save();

        $driver->fname=$request->fname;
        $driver->lname=$request->lname;
        $driver->address=$request->address;
        $driver->phone=$request->phone;
        $driver->image="ejdbwkdbkneld";
        $driver->date=$request->birthdate;
        $driver->licence=$licence->id;
        $driver->save();

        $driver->profile()->create([
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $vehicle->model_name=$request->cmname;
        $vehicle->model_number=$request->cmnumber;
        $vehicle->color=$request->ccolor;
        $vehicle->model_year=$request->cmyear;
        $vehicle->manufacture=$request->cmanufacture;
        $vehicle->plate_number=$request->cplatenumber;
        $vehicle->type_id=$request->ctype;
        $vehicle->save();






        if (AllOwner::orderBy('created_at','desc')->first()){
            $oid=AllOwner::orderBy('created_at','desc')->first();
            $owner->id=$oid+1;
        }else{
            $owner->id=1;
        }
        $id=DB::select('select users.id as uid from users inner join drivers on drivers.id=users.profile_id and profile_type LIKE ? and users.profile_id = ? ',['%Driver%',$driver->id]);
        $owner->driver_id=$id[0]->uid;
        $owner->car_id=$vehicle->id;
        $owner->save();

        return redirect(route('showNewDriver'))->with('insertDriverMSG','Driver Inserted Successfully');
    }



    ////////////vehicle type

    public function showVehicleType(){
        return view('vType');
    }

    public function insertVType(Request $request){
        $request->validate([
            'vehicle_type'=>'required'
        ]);
        $type=new Type();
        $type->type_name=$request->vehicle_type;
        $type->save();
        return redirect(route('showVehicleType'))->with('vTypeMSG','information inserted ');
    }






    //////////Licence type


    public function showLicenceType(){
        return view('LType');
    }

    public function insertLtype(Request $request){
        $request->validate([
            'licence_type'=>'required'
        ]);

        $lType=new Licence_Type();
        $lType->licence_type=$request->licence_type;
        $lType->save();

        return redirect(route('showLicenceType'))->with('lTypeMSG','information inserted ');
    }

}
