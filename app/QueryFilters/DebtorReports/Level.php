<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Level
{
    public function handle($query, Closure $next)
    {
        if (request()->has('Faculty') && request()->level != "all") {
            $builder = $next($query);
            return $builder->where('class', request()->Level);
        }
        return $next($query);
    }
}