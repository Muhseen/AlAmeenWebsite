<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Faculty
{
    public function handle($query, Closure $next)
    {
        if (!request()->has('faculty')) {
            return $next($query);
        }
        $builder = $next($query);
        return $builder->where('faculty', request()->faculty);
    }
}