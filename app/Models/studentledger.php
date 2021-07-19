<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentledger extends Model
{
    use HasFactory;
    public $table = "receivable";
    public $timestamps = false;
}