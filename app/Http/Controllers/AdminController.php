<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function showNewPersonnel(){
        return view('newPersonnel');
    }
    public function insertPersonnel(Request $request){
        try {
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
        }catch (\Exception $exception){
            return $exception;
        }
        return  redirect(route('showNewPersonnel'))->with('newPersonnelMsg','New Personnel Added Successfully');
    }

    public function showPersonnelList(){
        $personnels=DB::select('select * from users inner join personnels on personnels.id =users.profile_id and users.profile_type = ?',['App\Models\Personnel']);
        return view('personnelsList',compact('personnels'));
    }

    public function showNewDriver(){
        return view('newDriver');
    }
    public function insertDriver(Request $request){

    }
    public function showDriverList(){
        return view('driverList');
    }

}
