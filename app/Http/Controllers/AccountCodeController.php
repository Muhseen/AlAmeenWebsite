<?php

namespace App\Http\Controllers;

use App\Models\AccountCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountCodes = AccountCodes::where('code', 'like', '1%')->get();
        return view('accountCodes.index')->withAccountCodes($accountCodes);        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accountCodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'type' => 'required',
            'Description' => 'required|unique:AccountCodes,Description'
        ]);
        $code = DB::select('select max(code) as code from accountcodes where class = ?', [$request->type]);
        $code = $code[0]->code;
        $ac = new AccountCodes();
        $ac->class = $request->type;
        $ac->Code = $code + 1;
        $ac->Description = $request->Description;
        $ac->ytd = 0;
        $ac->ttd = 0;
        $ac->category = "";
        $ac->save();
        session()->flash('message', 'Successfully Added The Accountcode. This can now be used to make or receive payments');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountCodes  $accountCodes
     * @return \Illuminate\Http\Response
     */
    public function show(AccountCodes $accountCodes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountCodes  $accountCodes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountCodes = AccountCodes::findOrFail($id);
        return view('accountCodes.edit')->withAc($accountCodes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountCodes  $accountCodes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $accountCodes = AccountCodes::findOrFail($id);

        $accountCodes->class = $request->type;
        $accountCodes->Description = $request->Description;
        $accountCodes->save();

        session()->flash('message', 'Successfully Updated The Code');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountCodes  $accountCodes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accountCodes = AccountCodes::findOrFail($id);

        $accountCodes->delete();
        session()->flash('message', 'Succesfully Delete The Code');
        return back();
    }
}