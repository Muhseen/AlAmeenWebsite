<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\AccountCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Models\AccountsReceivableLogs;
use Illuminate\Support\Str;

class SetFeesController extends Controller
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
    }
    public function index()
    {
        return view('setFees.index')
            ->withFaculties($this->faculties)
            ->withAccountCodes($this->AccountCodes);
    }
    public function particularStudent(Request $request)
    {
        $desc = explode(":", $request->code)[1];
        $code = explode(":", $request->code)[0];
        $desc .= " " . $request->semester . " Semester " . $request->session;
        $amount = $request->amount;
        DB::beginTransaction();
        try {
            $student = Student::where('regno', $request->regno)->first();
            $this->makeARL([
                'amount' => $amount,
                'txndate' => now(),
                'StudentName' => $student->fullname,
                'studentno' => $student->regno,
                'Description' => $desc,
                'category' => 'INC',
                'categoryid' => $code
            ]);
            $this->makeTransaction([
                'txndate' => now(),
                'payee' => $student->fullname,
                'description' => $desc,
                'accountcode' => $code,
                'amountdr' => 0,
                'amountcr' => $amount,
                'receiptno' => ''
            ]);
            if (Str::contains($desc, 'Board Fee')) {
                $student->boardFee += $amount;
            } else if (Str::contains($desc, 'Index Fee')) {
                $student->indexFee += $amount;
            } else {
                $student->fees += $amount;
            }
            $student->save();
            session()->flash('message', 'Succesfully set Fees for' . $student->fullname);
            DB::commit();
            return back();
        } catch (Exception $e) {
            dd($e, $e->getMessage());
            DB::rollBack();
        }
    }
    public function particularClass(Request $request)
    {
        $desc = explode(":", $request->code)[1];
        $code = explode(":", $request->code)[0];
        $amount = $request->amount;
        DB::beginTransaction();
        try {
            $students = Student::getStudents(false);
            foreach ($students as $student) {
                $this->makeARL([
                    'amount' => $amount,
                    'txndate' => now(),
                    'StudentName' => $student->fullname,
                    'studentno' => $student->regno,
                    'Description' => $desc,
                    'category' => 'INC',
                    'categoryid' => $code
                ]);
                $this->makeTransaction([
                    'txndate' => now(),
                    'payee' => $student->fullname,
                    'description' => $desc,
                    'accountcode' => $code,
                    'amountdr' => 0,
                    'amountcr' => $amount,
                    'receiptno' => ''
                ]);
                if (Str::contains($desc, 'Board Fee')) {
                    $student->boardFee += $amount;
                } else if (Str::contains($desc, 'Index Fee')) {
                    $student->indexFee += $amount;
                } else {
                    $student->fees += $amount;
                }
                $student->save();
            }
            session()->flash('message', 'Succesfully set Fees for' . $request->faculty . ' ' . $request->course ?? "" . ' ' . $request->level ?? "");
            DB::commit();
            return back();
        } catch (Exception $e) {
            dd($e, $e->getMessage());
            DB::rollBack();
        }
    }
    public function allStudents(Request $request)
    {
    }
    public function makeARL($parameters)
    {
        AccountsReceivableLogs::create($parameters);
    }
    public function makeTransaction($parameters)
    {
        Transaction::create($parameters);
    }
}