<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;
use App\Models\AccountsReceivableLogs;

class Student extends Model
{
    use HasFactory;
    public $table = "students";
    public $incrementing = false;
    public $primaryKey = "regno";
    public $timestamps   = false;
    protected $guarded = [];
    public static function getStudents($withOwing)
    {
        $criteria = [
            \App\QueryFilters\DebtorReports\Faculty::class,
            \App\QueryFilters\DebtorReports\Course::class,
            \App\QueryFilters\DebtorReports\Level::class,
        ];
        if ($withOwing) {
            array_push(
                $criteria,
                \App\QueryFilters\DebtorReports\Owing::class
            );
        }
        return app(Pipeline::class)
            ->send(Student::query())
            ->through($criteria)->thenReturn()->orderBy('level', 'asc')->orderBy('course')->get();
    }
    public function ARL()
    {
        return $this->hasMany(
            AccountsReceivablelogs::class,
            'studentno',
            'regno'
        );
    }
    public function payments()
    {
        return $this->hasMany(studentPayments::class, 'StudentNO', 'regno');
    }
    public function getFullnameAttribute()
    {
        if ($this->MiddleName != "") {
            return $this->FirstName . " " . $this->MiddleName . " " . $this->LastName;
        }
        return $this->FirstName . " " . $this->LastName;
    }
}
