<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsReceivableLogs extends Model
{
    public $table = "accountreceivablelog";
    public $timestamps = false;
    public $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'studentno', 'regno');
    }
}