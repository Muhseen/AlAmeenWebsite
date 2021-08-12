@extends('layouts.soft')
@section('content')
    <div class="container">
        <!--<div class="d-print-none row">
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
                <a  href="/viewScholarshipList">
                    <div class="card h-100">
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
    
    
        </div>-->
        <div class="row">
            <div class="col">
                <a href="/studentScholarship/create" class="btn btn-info">
                Give Scholarship to Student
                </a>
            </div>
        </div>
        @if ($schoStudents->count() >0)
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
           @foreach ($schoStudents as $sStudent)
              <tr>
                  <td>{{$sStudent->regno}}</td>
                  <td>{{$sStudent->student->fullname}}</td>
                  <td>{{$sStudent->student->faculty}}</td>
                  <td>{{$sStudent->student->course}}</td>
                  <td>{{$sStudent->student->level}}</td>
                  <td>{{$sStudent->type}}</td>
                  <td>{{$sStudent->amount??0}}</td>
                    @can('update-scholarship')
                    <td>
                        <form action="/studentScholarship/{{$sStudent->regno}}/edit" method="GET">
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-trash    "></i>
                                DELETE
                            </button>
                            </form>
                    </td>
                    @endcan
                    @can('delete-scholarship')
                    <td> 
                        <form action="/studentScholarship/{{$sStudent->regno}}" method="POST">
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-trash    "></i>
                            DELETE
                        </button>
                        </form>
                    </td>
                    @endcan
</tr> 
           @endforeach 
        </table>
        </div>
    </div>
@endsection