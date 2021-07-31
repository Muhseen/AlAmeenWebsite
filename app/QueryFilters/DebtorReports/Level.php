<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Level
{
    public function handle($query, Closure $next)
    {
        if (request()->has('level') && request()->level != "all") {
            $builder = $next($query);
            return $builder->where('level', request()->level);
        }
        // return $next($query);
    }
}