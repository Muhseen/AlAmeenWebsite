<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Owing
{
    public function handle($query, Closure $next)
    {
        $builder = $next($query);
        return $builder->where('fees', '>', 0)->where('fees', '<', 99_999_999);
    }
}