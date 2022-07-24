<?php

namespace App\QueryFilters\DebtorReports;

use Closure;

class Owing
{
    public function handle($query, Closure $next)
    {
        $builder = $next($query);
        return $builder->where(function ($query) {
            $query->where('fees', '>', 0)->where('fees', '<', 99999999)->orWhere(
                function ($query2) {
                    $query2->where('indexFee', '>', 0)->orWhere('boardFee', '>', 0);
                }
            );
        });
    }
}
