<?php

namespace App\Http\Controllers;

use App\Models\AccountCodes;
use App\Models\BankAccounts;
use App\Models\Student;
use App\Models\studentPayments;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Matcher\ExpressionLanguageProvider;
use Illuminate\Support\Facade\DB;

class StudentPaymentsController extends Controller
{
    public function __construct()
    {
        $this->validationRule = [
            'TxnDate' => 'required',
            'ReceiptNo' => 'required',
            'StudentNO' => 'required',
            'Bank' => 'required',
            'Section' => 'required',
            'Payer' => 'required',
            'Description' => 'required',
            'TellerNo', 'PayCode',
            'Amount' => 'required',
            'Category' => 'required'
        ];
    }
    public function index()
    {
        $bankAccounts = BankAccounts::all();
        $accountCodes = AccountCodes::where('code', 'like', '1%')->get();
        return view('studentPayments.index')
            ->withAccountCodes($accountCodes)
            ->withBankAccounts($bankAccounts);
    }
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $student = Student::where('regno', $request->StudentNO)->first();
            if ($student == null) {
                return back()->withErrors("Invalid Regno Provided");
            }
            $desc = explode(":",  $request->code);
            $request->merge(['Category' => $desc[0], 'Section' => $student->faculty, 'Payer' => $student->fullname, 'Description' => $desc[1], 'Code' => $desc[0]]);
            $attr = $request->validate($this->validationRule);
            studentPayments::create($attr);
            $student->fees -= $request->Amount;
            $student->save();
            session()->flash('message', 'Payment Successful, Generat Receipt');
            return back();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}