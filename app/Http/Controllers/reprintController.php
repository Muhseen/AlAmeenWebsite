<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use App\Services\amountInWords;
use App\Services\receiptGenerator;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class reprintController extends Controller
{
    public function reprintreceipt($id, Request $request)
    {
        $aiw = new amountInWords();
        // dd($aiw->amountInWords(4501));
        $studentPayment = studentPayments::where('id', $id)->first();
        $rg = new receiptGenerator();
        $myReceipt = $rg->makeSalesReceipt($studentPayment, $studentPayment->student->fullname, $studentPayment->ReceiptNo, $studentPayment->Txndate);
        return view('reprint.receipt')->withTable($myReceipt);
    }
}