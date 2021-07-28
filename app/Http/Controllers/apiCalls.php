<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class apiCalls extends Controller
{
    public function getCourses(Request $request)
    {
        return DB::select('select distinct(course) as courses from studentsnew  where faculty = ?', [$request->faculty]);
    }
    public function getLevels(Request $request)
    {
        return DB::select('select distinct(level) as levels from studentsnew  where faculty = ? and course = ?', [$request->faculty, $request->course]);
    }
}