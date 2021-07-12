<?php

namespace App\QueryFilters\DebtorReports;

use App\Models\Student;
use Closure;

class Course
{
    public function handle($query, Closure $next)
    {
        if (request()->has('course') && request()->course != "all") {
            $builder = $next($query);
            return $builder->where('course', request()->course);
        }
        return $next($query);
    }
}