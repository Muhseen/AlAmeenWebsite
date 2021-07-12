@extends('layouts.soft')
@section('content')
<script src="{{asset('/assets/js/reports.js')}}" type="text/javascript" defer></script>
<div class="container">
    <form method="GET" action="/reports/owing">
        <div class="row d-print-none">
            <div class=" form-group col-lg-5 col-md-4 col-sm-6 col-xs-12">
                <lable>Faculty</lable>
                <select name="faculty" id="cboFaculty" class="form-select">
                    @foreach ($faculties as $faculty)
                    <option value="{{$faculty->faculty}}">{{$faculty->faculty}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <lable>Course</lable>
                <select name="course" id="cboCourses" class="form-select">
                    <option value="all">All Courses</option>
                    @foreach ($courses as $course)
                    <option value="{{$course->course}}"
                        {{request()->has('course')&&request()->course==$course->course?"selected":""}}>
                        {{$course->course}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <label>Level</label>
                <select name="level" id="cboLevel" value="{{request()->has('level')?request()->level:"all"}}"
                    class="form-select">
                    <option value="all">All Levels</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                </select>
            </div>
            <div class=" col-lg-1 mt-4 col-md-2 col-sm-6 col-xs-12">
                <button type="submit" class="btn btn-primary btn-sm">
                    Find Debtors
                </button>
            </div>
    </form>
</div>
<div class="table-container">
    {!!$table!!}
</div>
</div>
@endsection