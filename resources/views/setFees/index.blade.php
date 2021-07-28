@extends('layouts.soft')
@section('content')
@include('partials.errors')
<script src="{{asset('assets/js/studentCalls.js')}}" type="text/javascript" defer></script>
<script src="{{asset('assets/js/facultyCalls.js')}}" type="text/javascript" defer></script>
<div class="container">
    <div class="card mb-3">
        <div class="card-header">
            <h2 class="card-title">
                Set Fees for All Students
            </h2>
            <p class="card-text">Leave Amount blank or '0' if it should get the amount from fees breakdown </p>
        </div>
        <div class="card-body">
            <form action="/setFeesForAll" method="GET">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Fee description</label>
                            <select name="code" type="text" class="form-select">
                                @foreach ($accountCodes as $ac)
                                <option value="{{$ac->Code}}:{{$ac->Description    }}">{{$ac->Description    }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Session</label>
                            <select name="session" type="text" class="form-select">
                                <option value="18/19">18/19</option>
                                <option value="19/20">19/20</option>
                                <option value="20/21">20/21</option>
                                <option value="21/22">21/22</option>
                                <option value="22/23">22/23</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Semester/Session</label>
                            <select name="semester" type="text" class="form-select">
                                <option value="First">First Semester</option>
                                <option value="Second">Second Semester</option>
                                <option value="Session">Entire Session</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input name="amount" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-info"> Set Fees</button></div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h2 class="card-title">
                Set Fees for Faculty , Course, Level
            </h2>
            <p class="card-text">Leave Amount blank or '0' if it should get the amount from fees breakdown </p>
        </div>
        <div class="card-body">
            <form action="/setParticularClass" method="GET">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Faculty</label>
                                <select name="code" id="cboFaculty" type="text" class="form-select">
                                    @foreach ($faculties as $faculty)
                                    <option value="{{$faculty->faculty}}">{{$faculty->faculty}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Course</label>
                                <select name="course" id="cboCourses" type="text" class="form-select">
                                    <option value="all">All Courses in the Faculty</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Level</label>
                                <select name="level" id="cboLevels" type="text" class="form-select">
                                    <option value="all">All Levels</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Fee description</label>
                                <select name="code" type="text" class="form-select">
                                    @foreach ($accountCodes as $ac)
                                    <option value="{{$ac->Code}}:{{$ac->Description    }}">{{$ac->Description    }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Session</label>
                                <select name="session" type="text" class="form-select">
                                    <option value="18/19">18/19</option>
                                    <option value="19/20">19/20</option>
                                    <option value="20/21">20/21</option>
                                    <option value="21/22">21/22</option>
                                    <option value="22/23">22/23</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Semester/Session</label>
                                <select name="semester" type="text" class="form-select">
                                    <option value="First">First Semester</option>
                                    <option value="Second">Second Semester</option>
                                    <option value="Session">Entire Session</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input name="amount" value="0" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-info"> Set Fees</button></div>
                    </div>

                </div>

            </form>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <h2 class="card-title">
                Set Fees for Particular Student
            </h2>
            <p class="card-text">Leave Amount blank or '0' if it should get the amount from fees breakdown </p>
        </div>
        <div class="card-body">
            <form action="/setParticularStudent" method="GET">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Registration Number</label>
                                <input type="text" id="regno" name="regno" class="form-control"></div>
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Student Details</label>
                                <input type="text" disabled id="details" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Fee description</label>
                                <select name="code" type="text" class="form-select">
                                    @foreach ($accountCodes as $ac)
                                    <option value="{{$ac->Code}}:{{$ac->Description    }}">{{$ac->Description    }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Session</label>
                                <select name="session" type="text" class="form-select">
                                    <option value="18/19">18/19</option>
                                    <option value="19/20">19/20</option>
                                    <option value="20/21" selected>20/21</option>
                                    <option value="21/22">21/22</option>
                                    <option value="22/23">22/23</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Semester/Session</label>
                                <select name="semester" type="text" class="form-select">
                                    <option value="First">First Semester</option>
                                    <option value="Second">Second Semester</option>
                                    <option value="Session">Entire Session</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input name="amount" value="0" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-info"> Set Fees</button></div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div> @endsection