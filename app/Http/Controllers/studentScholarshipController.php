<?php

namespace App\Http\Controllers;

use App\Models\studentScholarship;
use Illuminate\Http\Request;

class studentScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sStudent = studentScholarship::all();
        return  view('scholarship.index')
        ->withSchoStudents($sStudent);

    }

    public function create()
    {
    return view('scholarship.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'regno'=>'required|unique:discount,regno', 
            'type' =>'required', 
            ], ['regno.unique'=>'This Student has already been offered scholarship']);
        $attr["amount"] = $attr["type"]=="Partial"?$request->amount:0;
        $attr["addedBy"] = auth()->user()->email;
        studentScholarship::create($attr);
        session()->flash('message', 'Succesfully added student to Scholarship list');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\studentScholarship  $studentScholarship
     * @return \Illuminate\Http\Response
     */
    public function show(studentScholarship $studentScholarship)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\studentScholarship  $studentScholarship
     * @return \Illuminate\Http\Response
     */
    public function edit(studentScholarship $studentScholarship)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\studentScholarship  $studentScholarship
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studentScholarship $studentScholarship)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studentScholarship  $studentScholarship
     * @return \Illuminate\Http\Response
     */
    public function destroy(studentScholarship $studentScholarship)
    {
        //
    }
}
