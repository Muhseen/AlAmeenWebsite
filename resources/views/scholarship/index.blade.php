@extends('layouts.soft')
@section('content')
    <div class="container">
        <div class="d-print-none row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <a href="{{route('studentScholarship.create')}}">
                    <div class="card">
                        <div class="h6 card-title card-header">
                            Add Student to Scholarship List
                        </div>
                        <div class="card-body" height=500>
                            <div class="card-image col-">
                                <img src="{{asset('assets/img/student.png')}}" alt="student Icon"
                                    class="card-image h-25 w-100">
                            </div>
                        </div>
                      </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <a  href="/viewScholarshipList"><div class="card">
                    <div class="h6 card-title card-header">
                        View Scholarship Students
                    </div>
                    <div class="card-body" height=500>
                        <div class="card-image col-">
                            <img src="{{asset('assets/img/student.png')}}" alt="student Icon" class="card-image h-50 w-100">
                        </div>
                    </div>

                </div>
            </a>
            </div>
           </div>
    
    
        </div>
        @if ($sStudents->count() >0)
            <div class="row">
                <h3 class="text-center">
                    List of Students with Scholarships
                </h3>
            </div>
            <table class="table table-responsive table-striped table-hover">
                <tr>
                <th>Reg No</th>
                <th>Full Name</th>
                <th>Faculty</th>
                <th>Course</th>
                <th>Level</th>
                <th>Type</th>
                <th>Amount</th></tr>
        @endif
        <div class="row">
           @foreach ($sStudents as $sStudent)
              <tr>
                  <td>{{$sStudent->student->regno}}</td>
                  <td>{{$sStudent->student->fullname}}</td>
                  <td>{{$sStudent->student->faculty}}</td>
                  <td>{{$sStudent->student->course}}</td>
                  <td>{{$sStudent->student->level}}</td>
                  <td>{{$sStudent->type}}</td>
                  <td>{{$sStudent->amount??0}}</td>
                </tr> 
           @endforeach 
        </table>
        </div>
    </div>
@endsection