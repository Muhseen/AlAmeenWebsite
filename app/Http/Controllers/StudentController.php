<?php

namespace App\Http\Controllers;

use App\Http\Requests\studentRequest;
use App\Models\StatesAndLgas;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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
        $this->states = Cache::rememberForever('states', function () {
            return StatesAndLgas::orderBy('state')->pluck('state')->unique();
        });
        // dd($this->states);
        //dd($this->states);
    }
    public function index()
    {
        return view('students.index');
    }
    public function create()
    {
        return view('students.create')
            ->withStates($this->states)
            ->withFaculties($this->faculties)
            ->withLevels($this->levels)
            ->withCourses($this->courses);
    }
    public function store(studentRequest $request)
    {
        $values = $request->validated();
        $student = (new Student)->fill($values)->save();
        session()->flash('message', 'Succesfully added Student');
        return back();
    }
    public function getStudent(Request $request)
    {
        return Student::where('regno', $request->regno)->first();
    }
    public function update(studentRequest $request)
    {
    }
    public function edit(Request $request)
    {

        $student = Student::whereRegno($request->regno)->first();
        if ($student == null) {
            return redirect('/students')->withErrors("NO Student with this registration number");
        }
        dd($this->states);
        return view('students.edit')
            ->withStudent($student)
            ->withStates($this->states)
            ->withFaculties($this->faculties)
            ->withLevels($this->levels)
            ->withCourses($this->courses);
    }
}