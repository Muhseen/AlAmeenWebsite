@extends('layouts.soft')

@section('content')
	<script src="../assets/js/dashboard.js" defer></script>

	<div class="container">
		<div class="row justify-content-center">
			<div class="row  row-cols-3 row-cols-md-3 g-4">
				<div class="col-lg-4 col-md-4 col-sm-12">
					<a href="/reports/receiptsByDateRange?dashboard=true&type=day">
						<div class="card">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-capitalize font-weight-bold">
												Today's Collections
											</p>
											<h5 class="font-weight-bolder mb-0">
												{!! $today !!}
											</h5>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
											<i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<a href="/reports/receiptsByDateRange?dashboard=true&type=week">
						<div class="card">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-capitalize ">
												The Week's Colections
											</p>
											<h5 class="font-weight-bolder mb-0">
												{!! $tomorrow !!}
											</h5>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
											<i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>

						</div>
					</a>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12">
					<a href="/reports/receiptsByDateRange?dashboard=true&type=month">
						<div class="card">
							<div class="card-body p-3">
								<div class="row">
									<div class="col-8">
										<div class="numbers">
											<p class="text-sm mb-0 text-capitalize font-weight-bold">
												Month's Collections
											</p>
											<h5 class="font-weight-bolder mb-0">
												{!! $thisMonth !!}
												<span
													class="{{ $percentage > 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">-{{ $percentage }}%</span>
											</h5>
										</div>
									</div>
									<div class="col-4 text-end">
										<div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
											<i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</a>

				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-7 col-sm-12 col-xs-12 col-md-12">
					<div class="card z-index-2">
						<div class="card-header pb-0">
							<h6>Collection Overview</h6>
							<p class="text-sm">
								<i class="fa fa-arrow-up text-success"></i>
								<span class="font-weight-bold">4% more</span>
								in 2022
							</p>
						</div>
						<div class="card-body p-3">
							<div class="chart">
								<canvas id="chart-line" class="chart-canvas">

								</canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5  col-sm-12 col-xs-12 col-md-12">
					<div class="card text-center h-100 p-4">
						<h3 class=" mt-4 card-text text-center text-decoration-underline">Students</h3>

						<table class="table-responsive table-bordered table-striped table-striped">
							<tbody>
								<tr>
									<th><strong>Category</strong></th>
									<th><strong>Student Count</strong></th>
								</tr>
								<tr class="text-left">
									<th>Total Number of Students : </th>
									<th>{{ $studentCount }}</th>
								</tr>
								<tr>
									<th class="text-left"> Active Students :
									</th>
									<th> {{ $activeCount }}
									</th>
								</tr>
								<tr>
									<th class="text-left"> Graduated Students :
									</th>
									<th> {{ $graduatedCount }}
									</th>
								</tr>
								<tr>
									<th class="text-left"> Number of Students Owing: </th>
									<th>{{ $owingCount }}</th>
								</tr>
								<tr>
									<th class="text-left">Number of Affiliate Students: </th>
									<th>{{ $affiliateCount }}</th>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/plugins/chartjs.min.js"></script>
@endsection
