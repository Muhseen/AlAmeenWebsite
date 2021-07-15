@extends('layouts.soft')
@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="card card-header">
            <h2> Student Reports</h2>

            <div class="row ">
                <div class="col-3 h-100">
                    <div class="card">
                        <div class="card card-header">Owing Students</div>
                        <div class="card card-body text-center">
                            <p>List of Students That Are owing fees group by classes</p>
                        </div>
                        <div class="card card-footer">
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
                <div class="col-3 h-100">
                    <div class="card">
                        <div class="card card-header">
                            Receipts Issued Between(Date Range)
                        </div>
                        <div class="card card-body text-center">
                            <p>List of Students That Are owing fees group by classes</p>
                        </div>
                        <div class="card card-footer">
                            <a href="/reports/owing" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-3 h-100">
                    <form action="/reports/OwingParticularFee" method="GET">
                        <div class="card">
                            <div class="card card-body">
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
</div>
</div> @endsection