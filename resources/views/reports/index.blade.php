@extends('layouts.soft')
@section('content')
<div class="container">
    <div class="row">
        <div class="card card-header">
            <h2> Student Reports</h2>

            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card card-header">Owing Students</div>
                        <div class="card card-body">
                            <p>List of Students That Are owing fees group by classes</p>
                        </div>
                        <div class="card card-footer"><a href="/reports/owing" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection