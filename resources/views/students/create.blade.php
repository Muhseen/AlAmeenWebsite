@extends('layouts.soft')
@section('content')
<script src="{{asset('/js/students.js')}}" type="text/javascript" defer></script>
<div class="card container">
    <form action="/Students" method="POST">
        @include('partials.errors')
        @csrf
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Registration Number</label>
                    <input type="text" required name="regno" class="form-control">
                </div>
            </div>
            <div class="col-lg-1 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Gender</label><br>
                    <div class="mt-2">
                        <input type="radio" name="gender" value="Male" class="form-radio">Male
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" required name="FirstName" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Middle Name</label>
                    <input type="text" name="MiddleName" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" required name="LastName" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group"><label for="">Common Name(Alias)</label>
                    <input type="text" name="alias" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="form-group"><label for="">Date of Birth</label>
                    <input type="date" required class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for=""> State of Origin</label>
                    <select name="state" class="form-select cboState">
                        @foreach ($states as $state)
                        <option value="{{$state->state}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="form-group"><label for=""> Local Government</label>
                    <select name="lga" class="form-select cboLga">
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="">Admission Date</label>
                    <input type="date" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 form-group">
                <label for="">Street Address</label>
                <textarea type="text" name="StreetAddress" class="form-control">
                </textarea>
            </div>

            <div class="col-lg-3 col-md-12">
                <label for="">State(Residing)</label>
                <select name="state" class="form-select cboState">
                    @foreach ($states as $state)
                    <option value="{{$state->state}}">{{$state->state}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-12">
                <label for="">LGA(Residing)</label>
                <select name="" class="form-select cboLga">
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Parent/guardian Name</label>
                    <input type="text" name="parentname" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Parent Contact</label>
                    <input type="text" class="form-control" name="parentcontact">
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Parent's Occupation</label>
                    <input type="text" name="parentoccupation" class="form-control"></div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Physical Challenge(if any)</label>
                    <input type="text" name="PChallenge" value="NIL" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Bloodgroup</label>
                    <select name="bloodgroup" id="" class="form-select">
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B+</option>
                        <option value="AB-">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Genotype</label>
                    <select name="genotype" id="" class="form-select">
                        <option value="AA">AA</option>
                        <option value="AS">AS</option>
                        <option value="AC">AC</option>
                        <option value="SS">SS</option>
                        <option value="SC">SC</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Faculty</label>
                    <select name="faculty" id="" class="form-select">
                        @foreach ($faculties as $faculty)
                        <option value="{{$faculty->faculty}}">{{$faculty->faculty}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Course</label>
                    <select name="course" id="" class="form-select">
                        @foreach ($courses as $course)
                        <option value="{{$course->course}}">{{$course->course}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Level</label>
                    <select name="level" id="" class="form-select">
                        @foreach ($levels as $level)
                        <option value="{{$level->level}}">{{$level->level}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Register Student</button>
</div>
</form>
</div>

@endsection