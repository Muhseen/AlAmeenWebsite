<?php

namespace App\Http\Controllers;

use App\Models\programmes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionsController extends Controller
{
    public function index()
    {
        return view('promotions.index');
    }
    public function processPromotions(Request $request)
    {
        $year = $request->year;
        try {
            //  dd(Student::where('id', 11484)->first());
            $studentsAll  = Student::all();
            DB::beginTransaction();
            DB::delete('delete from tempexport');
            DB::insert('insert into tempexport select * from students');

            //dd($students);
            $progs = programmes::all();
            foreach ($progs as $p) {
                $students = $studentsAll->where('faculty', $p->faculty)->where('course', $p->course);
                $query = "insert into students values("; //?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                foreach ($students as $s) {
                    if ($s->level < $p->finishLevel) {
                        $s->level += 100;
                    } else if ($s->level == $p->finishLevel) {
                        $s->level = 'Grad-' . $year;
                        $s->status = 'inactive';
                    }
                    $s->save();
                }
            }

            DB::commit();
            session()->flash('message', "Succesfully Prcessed Promotions");
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}