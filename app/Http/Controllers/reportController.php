<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivableLogs;
use App\Models\Student;
use App\Models\studentledger;
use App\Models\studentPayments;
use App\QueryFilters\DebtorReports\orderBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class reportController extends Controller
{
    public function getOwingStudents(Request $request)
    {
        $table = "";
        $owingStudents = Student::getDebtors();
        $table = $this->generateTable($owingStudents, 'all', $request);
        $faculties = DB::table('studentsnew')->select('faculty')->orderBy('faculty')->get()->unique();
        $courses = DB::table('studentsnew')->where('faculty', $faculties[0]->faculty)->select('course')->get()->unique();
        $levels = DB::table('studentsnew')->where('faculty', $faculties[0]->faculty)->where('course', $courses[0]->course)->select('level')->orderBy('level')->get()->unique();
        return view('reports.view')
            ->withTable($table)
            ->withFaculties($faculties)
            ->withCourses($courses)
            ->withLevels($levels);
    }
    public function studentLedger(Request $request)
    {
        $totalPayments = 0;
        $totalCharges = 0;

        $payments = studentPayments::where('studentno', $request->regno)->get();
        $charges = AccountsReceivableLogs::where('studentno', $request->regno)->get();
        $student = Student::find($request->regno);
        $report = collect();
        $counter = 0;
        foreach ($payments as $p) {
            $totalPayments += $p->Amount;
            $counter++;
            $rRow = new studentledger();
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
            $rRow->txndate = $c->txndate;
            $rRow->StudentNo = $c->StudentNo;
            $rRow->Studentname = $c->Payee;
            $rRow->Description = $c->Description;
            $rRow->amountcr = 0;
            $rRow->amountdb = $c->amount;
            $report->put($counter, $rRow);
        }
        $report = $report->sortBy('txndate');
        $balance = 0;
        $table = " <div class='card  text-center card-header'>
           <b> Name: $student->fullname<br>
            Faculty: $student->faculty    
            , Course: $student->course    
            , Level: $student->level <br>
            Student Ledger
            </b>    
        </div>
        <table class= 'table table-responsive table-striped table-dark table-bordered'>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Charges</th>
            <th>Payments</th>
            <th>Balance(To be paid)</th>
        </tr>";
        foreach ($report as $r) {
            $balance += $r->amountcr == 0 ? $r->amountdb : (-1) * $r->amountcr;
            $table .= "<tr>
             <td>" . ($r->txndate ?? "NIL") . "</td> 
             <td>" . $r->Description . "</td> 
             <td  style='text-align:right;'>" . $this->formatNumber($r->amountdb) . "</td> 
             <td style='text-align:right;'>" . $this->formatNumber($r->amountcr) . "</td> 
             <td style='text-align:right;'>   " . $this->formatNumber($balance) . "</td> 
             </tr>";
        }
        $table .= "<tr> <td colspan='2' style='text-align:right;'>Total </td><td>" . $this->formatNumber($totalCharges) . "</td><td>" . $this->formatNumber($totalPayments) . "</td><td>" . $this->formatNumber($totalCharges - $totalPayments) . "</td></tr>";
        $table .= "<tr> <td colspan='4' style='text-align:right;'>Outstanding Balance</td><td>" . $this->formatNumber($totalCharges - $totalPayments) . "</td></tr>";
        $table .= "</table>";
        return view('reports.studentLedger')
            ->withTable($table);
    }
    public function owingParticularFee(Request $request)
    {
        $feeType = $request->feeType;
        $debtors = Student::where($feeType, '>', 0)
            ->where($feeType, '<', 99_999_999)
            ->orderBy('faculty')
            ->orderBy('course')
            ->orderBy('level')
            ->get();
        $table = $this->generateTable($debtors, $feeType, $request);
        return view('reports.owingParticularFee')->withTable($table);
    }
    public function formatNumber($number)
    {
        return number_format($number, 2, ".", ",");
    }
    public function generateTable($students, $type, $request)
    {
        $table = "";
        $facultyStudents = $students->groupby('PresentSection');
        foreach ($facultyStudents as $fgroup) {

            $table .= "<table class='table mb-5 table-responsive table-bordered table-dark table-stripped table-hover'>";
            $courseGroup = $fgroup->groupby('Arm');
            foreach ($courseGroup as $cp) {
                $levelGroup = $cp->groupby('class');
                foreach ($levelGroup as $lg) {
                    if ($request->has('faculty')) {
                        $table .= "<tr><th class='text-center' colspan='7'>" . $lg->first()->faculty . " " . $lg->first()->course . "-" . $lg->first()->level . "</th></tr>";
                    }
                    $table .= "<tr>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Course</th>
                        <th>Faculty</th>
                        <th>";
                    $table .= $type == "all" ? "Outstanding Fees" : $type . "</th>";
                    $table .= $type == "all" ? "<th>Outstanding Index Fee</th>
                        <th>Outstanding Board Fee</th>" : "";
                    $table .= "</tr>";
                    foreach ($lg as $student) {
                        $name = $student->MiddleName == "" ? $student->FirstName . " " . $student->LastName : $student->FirstName . " " . $student->MiddleName . " " . $student->LastName;
                        $table .= "<tr>
                    <td>    $name   </td>
                    <td>" . $student->level . "</td>
                    <td>" . $student->course . "</td>
                    <td>" . $student->faculty . "</td>
                    <td style='text-align:right;'>" . $this->formatNumber($student->fees) . "</td>";
                        $table .= $type == "all" ? "
                    <td style='text-align:right;'>" . $this->formatNumber($student->indexFee) . "</td>
                    <td style='text-align:right;'>" . $this->formatNumber($student->boardFee) . "</td>" : "";

                        $table .= "</tr>";
                    }
                }
            }
            $table .= "</table>";
        }
        return $table;
    }
}