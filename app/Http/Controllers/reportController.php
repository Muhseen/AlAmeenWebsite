<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\studentPayments;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;


class reportController extends Controller
{
    public function getOwingStudents(Request $request)
    {
        $table = "";
        $owingStudents = Student::getDebtors();
        $facultyStudents = $owingStudents->groupby('PresentSection');
        foreach ($facultyStudents as $fgroup) {
            $table .= "<table class='table mb-5 table-responsive table-bordered table-dark table-stripped table-hover'>";
            $courseGroup = $fgroup->groupby('Arm');
            foreach ($courseGroup as $cp) {
                $levelGroup = $cp->groupby('class');
                foreach ($levelGroup as $lg) {
                    if ($request->has('faculty')) {
                        $table .= "<tr><th class='text-center' colspan='7'>" . $lg->first()->faculty . " " . $lg->first()->course . "-" . $lg->first()->level . "</th></tr>";
                    }
                    $table .= "<tr>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Course</th>
                    <th>Faculty</th>
                    <th>Outstanding Fees</th>
                    <th>Outstanding Index Fee</th>
                    <th>Outstanding Board Fee</th>
                    </tr>";
                    foreach ($lg as $student) {
                        $name = $student->MiddleName == "" ? $student->FirstName . " " . $student->LastName : $student->FirstName . " " . $student->MiddleName . " " . $student->LastName;
                        $table .= "<tr>
                    <td>    $name   </td>
                    <td>" . $student->level . "</td>
                    <td>" . $student->course . "</td>
                    <td>" . $student->faculty . "</td>
                    <td style='text-align:right;'>" . $this->formatNumber($student->fees) . "</td>
                    <td style='text-align:right;'>" . $this->formatNumber($student->indexFee) . "</td>
                    <td style='text-align:right;'>" . $this->formatNumber($student->boardFee) . "</td>

                    </tr>";
                    }
                }
            }
            $table .= "</table>";
        }
        $faculties = DB::table('studentsnew')->select('faculty')->orderBy('faculty')->get()->unique();
        $courses = DB::table('studentsnew')->where('faculty', $faculties[0]->faculty)->select('course')->get()->unique();
        $levels = DB::table('studentsnew')->where('faculty', $faculties[0]->faculty)->where('course', $courses[0]->course)->select('level')->orderBy('level')->get()->unique();
        return view('reports.view')
            ->withTable($table)
            ->withFaculties($faculties)
            ->withCourses($courses)
            ->withLevels($levels);
    }
    public function formatNumber($number)
    {
        return number_format($number, 2, ".", ",");
    }
}