@extends('layouts.soft')
@section('content')
    <div class="container">
       <form action="/studentScholarship" method="POST">
        @csrf
        <div class="row">
            <h3>
                Set Scholarship for Student 
            </h3>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group"><label for="">Registration Number</label><input type="text" class="form-control"></div>
            </div>
            <div class="col">
                <div class="form- group"><label for="amount">Student Details</label>
                    <input  disabled type="text" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group"><label for=""> Scholarship Type</label>
                    <select name="type" class="form-select">
                    <option value="partial">Partial Scholarship</option>
                    <option value="Full">Full Scholarship</option>
                </select></div>
            </div>
                        
            <div class="col">
                <div class="form-group"><label for="">Amount</label><input type="number" step="0.01" class="form-control"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-info "> 
                    Set Scholarship
                </button>
            </div>
        </div>
    </form> 
</div>
@endsection