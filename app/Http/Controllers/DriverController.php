<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\DriverViolation;
use App\Models\Payment_violation;
use App\Models\Payment_Violation_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

class DriverController extends Controller
{
    public function index(){
        return view('layouts.driver');
    }

//    public $token;
    public function driverUnpaiedViolation(){

        $id = Auth::guard()->user()->id;
        $driver_id =DB::select("select drivers.id as id from users inner join drivers on users.profile_id=drivers.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Driver', $id]);

        $data['driver']=DB::select('select *,driver_violations.created_at as violation_date,driver_violations.id as id from driver_violations inner join violations on driver_violations.violation_id=violations.id  inner join all_owners on all_owners.driver_id=driver_violations.driver_id inner join vehicles on vehicles.id=all_owners.car_id where driver_violations.transaction_status = ? ',[0]);

        return view('unpaiedDriverViolation',compact('data'));

    }


    public function Payment()
    {

        try {
            DB::beginTransaction();
            \Stripe\Stripe::setApiKey('sk_test_51IAF9cBPwKjIKAwsy4CAlTs6co8fTT3EX29CKdmsobju83dp90kPtb88ZHdaXWWCjyAqk3OuqlaVXRsT9DYhFVcJ008hR96DkC');


            // Sanitize POST Array
            $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);




            $email = $POST['email'];
            $token = $POST['stripeToken'];
            $violation_id=(int)$_POST['violation_id'];
            $info=DB::select('select *,driver_violations.driver_id as did,driver_violations.id as dvid from driver_violations inner join violations on driver_violations.violation_id=violations.id and  driver_violations.id = ? ',[$violation_id]);

            $driver=Driver::find($info[0]->did);
            $wallet =  (Crypt::decryptString($driver->wallet)-Crypt::decryptString($info[0]->money));
            $driver->wallet=Crypt::encryptString($wallet);
            $driver->save();


            $customer = \Stripe\Customer::create(array(
                "email" => $email,
                "source" => $token
            ));


            $charge = \Stripe\Charge::create(array(
                "amount" => (Crypt::decryptString($info[0]->money)*100),
                "currency" => "usd",
                "description" => "this transaction for ".Crypt::decryptString($info[0]->type) ." violation",
                "customer" => $customer->id
            ));


            $transaction=new Transaction();
            $transaction->driver_id =$info[0]->id;
            $transaction->transaction_id = $charge->id;
            $transaction->card_number = Crypt::encryptString((string)$charge['payment_method_details']['card']->last4);
            $transaction->card_exp_month =Crypt::encryptString((string)$charge['payment_method_details']['card']->exp_month);
            $transaction->card_exp_year =Crypt::encryptString((string)$charge['payment_method_details']['card']->exp_year);
            $transaction->paid_amount=Crypt::encryptString(($charge->amount/100));
            $transaction->paid_currency_type=Crypt::encryptString($charge->currency);
            $transaction->payment_status=Crypt::encryptString($charge->status);
            $transaction->txn_id = $charge->balance_transaction;
            $transaction->save();


            $payment_violation=new Payment_Violation_Item();
            $payment_violation->DV_id=$info[0]->dvid;
            $payment_violation->transaction_id = $transaction->id;
            $payment_violation->total =Crypt::encryptString($transaction->paid_amount);
            $payment_violation->save();


            $driver_violation=DriverViolation::find($info[0]->dvid);
            $driver_violation->transaction_status =1;
            $driver_violation->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }

        return redirect(route('driverUnPaiedViolation'))->with('paymentSuccessMessage','Your Violation Successfully Paid');

    }


    protected function showPaidViolation()
    {

        $id = Auth::guard()->user()->id;
        $driver_id =DB::select("select drivers.id as id from users inner join drivers on users.profile_id=drivers.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Driver', $id]);

        $data['driver']=DB::select('select *,driver_violations.created_at as violation_date,driver_violations.id as id from driver_violations inner join violations on driver_violations.violation_id=violations.id  inner join all_owners on all_owners.driver_id=driver_violations.driver_id inner join vehicles on vehicles.id=all_owners.car_id where driver_violations.transaction_status = ? ',[1]);

        return view('driverPaidViolation',compact('data'));
    }


    protected function showDriverInformation()
    {
        $id = Auth::guard()->user()->id;
        $driver_id =DB::select("select drivers.id as id from users inner join drivers on users.profile_id=drivers.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Driver', $id]);

        $data=DB::select('select * from users inner join drivers on drivers.id = users.profile_id and users.profile_type= ? and drivers.id = ?  ',['App\Models\Driver',$driver_id[0]->id]);
        return view('driverInformation',compact('data'));

    }
    protected function showDriverVehicleInformation()
    {
        $id = Auth::guard()->user()->id;
        $driver_id =DB::select("select drivers.id as id from users inner join drivers on users.profile_id=drivers.id and users.profile_type = ?  and users.id = ? ", ['App\Models\Driver', $id]);

        $data=DB::select('select * from all_owners inner join vehicles on all_owners.car_id = vehicles.id and driver_id = ? ',[$driver_id[0]->id]);
        return view('driverVehicleInformation',compact('data'));

    }
}
