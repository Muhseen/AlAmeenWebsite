@extends('layouts.soft')
@section('content')
<script src="{{asset('/js/students.js')}}" type="text/javascript" defer></script>
<div class="container">
    <form action="/Students" method="POST">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
            <p style="color:white;"> <strong>{{$error}}</strong></p>
            @endforeach
        </div>
        @endif
        @csrf
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Registration Number</label>
                    <input type="text" required name="regno" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Gender</label><br>
                    <div class="mt-2">
                        <input type="radio" name="gender" value="Male" class="form-radio">Male
                        <input type="radio" name="gender" value="Female" class="form-radio">Female
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">First Name</label>
                    <input type="text" required name="firstName" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Middle Name</label>
                    <input type="text" name="middleName" class="form-control">
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" required name="lastName" class="form-control">
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
                <div class="form-group"><label for=""></label><input type="text" class="form-control"></div>
            </div>
        </div>
</div>
<button type="submit" class="btn btn-primary btn-lg">Register Student</button>
</form>
</div>

@endsection