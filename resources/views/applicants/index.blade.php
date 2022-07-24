@extends('layouts.soft')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <a href="{{ route('Applicants.create') }}">
                            <div class="card h-100">
                        <div class="h6 card-title card-header">
                            Apply Now
                                </div>
                        <div class="card-body" height=500>
                            <div class="card-image col-">
                                <img src="{{ asset('assets/img/student.png') }}" alt="student Icon"
                                    class="card-image h-25 w-100">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info w-100">
                                Add Applicant
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <div class="card h-100">
                    <div class="h6 card-title card-header">
                        Edit Application Detail
                    </div>
                    <div class="card-body" height=500>
                        <div class="card-image col-">
                            <img src="{{ asset('assets/img/student.png') }}" alt="student Icon"
                                class="card-image h-50 w-100">
                        </div>
                    </div>
                    <div class="card-footer">
                        <form action="/studentEdit" method="GET">
                            <div class="form-group"><label for=""></label>
                                <input placeholder="Enter Applicnation no here.. " type="text" name="regno" required
                                    class="form-control">
                            </div>
                            <button class="btn btn-info w-100" type="submit">
                                Edit Details
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-3">
                <div class="card h-100">
                    <a href="/applicantPayments">
                        <div class="card-title h6 card-header">
                            Make Applicant Payments
                        </div>
                        <div class="card-body" height=500>
                            <div class="card-image col-">
                                <img src="{{ asset('assets/img/finances.png') }}" alt="student Icon"
                                    class="card-image h-50 w-100">
                            </div>
                        </div>
                        <div class="card-footer mt-8">
                            <button class="btn btn-info w-100">
                                Make Payment
                            </button>
                        </div>
                </div>
                </a>
            </div>
        </div>


    </div>
@endsection
