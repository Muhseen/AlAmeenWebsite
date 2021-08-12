<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use App\Services\receiptGenerator;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class reprintController extends Controller
{
    public function reprintreceipt($id, Request $request)
    {
        $studentPayment = studentPayments::where('id', $id)->first();
        $rg = new receiptGenerator();
        $myReceipt = $rg->makeSalesReceipt($studentPayment, $studentPayment->student->fullname, $studentPayment->ReceiptNo, $studentPayment->Txndate);
        dd($myReceipt);
    }
}
