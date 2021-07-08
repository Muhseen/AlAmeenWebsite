@extends('layouts.soft')
@section('content')
<div class="container">
    <form action="/Students" method="POST">
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="close"></button>
        </div>
        @endforeach

        @endif
        @csrf
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
            </>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="form-group"><label for="">Date of Birth</label>
                        <input type="date" required class="form-control">
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="form-group">
                        <label for=""> State of Origin</label>
                        <select name="state" class="form-select">
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->state}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="form-group"><label for=""> Local Government</label>
                        <select name="lga" class="form-select">
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
                    <input type="text" name="stateOfResidence" class="form-control">
                </div>
                <div class="col-lg-3 col-md-12">
                    <label for="">LGA(Residing)</label>
                    <input type="text" name="lgaOfResidence" class="form-control">
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