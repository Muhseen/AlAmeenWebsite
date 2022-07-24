<?php

namespace App\Http\Controllers;

use App\Models\studentPayments;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\AccountCodes;
use App\Models\BankAccounts;
use Illuminate\Support\Facades\DB;

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
        $this->AccountCodes  = AccountCodes::where('code', 'like', '1%')->get();
        $this->BankAccounts = BankAccounts::all();
        $now = Carbon::now();
        for ($i = 1; $i < $now->month; $i++) {
            $month = Carbon::parse("2022-" . $i . "-01");
            $key = $month->monthName . "_" . $month->year;
            $amount = Cache::rememberForever($key,  function () use ($month) {
                return studentPayments::whereBetween('txndate', [
                    $month->startOfMonth()->format("Y-m-d"),
                    $month->endOfMonth()->format("Y-m-d")
                ])->sum('amount');
            });
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //studenst details
        $studentCount = Student::count();
        $activeCount = Student::whereStatus('active')->count();
        $grad = Student::where('level', 'like', '%grad%')->count();
        $owing =  Student::where('fees', '>', 0)->count();
        $affiliates = Student::where('isaffiliate', true)->count();

        $date = Carbon::now();
        $today = $this->formatNumber(studentPayments::whereBetween('txndate', [$date->startOfDay()->toDateTimeString(), $date->endOfDay()->toDateTimeString()])->sum('amount'));
        $thisweek = $this->formatNumber(studentPayments::whereBetween('txndate', [$date->startOfWeek()->toDateTimeString(), $date->endOfWeek()->toDateTimeString()])->sum('amount'));
        $thismonthAmount = cache::rememberForever($date->monthName . "_" . $date->year, function () use ($date) {
            return studentPayments::whereBetween('txndate', [$date->startOfMonth()->format("Y-m-d"), $date->endOfMonth()->format(("Y-m-d"))])->sum('amount');
        });
        $thisMonth = $this->formatNumber(
            $thismonthAmount
        );
        $m = $date->month - 1;
        $monthBefore = Carbon::parse($date->year . "-" . $m . "-01");
        $amountFormonthBefore = Cache::get($monthBefore->monthName . "_" . $monthBefore->year, 1);
        $perc = $thismonthAmount - $amountFormonthBefore;
        $amountFormonthBefore = $amountFormonthBefore == 0 ? 1 : $amountFormonthBefore;
        $perc = ($perc / $amountFormonthBefore);
        $perc *= 100;
        $perc =  number_format($perc, 2, ".", "");
        $count = Student::where('status', 1)->count();
        return view('home')
            ->withToday($today)
            ->withTomorrow($thisweek)
            ->withThisMonth($thisMonth)
            ->withStudentCount($count)
            ->withPercentage($perc)
            ->withAffiliateCount($affiliates)
            ->withStudentCount($studentCount)->withActiveCount($activeCount)->withGraduatedCount($grad)->withOwingCount($owing);
    }
    public function formatNumber($number)
    {
        return "&#8358 " . number_format($number, 2, ".", ",");
    }
}