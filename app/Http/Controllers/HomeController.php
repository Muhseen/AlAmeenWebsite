<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $date = Carbon::now();
        $today = $this->formatNumber(studentPayments::whereBetween('txndate', [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()])->sum('amount'));
        $thisweek = $this->formatNumber(studentPayments::whereBetween('txndate', [$date->startOfWeek()->toDateTimeString(), $date->endOfWeek()->toDateTimeString()])->sum('amount'));
        $thisMonth = $this->formatNumber(studentPayments::whereBetween('txndate', ['2021-07-01', '2021-07-31'])->sum('amount')); //
        $count = Student::where('status', 1)->count();
        return view('home')
            ->withToday($today)
            ->withTomorrow($thisweek)
            ->withThisMonth($thisMonth)
            ->withStudentCount($count)
            ->withMonths([
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ]);
    }
    public function formatNumber($number)
    {
        return "&#8358 " . number_format($number, 2, ".", ",");
    }
}