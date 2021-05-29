<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::post('/payment',function () {
//
//    \Stripe\Stripe::setApiKey('sk_test_51IAF9cBPwKjIKAwsy4CAlTs6co8fTT3EX29CKdmsobju83dp90kPtb88ZHdaXWWCjyAqk3OuqlaVXRsT9DYhFVcJ008hR96DkC');
//    $token = $_POST['stripeToken'];
//
//    $charge = \Stripe\Charge::create(array(
//        "amount" => 1000,
//        "currency" => "usd",
//        "description" => "example",
//        "source" => $token,
//    ));
//
//})->name("welcomeaa");
