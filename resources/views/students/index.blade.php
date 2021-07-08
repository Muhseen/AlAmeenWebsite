@extends('layouts.soft')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
            <a href="{{route('Students.create')}}">
                <div class="card">
                    <div class="h3 card-header">
                        Add New Student
                    </div>
                    <div class="card-body" height=500>
                        <div class="card-image col-">
                            <img src="{{asset('assets/img/student.png')}}" alt="student Icon"
                                class="card-image h-50 w-100">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary w-100">
                            Click
                        </button>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
            <div class="card">
                <div class="h3 card-header">
                    Edit Student Record
                </div>
                <div class="card-body" height=500>
                    <div class="card-image col-">
                        <img src="{{asset('assets/img/student.png')}}" alt="student Icon" class="card-image h-50 w-100">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100">
                        Click
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
            <div class="card">
                <div class="h3 card-header">
                    View Student List
                </div>
                <div class="card-body" height=500>
                    <div class="card-image col-">
                        <img src="{{asset('assets/img/student.png')}}" alt="student Icon" class="card-image h-50 w-100">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100">
                        Click
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
            <div class="card">
                <div class="h3 card-header">
                    Add New Student
                </div>
                <div class="card-body" height=500>
                    <div class="card-image col-">
                        <img src="{{asset('assets/img/student.png')}}" alt="student Icon" class="card-image h-50 w-100">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary w-100">
                        Click
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection