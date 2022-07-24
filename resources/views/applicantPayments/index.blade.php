@extends('layouts.soft')
@section('content')
<div class="container">
    @include('partials.errors')
    <script src="{{asset('/assets/js/studentPayments.js')}}" type="text/javascript" defer></script>
    <div class="card-header card">
        <form action="/applicantPayments" method="POST">
            <h3>Process Applicant Payment</h3>
            @csrf
            <div class="row">
                <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <label for="">Date</label>
                    <input type="date" required name="TxnDate" class="form-control">
                </div>
                <div class="form-group col-lg-3 col-md-4 col-sm-6 col-xs-12"><label for="">Receipt No</label>
                    <input type="text" class="form-control" required name="ReceiptNo">
                </div>
                <div class="form-group col-lg-2 col-md-4 col-sm-6 col-xs-12"><label for="">Application
                        Number</label><input type="text" id="regno" name="StudentNO" required class="form-control">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12"><label for="">Details</label><input
                        type="text" name="details" id="details" class="form-control" >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Payment Purpose</label>
                    <select name="code" id="" class="form-select">
                        <option value="form">Applicantion Form</option>
                        <option value="Acceptance">Acceptance</option>
                    </select>
                </div>
                <div class="form-group col-lg-3 col-md-4 col-xs-12">
                    <label for="">Amount</label>
                    <input type="text" name="Amount" class="form-control">
                </div>
                <div class="col-lg-3 col-md-4 col-xs-12 col-sm-6">
                    <label for="">Paid To</label>
                    <select name="Bank" id="cboBank" class="form-select">
                        @foreach ($bankAccounts as $ba)
                        <option value="{{$ba->bankname}}">{{$ba->bankname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 form-group"><label for="">Session</label><select name="session" id=""
                        class="form-select">
                        <option value="18/19">18/19</option>
                        <option value="19/20">19/20</option>
                        <option value="20/21" selected>20/21</option>
                        <option value="21/22">21/22</option>
                    </select>
                </div>
                <div class="col-lg-3 form-group">
                    <label for="">Semester</label>
                    <select name="" id="" class="form-select">
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                    </select>
                </div>
                <div class="col-lg-3 form-group">
                    <label for="">Teller No</label>
                    <input name="TellerNo" id="" class="form-control">

                </div>
                <div class="btn-group btn-group-sm col-lg-4 col-md-4">
                    <button class="btn btn-info">Process Payment</button>
                    <button class="btn btn-danger"> Cancel</button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
