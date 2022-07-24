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
    public function index()
    {
        $progs = programmes::orderBy('faculty')->orderBy('course')->get();
        return view('programmes.index')->withProgs($progs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programmes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr =   $request->validate(['startLevel' => 'required', 'finishLevel' => 'required', 'faculty' => 'required', 'course' => 'required']);
        programmes::create($attr);
        return redirect('/programmes');
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
    public function edit($id, programmes $programmes)
    {
        $prog = programmes::find($id);

        return view(
            'programmes.edit'
        )->withProg($prog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\programmes  $programmes
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, programmes $programmes)
    {
        $attr =   $request->validate(['startLevel' => 'required', 'finishLevel' => 'required', 'faculty' => 'required', 'course' => 'required']);
        $prog = programmes::find($id);
        $prog->update($attr);
        return redirect('/programmes');
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