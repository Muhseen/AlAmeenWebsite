@extends('layouts.soft')
@section('content')
	<script src="{{ asset('/assets/js/reports.js') }}" type="text/javascript" defer></script>
	<script src="{{ asset('/assets/js/sortable.js') }}" type="text/javascript" defer></script>
	<div class="container">
		<div class="row">
			<button class="btn btn-success float-right col-2" onclick="exportTable()">Export to CSV</button>
		</div>
		<div class="table-container">
			<div class="container">
				{!! $table !!}
			</div>
		</div>
	@endsection
