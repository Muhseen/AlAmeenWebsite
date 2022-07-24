<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantPayments extends Model
{
    use HasFactory;
    public $table = "applicantpayments";
    public $timestamps = false;
    public $primaryKey = 'Id';
}
