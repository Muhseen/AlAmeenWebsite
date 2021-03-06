<?php

namespace App\Http\Controllers;

use App\Models\AccountCodes;
use App\Models\BankAccounts;
use App\Models\Student;
use App\Models\studentPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPaymentsController extends Controller
{
    public function __construct()
    {
        $this->validationRule = [
            'TxnDate' => 'required',
            'ReceiptNo' => 'required|unique:rvtxnlog',
            'StudentNO' => 'required',
            'Bank' => 'required',
            'Section' => 'required',
            'Payer' => 'required',
            'Description' => 'required',
            'TellerNo', 'PayCode',
            'Amount' => 'required',
            'Category' => 'required',
            'captured_by' => 'required'

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
            $request->merge(['captured_by' => auth()->user()->email, 'Category' => $desc[0], 'Section' => $student->faculty, 'Payer' => $student->fullname, 'Description' => $desc[1], 'Code' => $desc[0]]);
            $attr = $request->validate($this->validationRule);
            studentPayments::create($attr);
            $student->fees -= $request->Amount;
            $student->save();
            session()->flash('message', 'Payment Successful, Generat Receipt');
            DB::commit();
            return back();
        } catch (\Exception $e) {
            //dd($e);
            return back()->withErrors($e);
            DB::rollback();
        }
    }
    public function deleteReceipt(Request $request)

    {
        $payment = studentPayments::where('ReceiptNo', $request->receiptNo)->first();
        $student = Student::where('regno', $payment->StudentNO)->first();
        $student->fees += $payment->Amount;
        $student->save();
        DB::delete('delete from rvtxnlog where id = ?',  [$payment->Id]);
        session()->flash('message', 'Succesfully deleted Receipt and Reversed The Transaction');
        return back();
    }
}
