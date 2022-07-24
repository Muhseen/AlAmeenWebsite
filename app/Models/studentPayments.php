<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class studentPayments extends Model
{
    public $table = "rvtxnlog";
    public $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentNO', 'regno');
    }
}
