<?php

namespace App\Http\Controllers;

use App\Models\AccountsReceivableLogs;
use App\Models\Student;
use App\Models\studentledger;
use App\Models\studentPayments;
use App\QueryFilters\DebtorReports\orderBy;
use App\Services\Reports\tableGen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\AccountCodes;
use App\Models\BankAccounts;
use Carbon\Carbon;

class reportController extends Controller
{
    public function __construct()
    {
        $this->faculties = Cache::rememberForever('faculties',    function () {
            return DB::table('studentsnew')->select('faculty')->orderBy('faculty')->get()->unique();
        });
        $this->courses = Cache::rememberForever('courses', function () {
            return DB::table('studentsnew')->select(['course', 'faculty'])->get()->unique();
        });
        $this->courses = $this->courses->where('faculty', $this->faculties[0]->faculty);
        $this->levels = Cache::rememberForever('levels',  function () {
            return DB::table('studentsnew')->select('level')->orderBy('level')->get()->unique();
        });
        $this->AccountCodes  = AccountCodes::where('code', 'like', '1%')->get();
        $this->BankAccounts = BankAccounts::all();
    }

    public function getOwingStudents(Request $request)
    {
        $owingStudents = Student::getStudents(true);
        $table = tableGen::generateDebtorTable($owingStudents, 'all', $request);
        return view('reports.view')
            ->withTable($table)
            ->withFaculties($this->faculties)
            ->withCourses($this->courses)
            ->withLevels($this->levels);
    }
    public function studentLedger(Request $request)
    {
        $payments = studentPayments::where('studentno', $request->regno)->get();
        $charges = AccountsReceivableLogs::where('studentno', $request->regno)->get();
        $student = Student::find($request->regno);
        $report = collect();
        $table = tableGen::generateStudentLedger($student, $report, $charges, $payments);
        return view('reports.studentLedger')
            ->withTable($table);
    }
    public function owingParticularFee(Request $request)
    {
        $feeType = $request->type;
        $debtors = Student::where($feeType, '>', 0)
            ->where($feeType, '<', 99999999)
            ->orderBy('faculty')
            ->orderBy('course')
            ->orderBy('level')->get();
        $table = tableGen::generateDebtorTable($debtors, $feeType, $request);
        return view('reports.owingParticularFee')
            ->withTable($table);
    }
    public function formatNumber($number)
    {
        return number_format($number, 2, ".", ",");
    }
    public function index()
    {
        return view('reports.index')
            ->withFaculties($this->faculties)
            ->withCourses($this->courses)
            ->withLevels($this->levels)
            ->withAccountCodes($this->AccountCodes)
            ->withBankAccounts($this->BankAccounts);
    }
    public function receiptsByDateRange(Request $request)
    {
        $receipts = null;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        if ($request->has('dashboard')) {
            $date =  Carbon::now();
            $date2 = Carbon::now();
            if ($request->type == "day") {
                $startDate = $date->startOfDay();
                $endDate = $date2->endOfDay();
            } else if ($request->type == "week") {
                $startDate = $date->startOfWeek();
                $endDate = $date2->endOfWeek();
            } else if ($request->type == "month") {
                $startDate = $date->startOfMonth();
                $endDate = $date2->endOfMonth();
            }
            $startDate = $startDate->format("Y-m-d");
            $endDate = $endDate->format("Y-m-d");
        }
        if ($startDate != null && $endDate != null) {
            $receipts = studentPayments::whereBetween('TxnDate', [$startDate, $endDate])->get();
            $header = "Payments made between $startDate and $endDate";
            $table = tableGen::generateReceiptTable($receipts, $header);
            return view('reports.studentLedger')->withTable($table);
        } else {
            return back()->withErrors("Unspecified date Range");
        }
    }
    public function receiptsByName(Request $request)
    {
        $name = $request->name;
        $names = explode(" ", $name);
        if (count($names) == 1) {
            $receipts = studentPayments::where('Payer', 'like', '%' . $names[0] . '%')->get();
        } else if (count($names) == 2) {
            $receipts = studentPayments::where('Payer', 'like', '%' . $names[0] . '%')->Where('Payer', 'like', '%' . $names[1] . '%')->get();
        } else if (count($names) == 3) {
            $receipts = studentPayments::where('Payer', 'like', '%' . $names[0] . '%')->Where('Payer', 'like', '%' . $names[1] . '%')->Where('Payer', 'like', '%' . $names[2] . '%')->get();
        }
        $receipts = $receipts->sortBy('Txndate');
        $table = tableGen::generateReceiptTable($receipts);
        return view('reports.studentLedger')->withTable($table);
    }
    public function receiptsByClass(Request $request)
    {
        $regnos = Student::getStudents(false)->pluck('regno');
        $studentPayments = studentPayments::whereIn('studentno', $regnos->toArray())
            ->orderBy('StudentNo')
            ->orderBy('Txndate')
            ->get();
        //$header = "Payments made between $startDate and $endDate";
        $table = tableGen::generateReceiptTable($studentPayments, "");
        return view('reports.studentLedger')->withTable($table);
    }
    public function receiptsByAccountCode(Request $request)
    {
        $header = "Payments made for Account Code " . $request->code;
        $receipts = studentPayments::where('paycode', $request->code)->get();
        $table = tableGen::generateReceiptTable($receipts, $header);
        return view('reports.studentLedger')->withTable($table);
    }
    public function receiptsPaidIntoAccount(Request $request)

    {
        $header = "Payments Made in to $request->paidTo";
        $receipts = studentPayments::where('Bank', $request->paidTo)->get();
        $table = tableGen::generateReceiptTable($receipts, $header);
        return view('reports.studentLedger')->withTable($table);
    }
}