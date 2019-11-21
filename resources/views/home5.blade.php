@extends('layouts.master')

@section('content')
		
		<section class="content">
			<div class="row">
				<div class="col-lg-12">
					@if(Session::has('message'))
						<div class="alert alert-success alert-dismissable">{{ Session::get('message') }}</div>
					@endif
				</div>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<table id="table" class="table col-xs-10" style="display: block; overflow: auto; white-space: nowrap;">
								<thead>
								<?php
									for ($i=0; $i <= count($times); $i++) { 
										if ($i == 0) {
											echo "<th class='col-xs-2'>Ruang</th>";
										} else {
											$timesplit = explode(":", explode(" ", $times[$i-1]->time_name)[1]);
											echo "<td>".$timesplit[0].":".$timesplit[1]."</td>";
										}
									}
								?>
								</thead>
								<tbody>
								<?php
									$bookingcount = count($bookings) - 1;
									$bidangnow = 0;
									if ($bookingcount >= 0) {
										$bookingnow = 0;
										for ($i=0; $i < count($rooms); $i++) {
											if ($bidangnow != $rooms[$i]->room_owner) {
												echo "<tr><td colspan='".count($times)."'>";
												echo "<b>".$bidangs[$bidangnow]->bidang_name."</b>";
												echo "</td></tr>";
												$bidangnow++;
												$i--;
											} else {
												echo "<tr>"; 
												for ($j=0; $j <= count($times); $j++) { 
													if ($j == 0) {
														echo "<td>".$rooms[$i]->room_name."</td>";
													} else {
														if($bookings[$bookingnow]->booking_room == $rooms[$i]->id_room && 
															$bookings[$bookingnow]->time_start == $times[$j-1]->id_time) {
															$colspan = $bookings[$bookingnow]->time_end - $bookings[$bookingnow]->time_start + 1;
															echo "<td bgcolor='red' colspan='$colspan'>".$i.$j."</td>";
															if ($bookingnow != count($bookings) - 1) {
																$bookingnow++;
															} 
														} else {
															echo "<td></td>";
														}
													}
												}
												echo "</tr>";
											}
										}
									} else {
										$rowspan = count($times) + 1;
										echo "<td rowspan='".$rowspan."' style='text-align: center;'>No data available</td>";
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-xs-3">
		      		<a href="{{ url('/') }}"><button class="btn btn-success" style="margin-bottom: 10px">Agenda View</button></a>
		      	</div>
			</div> -->
			<!-- <div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- BEGIN MODAL -->
			<div class="modal fade" id="my-event">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><strong>Detail</strong></h4>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
							<!-- <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
							<button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Add Category -->
			<div class="modal fade" id="add-new-event">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><strong>Add</strong> a category</h4>
						</div>
						<div class="modal-body">
							<form role="form">
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Category Name</label>
										<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
									</div>
									<div class="col-md-6">
										<label class="control-label">Choose Category Color</label>
										<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
												<option value="success">Success</option>
												<option value="danger">Danger</option>
												<option value="info">Info</option>
												<option value="primary">Primary</option>
												<option value="warning">Warning</option>
												<option value="inverse">Inverse</option>
										</select>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
							<button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- <script src="{{ URL::asset('plugins2/bower_components/calendar/dist/cal-init.js') }}"></script> -->
		<!-- /.content -->

@endsection 

@section('cal-init')
	<script type="text/javascript">
		$(function () {

		});
	</script>
	<!-- <script src="{{ URL::asset('plugins2/bower_components/calendar/dist/cal-init.js') }}"></script> -->
@endsection
