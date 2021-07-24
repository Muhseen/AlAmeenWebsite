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
                            <a href="/reports/owing" class="btn btn-primary"> View All</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/owingParticularFee" method="GET">
                            <div class="card-body">
                                <h5 class="card-title">Students Owing a particular fee</h5>
                                <div class="form-group">
                                    <label for="">Fee Type</label>
                                    <select name="" id="" class="form-select">
                                        <option value="fees">Fees</option>
                                        <option value="indexFees">Index Fees</option>
                                        <option value="boardFees">Board Fees</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"> Get List</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a
                                natural lead-in
                                to
                                additional
                                content.</p>
                        </div>
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
                                <button type="submit" class="btn btn-primary">Process</button>
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
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search"
                                        aria-hidden="true">Searc h</i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <form action="/reports/receiptsByName" method="GET">
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
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search"
                                        aria-hidden="true">Searc h</i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection