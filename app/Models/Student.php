<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Student extends Model
{
    use HasFactory;
    public $table = "students";
    public $primaryKey = "regno";

    public static function getDebtors()
    {

        return $owingStudents = app(Pipeline::class)
            ->send(Student::query())
            ->through([
                \App\QueryFilters\DebtorReports\Owing::class,
                \App\QueryFilters\DebtorReports\Faculty::class,
                \App\QueryFilters\DebtorReports\Course::class,
                \App\QueryFilters\DebtorReports\Level::class,
            ])->thenReturn()->orderBy('class', 'asc')->get();
    }
}