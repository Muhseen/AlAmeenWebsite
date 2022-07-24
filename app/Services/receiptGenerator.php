<?php

namespace App\Services;

use App\Services\amountInWords;
use App\Stock;

class receiptGenerator
{
    public static function makeSalesReceipt($items, $customerName, $rcptNo, $date)
    {
        //"Lucida Console", "Courier New", monospace;
        $table = '<html lang="en">
     <head>
        <meta charset="utf-8">
     <style>

    </style>
    </head>
    <body>
   <table class="table table-bordered  table-striped medium text-bold myInvoivceTable" >
        <tbody>
            <tr>
                <td class="col-1">
                    <img src="/assets/img/logo.png" alt="logo" width ="100px" height = "100px" />
                </td>
                <td class="col-10">
                    <h3 class="mt-4">
                        Al-Ameen College of Health Sciences and Technology
                    </h3>
                </td>
                <td class="col-1">
                    <img src="/assets/img/logo.png" alt="logo" width ="100px" height = "100px" />
                </td>

            </tr>
            <tr>
                <td colspan ="3" class="text-center" >
                   <h4> Payment receipt</h4>
                </td>
            </tr>
            <tr>
                <td class="col-3 text-left">
                Paid By :
                </td>
                <td colspan="2">
                    ' . $customerName . '
                </td>
            </tr>
            <tr>
                <td class="text-left">
                Purpose :
                </td>
                <td colspan="2">
                   <span class="text-left"> Being payment for ' . $items->Description . '</span>
                </td>
            </tr>
            <tr>
                <td class="text-left">
                Amount :
                </td>
                <td colspan="2">
                    ' . (new receiptGenerator)->formatNumber($items->Amount) . '
                </td>
            </tr>
            <tr>
                <td class="text-left">
                Amount in Words :
                </td>
                <td colspan="2">
                    ' . (new amountInWords())->amountInWords($items->Amount) . '
                </td>
            </tr>


        </tbody>
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
    /* public static function makePaymentReceipt($amount, $customerName, $reason, $rcptNo, $date)
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
    }*/
}