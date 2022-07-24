@extends('layouts.soft')
@section('content')
	<div class="container card">
		<div class="row">
			<h3>Programmes</h3>
		</div>
		<div class="row">
			<table class="table table-striped table-bordered">
				<tr>
					<th>Faculty</th>
					<th>Course</th>
					<th>Start Level</th>
					<th>End Level</th>
					<th>Edit</th>
				</tr>
				<tbody>
					@foreach ($progs as $p)
						<tr>
							<td>{{ $p->faculty }}</td>
							<td>{{ $p->course }}</td>
							<td>{{ $p->startLevel }}</td>
							<td>{{ $p->finishLevel }}</td>
							<td><a href="/programmes/{{ $p->id }}/edit" class="btn btn-info">Edit Prgramme</a></td>
						</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
@endsection
