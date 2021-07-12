<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class orderBy
{
    public function handle($query, Closure $next)
    {
        $builder = $next($query);
        return $builder->ordeyby('level', 'asc');
    }
}