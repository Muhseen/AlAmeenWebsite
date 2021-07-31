<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Faculty
{
    public function handle($query, Closure $next)
    {
        if (request()->has('faculty') && request()->faculty != "all") {
            $builder = $next($query);
            return $builder->where('faculty', request()->faculty);
        }
        return $next($query);
    }
}