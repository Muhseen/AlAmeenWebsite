<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Owing
{
    public function handle($query, Closure $next)
    {
        $builder = $next($query);
        return $builder->where(function ($query) {
            $query->where('fees', '>', 0)->where('fees', '<', 99_999_999);
        })->orWhere('indexFee', '>', 0)->orWhere('boardFee', '>', 0);
    }
}