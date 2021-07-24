<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\StatesAndLgas;
use App\Http\Requests\studentRequest;
use Illuminate\Support\Facades\Cache;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index');
    }
    public function create()
    {
        $faculties = cache('faculties');
        $levels = cache('levels');
        $courses = cache('courses');
        $states = Cache::get('states', StatesAndLgas::orderBy('state')->get()->unique('state'));
        return view('students.create')
            ->withStates($states)
            ->withFaculties($faculties)
            ->withLevels($levels)
            ->withCourses($courses);
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
        return Student::where('regno', $request->regno)->firstOrFail();
    }
}
