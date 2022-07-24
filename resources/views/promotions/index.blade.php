@extends('layouts.soft')
@section('content')
	<form action="/processPromotions" method="POST">
		<div class="container">
			@include('partials.errors')
			@csrf
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<label for="">Year to append to graduands(eg Grad-2020)</label>
					<select name="year" id="year" class="form-select">
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
					</select>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12 mt-4">
					<button class="btn btn-success ">
						Process Promotions
					</button>
				</div>
			</div>
		</div>
	</form>
@endsection
