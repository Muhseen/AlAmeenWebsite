<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
    public function getChart()
    {
        $vals = [];
        $months = [];
        $now = Carbon::now();
        for ($i = 1; $i <= $now->month; $i++) {
            $month = Carbon::parse("2022-" . $i . "-01");
            $key = $month->monthName . "_" . $month->year;
            $amount = Cache::remember($key, 60 * 60,  function () use ($month) {
                return studentPayments::whereBetween('txndate', [
                    $month->startOfMonth()->format("Y-m-d"),
                    $month->endOfMonth()->format("Y-m-d")
                ])->sum('amount');
            });
            array_push($vals, $amount);
            //$vals[$month->monthName] =$amount;
            array_push($months, $month->monthName);
        }
        $twenty21 = ["twenty21" => [$vals, $months]];
        $twenty20 = [];
        $vals = [];
        $months = [];
        for ($i = 1; $i < 13; $i++) {
            $month = Carbon::parse("2021-" . $i . "-01");
            $key = $month->monthName . "_" . $month->year;
            $amount = Cache::rememberForever($key,  function () use ($month) {
                return studentPayments::whereBetween('txndate', [
                    $month->startOfMonth()->format("Y-m-d"),
                    $month->endOfMonth()->format("Y-m-d")
                ])->sum('amount');
            });
            array_push($vals, $amount);
            //$vals[$month->monthName] =$amount;
            array_push($months, $month->monthName);
        }
        $twenty20 = ["twenty20" => [$vals, $months]];


        return ["years" => [$twenty20, $twenty21]];
    }
}