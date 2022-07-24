<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use Illuminate\Http\Request;

class validationController extends Controller
{
    public function  validateReceipt(Request $request)
    {

        $studentPayment = studentPayments::where('receiptno', $request->receiptNo)->first();
        if ($studentPayment != null) {
            return $studentPayment;
        } else {
            return "not found";
        }
        /*$studentPayment = studentPayments::where('receiptNo', $request->receiptNo)->first();
        if($studentPayment===null)
        {
            session()->flash('error', 'Invalid Receipt No');
            return back();
        }
        else

        {
            session()->flash('message', 'Welp it exists');
            return back();
        }*/
    }
}