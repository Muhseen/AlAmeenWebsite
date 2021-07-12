<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\programmes;
use Illuminate\Http\Request;

class ProgrammesController extends Controller
{

    public function getCourses(Request $request)
    {
        $courses = programmes::where('faculty', $request->faculty)->select('course')->orderBy('course')->get();

        $levels = Student::where('faculty', $request->faculty)->where('course', $courses->first()->course)->select('level')->get()->unique();
        return ['courses' => $courses, 'levels' =>   $levels];
    }
    public function getLevels(Request $request)
    {

        return Student::where('faculty', $request->faculty)->where('course', $request->course)->select('class')->unique->get();
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function show(programmes $programmes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function edit(programmes $programmes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, programmes $programmes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function destroy(programmes $programmes)
    {
        //
    }
}