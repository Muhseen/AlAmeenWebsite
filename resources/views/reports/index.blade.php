@extends('layouts.soft')
@section('content')
<style>
    .card {
        border: darkslategrey 0.1mm solid !important;
    }
</style>
<div class="container">
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title ml-5 my-2">Student reports</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Owing Students</h5>
                            <p class="card-text">List of Students that are owing any fee(grouped by their classes)</p>
                        </div>
                        <div class="card-footer">
                            <a href="/reports/owing" class="btn btn-info"> View All</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/OwingParticularFee" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Students Owing a particular fee</h5>
                                <div class="form-group">
                                    <label for="">Fee Type</label>
                                    <select name="type" id="" class="form-select">
                                        <option value="fees">Fees</option>
                                        <option value="indexFee">Index Fees</option>
                                        <option value="boardFee">Board Fees</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"> Get List</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title ml-5 my-2">Receipt reports</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsByDateRange" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Receipts Issued Beteen Date Range</h5>
                                <p class="card-text">Receipts Between Start Date and End Date</p>
                                <div class="row">
                                    <div class="form-group"><label for="">Start Date</label><input type="date"
                                            name="startDate" id="" class="form-control"></div>
                                    <div class="form-group"><label for="">End Date</label><input type="date"
                                            name="endDate" id="" class="form-control"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsByName" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Search for Receipts Containing a name</h5>
                                <div class="form-group">

                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"> <i class="fa fa-search"
                                        aria-hidden="true">Searc h</i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsByClass" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Receipts by Faculty, Course, Level</h5>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Faculty</label>
                                        <select name="faculty" id="" class="form-select">
                                            @foreach ($faculties as $faculty)
                                            <option value="{{$faculty->faculty}}">{{$faculty->faculty}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Faculty</label>
                                        <select name="course" id="cboCourse" class="form-select">
                                            @foreach ($faculties as $faculty)

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="">Faculty</label>
                                        <select name="level" id="cboLevel" class="form-select">
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info"> <i class="fa fa-search"
                                        aria-hidden="true">Searc h</i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsByAccountCode" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Receipts for An Account Code(Particular reason)</h5>
                                <div class="row">
                                    <div class="form-group"><label for="">Account Code(Payment Reason)</label>
                                        <select name="code" id="" class="form-select">
                                            @foreach ($accountCodes as $ac)
                                            <option value="{{$ac->Code}}">{{$ac->Description}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsPaidIntoAccount" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Receipts Paid into Account</h5>
                                <p class="card-text">Receipts paid into a particular account</p>
                                <div class="row">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <select name="paidTo" id="cboBank" class="form-select">
                                            @foreach ($bankAccounts as $ba)
                                            <option value="{{$ba->bankname}}">{{$ba->bankname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="card-title ml-5 my-2">Payment Reports</h3>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/paymentsByDateRange" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Payments made Beteen Date Range</h5>
                                <p class="card-text">Payments made Between Start Date and End Date</p>
                                <div class="row">
                                    <div class="form-group"><label for="">Start Date</label><input type="date"
                                            name="startDate" id="" class="form-control"></div>
                                    <div class="form-group"><label for="">End Date</label><input type="date"
                                            name="endDate" id="" class="form-control"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Process</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection