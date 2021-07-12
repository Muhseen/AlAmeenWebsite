<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsReceivableLogs extends Model
{
    /* Get the user that owns the AccountsReceivableLogs
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
    public function user()
    {
        return $this->belongsTo(Student::class, 'regno', 'regno');
    }
}