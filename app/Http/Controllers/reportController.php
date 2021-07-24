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
    }

    public function getOwingStudents(Request $request)
    {
        $owingStudents = Student::getDebtors();
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
        $feeType = $request->feeType;
        $debtors = Student::where($feeType, '>', 0)
            ->where($feeType, '<', 99_999_999)
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
            ->withLevels($this->levels);
    }
    public function receiptsByDateRange(Request $request)
    {
        dd($request->startDate, $request->endDate);
        $receipts = studentPayments::whereBetween('Txndate', [$request->startDate, $request->endDate])->get();
        $table = tableGen::generateReceiptTable($receipts);
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
        return view('reports.view')->withTable($table)->withFaculties($this->faculties)
            ->withCourses($this->courses)
            ->withLevels($this->levels);;
    }
}