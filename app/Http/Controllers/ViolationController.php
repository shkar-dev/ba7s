<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ViolationController extends Controller
{
    public function index(){
        return view('violation');
    }

    public function insert(Request $request){
        $request->validate([
            'violation_type'=>'required',
            'violation_price'=>'required'
        ]);
        try {
            DB::beginTransaction();
            $violation=new Violation();
            $violation->type=Crypt::encryptString($request->violation_type);
            $violation->money=Crypt::encryptString($request->violation_price);
            $violation->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return redirect(route('showViolationType'))->with('successViolationInsert','Violation Successfully Inserted ');
    }

    public function violationList(){
        $violations=Violation::all();
        return view('violationList',compact('violations'));
    }

    public function showUpdateViolation($id){
        $violation = Violation::find($id);
        return view('editViolationType',compact('violation'));
    }

    public function updateViolation(Request $request){
        $request->validate([
            'type'=>'required',
            'money'=>'required'
        ]);
        try {
            DB::beginTransaction();
            $violation=Violation::find($request->vid);
            $violation->type=Crypt::encryptString($request->type);
            $violation->money=Crypt::encryptString($request->money);
            $violation->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
        return redirect(route('showUpdateViolation',$request->vid))->with('updateViolationType','Violation Updated Successfully');
    }
}
