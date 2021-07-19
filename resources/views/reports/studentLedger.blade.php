@extends('layouts.soft')
@section('content')
<script src="{{asset('/assets/js/reports.js')}}" type="text/javascript" defer></script>
<div class="container">
    <div class="table-container">
        {!!$table!!}
    </div>
</div>
@endsection