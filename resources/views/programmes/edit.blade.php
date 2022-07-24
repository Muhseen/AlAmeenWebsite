@extends('layouts.soft')
@section('content')
	<form method="POST" action="/programmes/{{ $prog->id }}">
		@method('PATCH')
		@csrf
		<div class="container">
			<div class="row">
				<h3>Edit Programme Details</h3>
			</div>
			<div class="row">
				<div class="col-lg-4 colmd-6 col-sm-12">
					<label for="">
						Faculty</label><input name="faculty" value="{{ $prog->faculty }}" type="text" class="form-control">
				</div>
				<div class="col-lg-2 colmd-6 col-sm-12">
					<label for="">Course</label>
					<input type="text" name="course" value="{{ $prog->course }}" class="form-control">
				</div>
				<div class="col-lg-3 colmd-6 col-sm-12">
					<label for="">Start Level</label>
					<select name="startLevel" id="" class="form-select">
						<option value="100">100</option>
					</select>
				</div>
				<div class="col-lg-3 colmd-6 col-sm-12">
					<label for="">Finish Level</label>
					<select name="finishLevel" id="" class="form-select">
						<option value="100" {{ $prog->finishLevel == 100 ? 'selected' : '' }}>100</option>
						<option value="200" {{ $prog->finishLevel == 200 ? 'selected' : '' }}>200</option>
						<option value="300" {{ $prog->finishLevel == 300 ? 'selected' : '' }}>300</option>
						<option value="400" {{ $prog->finishLevel == 400 ? 'selected' : '' }}>400</option>
						<option value="500" {{ $prog->finishLevel == 500 ? 'selected' : '' }}>500</option>
					</select>
				</div>
			</div>
			<div class="row my-3">
				<button class="ml-2 btn btn-success col-3" type="submit">
					Update Programme Details
				</button>
			</div>
		</div>
	</form>
@endsection
