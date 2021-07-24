@extends('layouts.soft')
@section('content')\
<div class="container">
    @include('partials.errors')
    <form action="/accountCodes/{{$ac->id}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <h5><i>To Avoid conflicting code, the code will be automatically generated.</i></h5>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Account Type</label>
                    <select name="type" id="" class="form-select">
                        <option value="Inc" {{$ac->class =="Inc"?"selected":""}}>Revenue</option>
                        <option value="Exp" {{$ac->class =="Exp"?"selected":""}}>Expenditure</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-9 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" name="Description" value="{{$ac->Description}}" required class="form-control">
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-3 col-sm-6 col-xs-12"><button class="btn btn-info">Update Code</button></div>
            </div>
        </div>
    </form>
</div>

@endsection