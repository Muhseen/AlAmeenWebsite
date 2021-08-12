<?php

namespace App\Services;

use App\Stock;
use App\amountInWords;

class receiptGenerator
{
    public static function makeSalesReceipt($items, $customerName, $rcptNo, $date)
    {
        //"Lucida Console", "Courier New", monospace;
        $table = '<html lang="en">

    <head>
    <meta charset="utf-8">
    <style>
    tbody 
    {
   font-family: Arial ,Helvetica, sans-serif;
   font-size:20; 
   font-weight:bold;
    }
    @page{
        margin:0mm;  
    }
   tr{
       border-bottom: dashed 1mm
   }
   td{
      border:dashed 1mm;
   }
    </style>
    </head>
    <body>
   
    <table class="table table-bordered  medium text-bold myInvoivceTable"  style="width:11cm;">
       <thead>
        <tr>
            <th colspan="5" class="text-center">
                <h4>
                Al-AMEEN<br>
                College of Health Science <br>
                and Technology <br>
                </h4>
            </th>
        </tr>
        <tr>
            <th colspan="2">Paid By</th>
            <th colspan="3">' . $customerName  . '</th>
        </tr>
        <tr>
            <th colspan="2">Receipt No</th>
            <th colspan="3">' . $rcptNo  . '</th>
        </tr>
        <tr>
            <th colspan="2">Date</th>
            <th colspan="3">' . $date  . '</th>
        </tr>
        
        <tr>

        <th >S/No</th>
        <th colspan="3">Decsription</th>
        <th>Amount</th>
        </tr>
    </thead>
    <tbody>    ';
        $total = 0;
        $counter = 1;
        foreach ($items as $item) {
            
           }
        $aiw = new amountInWords();
        $table .= '<tr> <th colspan="4" class="text-right">Total</th>';
        <tr>
            <th colspan="5">' . $aiw->amountInWords($total) . '</th>
        </tr>
        <tr><th colspan="5" style="text-align:center"> Invoice Issued By ' . auth()->user()->name . '</th></tr></tbody>
        <tr>
        <th colspan="5" class="text-center">
        Note: Items that have not been claimed or picked after two weeks of payment will automatically be converted to money deposit in the Customer\'s
            account on our software </th>
        </tr>
        </table> 
    </body>
    </html>
    ';
        return $table;
    }

    public static function formatNumber($number)
    {
        return   number_format($number, 2, ".", ",");
    }
    public static function makePaymentReceipt($amount, $customerName, $reason, $rcptNo, $date)
    {
        $table = '<html lang="en">

    <head>
    <meta charset="utf-8">
    <style>
    tbody 
    {
   font-family: Arial ,Helvetica, sans-serif;
   font-size:20; 
   font-weight:bold;
    }
    @page{
        margin:0mm;  
    }
   tr{
       border-bottom: dashed 1mm
   }
   td{
      border:dashed 1mm;
   }
    </style>
    </head>
    <body>
   
    <table class="table table-bordered  medium text-bold myInvoivceTable"  style="width:11cm;">
       <thead>
        <tr>
            <th colspan="5" class="text-center">
                <h4>
                HITOB MULTIBIZ<br>
                Global Ventures<br>
                (' . auth()->user()->branch . ' branch)
                </h4>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center">
                <h5>
                    Payment Receipt
                </h5>
            </th>
        </tr>
        
        <tr>
            <th colspan="1">Customer-Name</th>
            <th colspan="4">' . $customerName  . '</th>
        </tr>
        <tr>
            <th colspan="1">Date</th>
            <th colspan="4">' . $date  . '</th>
        </tr>
        
        <tr>
            <th colspan=>Receipt No: 
            </th colspan="4">
            <th>
            ' . $rcptNo . '
            </th>
            </tr>
        
        <tr>
            <th colspan=>Reason : 
            </th colspan="4">
            <th>
            ' . $reason . '
            </th>
            </tr>
        
        <tr>

        <th>Amount</th>
        <th>' . receipt::formatNumber($amount) . '</th>
        </tr>
        <tr>

        <th>Amount in words</th>
        <th colspan="4">' . (new amountInWords())->amountInWords($amount) . '</th>
        </tr>
        <tr>
            <th colspan="5" class="text-center">This receipt was issued by ' . auth()->user()->name . '</th>
        </tr>
        <tr>
        <th colspan="5" class="text-center">
        Note: Items that have not been claimed or picked after two weeks of payment will automatically be converted to money deposit in the Customer\'s
            account on our software </th>
        </tr>
    </thead>
    </html>
    ';
        return $table;
    }
}
