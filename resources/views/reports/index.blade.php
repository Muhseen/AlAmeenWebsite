@extends('layouts.soft')
@section('content')
<style>
    .smallcard {
        background-color: gray !important;
    }
</style>
<div class="container">
    <div class="row mb-3">
        <div class="card-header">
            <h3> Student Reports</h3>

            <div class="row ">
                <div class="col-3 h-100 mr-3">
                    <div class="card">
                        <div class="card-text">Owing Students</div>
                        <div class="card-body text-center">
                            <h5 class="card-text">List of Students That Are owing fees group by classes</h5>
                        </div>
                        <div class="card-footer">
                            <a href="/reports/owing" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-3 h-100">
                    <form action="/reports/OwingParticularFee" method="GET"></form>
                    <div class="card">
                        <div class="card card-header">
                            <p>List of Students That Are owing a particular fee </p>
                        </div>
                        <div class="card card-body">
                            <div class="form-group"><label>Fee Type</label>
                                <select class="form-select" name="feeType" id="">
                                    <option value="fees">Fees</option>
                                    <option value="indexFees">Index Fees</option>
                                    <option value="boardFees">Board Fees</option>
                                </select>
                            </div>
                        </div>
                        <div class="card card-footer"><button type="submit" class="btn btn-primary">View
                                Debtors</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="card card-body">
            <h2>Receipt Reports</h2>

            <div class="row" height="100px">
                <div class=" mr-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 card h-100">
                    <h5 class="card-title text-center   ">
                        Receipts Issued Between(Date Range)
                    </h5>
                    <div class="card-body text-center">
                        <p>List of Students That Are owing fees group by classes</p>
                    </div>
                    <div class="card-footer">
                        <a href="/reports/owing" class="btn btn-primary">View All</a>
                    </div>

                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 card h-100">
                    <form action="/reports/OwingParticularFee" method="GET">
                        <div class=" card-body">
                            <h5 class="card-title">List of Students That Are owing a particular fee </h5>
                            <div class="form-group"><label>Fee Type</label>
                                <select class="form-select" name="feeType" id="">
                                    <option value="fees">Fees</option>
                                    <option value="indexFee">Index Fees</option>
                                    <option value="boardFee">Board Fees</option>
                                </select>
                            </div>
                        </div>
                        <div class="card card-footer">
                            <button type="submit" class="btn btn-primary">
                                View
                                Debtors
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Better Version
        </div>
        <div class="card-body">
            <div class="row">
                <div class="card col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
                <div class="card col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
                <div class="card col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
                <div class="card col-lg-3 col-md-4 col-sm-6 col-xs-12"></div>
            </div>
        </div>
        <div class="card-footer">
            Sample Footer
        </div>
    </div>
</div>
@endsection