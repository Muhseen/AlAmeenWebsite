<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentScholarship extends Model
{
    use HasFactory;
    public $table ="discount"; 
    public function student()
    {
        return $this->belongsTo(Student::class, 'studentno', 'regno');
    }
}
