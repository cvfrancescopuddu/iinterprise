<?php

namespace App\Http\Controllers\Gateways;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaypalController extends Controller
{

    public function planes(){
        return view('paymentPlane');
    }
    public function payment(Request $request){

    }


    public function success(){

    }
    

    public function cancel(){

    }
}
