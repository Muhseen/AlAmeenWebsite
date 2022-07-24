@extends('layouts.soft')
@section('content')
    <script src="{{ asset('/assets/js/studentCalls.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('/assets/js/statesAndLgas.js') }}" type="text/javascript" defer></script>
    <div class="card container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="biodata-tab" data-toggle="tab" href="#biodata" role="tab"
                    aria-controls="biodata" aria-selected="true">Bio Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="olevels-tab" data-toggle="tab" href="#olevels" role="tab"
                    aria-controls="olevels" aria-selected="false">O'Levels Data</a>
            </li>
        </ul>

        <form action="/Students" method="POST">
           
            <div class="tab-pane fade show active" id="biodata" role="tabpanel" aria-labelledby="biodata-tab">


                @include('partials.errors')
                @csrf
                <div class="row">
                    <h2 class="card-text">
                        BIODATA
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Application Number</label>
                            <input type="text" required disabled name="regno" value="{{ old('regno') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Gender</label><br>
                            <div class="mt-2">
                                <input type="radio" name="gender" value="Male" class="mr-2 form-radio"
                                    {{ old('gender') == 'Male' ? 'selected' : '' }}>Male
                                <input type="radio" name="gender" value="Male" class="ml-3 form-radio"
                                    {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" value="{{ old('FirstName') }}" required name="FirstName"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text" name="MiddleName" value="{{ old('MiddleName') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" required name="LastName" value="{{ old('LastName') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-group"><label for="">Common Name(Alias)</label>
                            <input type="text" name="alias" value="{{ old('alias') }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group"><label for="">Date of Birth</label>
                            <input type="date" name="DOB" value="{{ old('DOB') }}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group">
                            <label for=""> State of Origin</label>
                            <select style="backgorund-color:#cb0c9f !important;" id="state" name="state"
                                class="form-select cboState">
                                @foreach ($states as $state)
                                    <option value="{{ $state }}">{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="form-group"><label for=""> Local Government</label>
                            <select name="lga" id="lgas" class="form-select cboLga" value="{{ old('lga') }}">
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Bloodgroup</label>
                            <select name="bloodgroup" class="form-select">
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
                            <select name="genotype" class="form-select">
                                <option value="AA">AA</option>
                                <option value="AS">AS</option>
                                <option value="AC">AC</option>
                                <option value="SS">SS</option>
                                <option value="SC">SC</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 form-group">
                        <label for="">Street Address</label>
                        <textarea type="text" name="StreetAddress" value="{{ old('StreetAddress') }}"
                            class="form-control">
                                                                                                                                                                                                                                    </textarea>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <label for="">State(Residing)</label>
                        <select name="state" id="stateResiding" class="form-select cboState">
                            @foreach ($states as $state)
                                <option value="{{ $state }}">{{ $state }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <label for="">LGA(Residing)</label>
                        <select name="" id="lgasResiding" class="form-select cboLga">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Parent/guardian Name</label>
                            <input type="text" name="parentname" value="{{ old('parentname') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Parent Contact</label>
                            <input type="text" class="form-control" name="parentcontact"
                                value="{{ old('parentcontact') }}">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Parent's Occupation</label>
                            <input type="text" name="parentoccupation" value="{{ old('parentoccupation') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="">Physical Challenge(if any)</label>
                            <input type="text" name="PChallenge" value="{{ old('PChallenge') }}" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="" class="btn btn-info btn-lg">Goto O'Levels</button>
            </div>
            <div class="tab-pane fade" id="olevels" role="tabpanel" aria-labelledby="olevels-tab">
                <h3>Enter O'Levels</h3>
            </div>
    </div>
    </div>
    </form>
    </div>

@endsection
