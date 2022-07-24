<?php

namespace App\Services\Reports;

use App\Models\studentledger;

class tableGen
{
    public static function generateDebtorTable($students, $type, $request)
    {
        $formatter = new tableGen();
        $table = "";
        $facultyStudents = $students->groupby('PresentSection');
        foreach ($facultyStudents as $fgroup) {

            $table .= "<table class='table mb-5 ui-sortable-table table-responsive table-bordered table-dark table-stripped table-hover'><thead>
            <tr></tr>";
            $courseGroup = $fgroup->groupby('Arm');
            foreach ($courseGroup as $cp) {
                $levelGroup = $cp->groupby('class');
                foreach ($levelGroup as $lg) {
                    if ($request->has('faculty')) {
                        $table .= "<tr><th class='text-center' colspan='8'><h5> Debtor Reports<br/> For <br/> " . $lg->first()->faculty . " " . $lg->first()->course . "-" . $lg->first()->level . "</h5></th></tr>";
                    }
                    if ($request->has('type')) {

                        $table .= "<tr>
                        <td class='text-center' colspan='9'>Debtor Reports  For  Students Owing " . request('type') . "</span></td></tr>";
                    }
                    $table .= "<tr><th colspan = '9' class ='text-center'> Generated on " . now() . "</th></tr>";
                    $table .= "<tr>
                        <th>Name</th>
                        <th>Reg No</th>
                        <th>Level</th>
                        <th>Course</th>
                        <th>Faculty</th>
                        <th>";
                    $table .= $type == "all" ? "Outstanding Fees" : $type . "</th>";
                    $table .= $type == "all" ? "<th>Outstanding Index Fee</th>
                        <th>Outstanding Board Fee</th>" : "";
                    $table .= "<th>View Ledger</th> </tr></thead>";
                    foreach ($lg as $student) {
                        $name = $student->MiddleName == "" ? $student->FirstName . " " . $student->LastName : $student->FirstName . " " . $student->MiddleName . " " . $student->LastName;
                        $table .= "
                        <tr>
                    <td>    $name   </td>
                    <td>    $student->regno   </td>
                    <td>" . $student->level . "</td>
                    <td>" . $student->course . "</td>
                    <td>" . $student->faculty . "</td>
                    <td style='text-align:right;'>" . $formatter->formatNumber($type == "all" ? $student->fees : $student->$type) . "</td>";
                        $table .= $type == "all" ? "
                    <td style='text-align:right;'>" . $formatter->formatNumber($student->indexFee) . "</td>
                    <td style='text-align:right;'>" . $formatter->formatNumber($student->boardFee) . "</td>" : "";

                        $table .= "
                        <th><a class='btn btn-info' href='/studentLedger?regno=" . $student->regno . "'>View Ledger</a></th></tr>";
                    }
                }
            }
            $table .= "</table>";
        }
        return $table;
    }

    public static function generateStudentLedger($student, $report, $charges, $payments)
    {
        $formatter = new tableGen();
        $totalPayments = 0;
        $totalCharges = 0;
        $balance = 0;

        $counter = 0;
        foreach ($payments as $p) {
            $totalPayments += $p->Amount;
            $counter++;
            $rRow = new studentledger();
            $rRow->id = $p->id;
            $rRow->txndate = $p->Txndate;
            $rRow->StudentNo = $p->StudentNo;
            $rRow->Studentname = $p->Payer;
            $rRow->Description = $p->Description;
            $rRow->amountcr = $p->Amount;
            $rRow->amountdb = 0;
            $report->put($counter, $rRow);
        }
        foreach ($charges as $c) {
            $totalCharges += $c->amount;
            $counter++;
            $rRow = new studentledger();
            $rRow->id = $c->id;
            $rRow->txndate = $c->txndate;
            $rRow->StudentNo = $c->StudentNo;
            $rRow->Studentname = $c->Payee;
            $rRow->Description = $c->Description;
            $rRow->amountcr = 0;
            $rRow->amountdb = $c->amount;
            $report->put($counter, $rRow);
        }
        $report = $report->sortBy('txndate');

        $table =   " <div class='card  text-center card-header'>
           <b> Name: $student->fullname<br>
            Faculty: $student->faculty
            , Course: $student->course
            , Level: $student->level <br>
            Student Ledger
            </b>
        </div>
        <table class= 'table ui-sortable-table table-striped table-dark table-bordered'>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Charges</th>
            <th>Payments</th>
            <th>Balance(To be paid)</th>

        </tr>";
        $balance = 0;
        foreach ($report as $r) {
            $del = $r->amountcr == 0 ?
                "<form method='GET' action ='/delAcc'> <input type='hidden' name ='id' value='$r->id'/><button class='btn  btn-danger' type='submit'>Delete</button></form>" :
                "";

            $balance += $r->amountcr == 0 ? $r->amountdb : (-1) * $r->amountcr;
            $table .= "<tr>
             <td>" . ($r->txndate ?? "NIL") . "</td>
             <td>" . $r->Description . "</td>
             <td  style='text-align:right;'>" . $formatter->formatNumber($r->amountdb) . "</td>
             <td style='text-align:right;'>" . $formatter->formatNumber($r->amountcr) . "</td>
             <td style='text-align:right;'>   " . $formatter->formatNumber($balance) .
                "</td></tr>";

            //           <td>$del</td>
        }
        $table .= "<tr> <td colspan='2' style='text-align:right;'>Total </td><td>" . $formatter->formatNumber($totalCharges) . "</td><td>" . $formatter->formatNumber($totalPayments) . "</td><td>" . $formatter->formatNumber($totalCharges - $totalPayments) . "</td></tr>";
        $table .= "<tr> <td colspan='4' style='text-align:right;'>Outstanding Balance</td><td>" . $formatter->formatNumber($totalCharges - $totalPayments) . "</td></tr>";
        $table .= "</table>";
        return $table;
    }
    public static function generateReceiptTable($receipts, $header = "Receipt Reports")
    {
        $formatter = new tableGen();
        $table = "";
        $table .= "<table class='table table-responsive table-striped table-condensed table-bordered table-dark table-hover'>";
        $table .= "
        <tr>
        <th colspan='6'>
            <h4 style='color:white' class='text-center'>Al-Ameen College of Health Sciences and Technology</h4>
        </th>
        <tr >
        <th colspan='6' class='text-center'>{$header}
        </th>
                </tr>
        </tr>
        <tr><th colspan = '9' class ='text-center'> Generated on " . now() . "</th></tr>

        <tr>
                    <th>Transaction Date</th>
                    <th>Name</th>
                    <th>Regno</th>
                    <th>Receipt No</th>
                    <th>Description(Reason)</th>
                    <th>Amount</th>
                </tr>";
        foreach ($receipts as $receipt) {
            $table .= "<tr>
                        <td>$receipt->Txndate</td>
                        <td>$receipt->Payer</td>
                        <td>$receipt->StudentNO</td>
                        <td>$receipt->ReceiptNo</td>
                        <td>$receipt->Description</td>
                        <td>" . $formatter->formatNumber($receipt->Amount) . "</td>
                    </tr>";
        }
        $table .= "</table>";
        return $table;
    }
    public function formatNumber($number)
    {
        return number_format($number, 2, ".", ",");
    }
}