<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class studentPayments extends Model
{
    use HasFactory;
    public $table = "RvtxnLog";
    public $guarded = [];
    public  $timestamps = false;
    public function student()
    {
        return $this->belongsTo(Student::class, 'StudentNO', 'regno');
    }
}