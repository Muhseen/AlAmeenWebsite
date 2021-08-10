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
        ->withSStudents($sStudent);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('scholarship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
