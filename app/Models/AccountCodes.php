<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountCodes extends Model
{
    use HasFactory;
    public $table = "accountcodes";
    public $timestamps = false;
}