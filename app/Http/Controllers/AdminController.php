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
use Illuminate\Support\Facades\Crypt;


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

        try {
            DB::beginTransaction();
            $personnel=new Personnel();
            $personnel->fname=Crypt::encryptString($request->fname);
            $personnel->lname=Crypt::encryptString($request->lname);
            $personnel->phone=Crypt::encryptString($request->phone);
            $personnel->save();

            $personnel->profile()->create([
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            throw $ex;
        }






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


        try {
            DB::beginTransaction();
            $user=User::find($request->userID);
            $personnel=Personnel::find($request->personnelID);
            $user->username=$request->username;
            $user->email=$request->email;
            if ($request->password != ""){
                $user->password=Hash::make($request->password);
            }
            $user->save();
            $personnel->fname=Crypt::encryptString($request->fname);
            $personnel->lname=Crypt::encryptString($request->lname);
            $personnel->phone=Crypt::encryptString($request->phone);
            $personnel->save();

            DB::commit();




        } catch(\Exception $ex) {
            DB::rollBack();
            throw $ex;

        }


        return redirect(route('showEditPersonnel',$request->personnelID))->with('updateSuccessMSG','Information Updated Successfully');
    }

    public function deletePersonnel(Request $request){


        try {
            DB::beginTransaction();
            Personnel::destroy($request->personnelID);
            User::destroy($request->userID);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

       return redirect(route('showPersonnelList'))->with('deletePersonnelMSG','Information Deleted Successfully');
    }

//         driver functions

    public function showNewDriver(){

        $data['type']=Type::all();
        $data['Ltype']=Licence_Type::all();

        return view('newDriver',compact('data'));
    }
    public function showDriverList(){

        $driverInfo=DB::select('select *,users.id as UID from users inner join drivers on drivers.id = users.profile_id and users.profile_type = ? ',['App\Models\Driver']);
        return view('driverList',compact('driverInfo'));
    }

    protected function showEditDriver($id)
    {
        $driverInfo=DB::select('select *,users.id as UID from users inner join drivers on drivers.id = users.profile_id and users.profile_type = ? and drivers.id = ?  ',['App\Models\Driver',$id]);

        return view('editDriver',compact('driverInfo'));

    }
    protected function UpdateDriver(Request $request)
    {
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'username'=>'required',
        ]);

        try {
            DB::beginTransaction();
            $user=User::find($request->userID);
            $driver=Driver::find($request->driverID);
            $user->username=$request->username;
            $user->email=$request->email;
            if ($request->password != ""){
                $user->password=Hash::make($request->password);
            }
            $user->save();
            $driver->fname=Crypt::encryptString($request->fname);
            $driver->lname=Crypt::encryptString($request->lname);
            $driver->phone=Crypt::encryptString($request->phone);
            $driver->address=Crypt::encryptString($request->address);
            $driver->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;

        }


        return redirect(route('showEditDriver',$request->driverID))->with('updateSuccessMSGdriver','Information Updated Successfully');
    }


    public function insertDriver(Request $request){


        try {
            DB::beginTransaction();
            $driver = new Driver();
            $licence=new Licence();
            $licence->number =Crypt::encryptString($request->lnumber);
            $licence->create_date =Crypt::encryptString($request->lcdate);
            $licence->expire_date =Crypt::encryptString($request->ledate);
            $licence->type=$request->ltype;
            $licence->save();
            $driver->fname=Crypt::encryptString($request->fname);
            $driver->lname=Crypt::encryptString($request->lname);
            $driver->address=Crypt::encryptString($request->address);
            $driver->phone=Crypt::encryptString($request->phone);
            $driver->wallet=Crypt::encryptString("500");
            $driver->date=Crypt::encryptString($request->birthdate);
            $driver->licence=$licence->id;
            $driver->save();
            $driver->profile()->create([
                'username'=>$request->username,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
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

        try {
            DB::beginTransaction();
            $type=new Type();
            $type->type_name=Crypt::encryptString($request->vehicle_type);
            $type->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }
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
        try {
            DB::beginTransaction();
            $lType=new Licence_Type();
            $lType->licence_type=Crypt::encryptString($request->licence_type);
            $lType->save();
            DB::commit();

        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return redirect(route('showLicenceType'))->with('lTypeMSG','information inserted ');
    }



    public function VTypeList(){
        $vehicleType=Type::all();
        return view('vtypeList',compact('vehicleType'));
    }

    public function LTypeList(){
        $licenceType=Licence_Type::all();
        return view('ltypeList',compact('licenceType'));
    }

}
