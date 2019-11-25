@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Starter Page</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-sm-12">
					<form method="GET" action="home3">
						<div class="form-row">
							<div class="form-group col-lg-4 col-xs-12">
								<select class="form-control" name="id_bidang" id="id_bidang" required onchange="this.form.submit()">
									<?php foreach ($bidangs as $data) { ?>
										<option value="{{ $data->id_bidang }}" 
										  	<?php 
												if ($id_bidang == $data->id_bidang) {
													echo "selected";
												}
										  	?>
										>{{ $data->bidang_name }}</option>
									<?php } ?>
								</select>
							</div>
		              	</div>
					</form>
				</div>
			</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <!-- <h3 class="box-title">Rapat Hari Ini</h3>  -->
                        <div class="table-responsive">
                        	<table class="table table-hover table-bordered" id="example1">
								<thead>
								<?php
									for ($i=0; $i <= count($rooms); $i++) { 
										if ($i == 0) {
											echo "<th class='col-xs-1'>Waktu</th>";
										} else {
											echo "<th>".$rooms[$i-1]->room_name."</th>";
										}
									}
								?>
								</thead>
								<tbody>
								<?php
									$bookingcount = count($bookings) - 1;
									if ($bookingcount >= 0) {
										$bookingnow = 0;
										for ($i=0; $i < count($times); $i++) {
											echo "<tr>"; 
											for ($j=0; $j <= count($rooms); $j++) { 
												if ($j == 0) {
													$timesplit = explode(":", explode(" ", $times[$i]->time_name)[1]);
													echo "<td>".$timesplit[0].":".$timesplit[1]."</td>";
												} else {
													if($bookings[$bookingnow]->booking_room == $rooms[$j-1]->id_room && 
														$bookings[$bookingnow]->time_start == $times[$i]->id_time) {
														$rowspan = $bookings[$bookingnow]->time_end - $bookings[$bookingnow]->time_start;
														$time1 = explode(":", explode(" ", $bookings[$bookingnow]->time1->time_name)[1]);
														$time2 = explode(":", explode(" ", $bookings[$bookingnow]->time2->time_name)[1]);
														echo "<td bgcolor='blue' rowspan='$rowspan' style='padding: 10px; background: #667db6; background: -webkit-linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); background: linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); color:white;'>".
															$bookings[$bookingnow]->surat->surat_judul."<br>".
                    										$time1[0] . ":" . $time1[1] ." - ". $time2[0] . ":" . $time2[1]
															."</td>";
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
									} else {
										$colspan = count($rooms) + 1;
										echo "<td colspan='".$colspan."' style='text-align: center;'>No data available</td>";
									}
								?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
    </div>


		<section class="content">
			<div class="row">
				<div class="col-lg-12">
					@if(Session::has('message'))
						<div class="alert alert-success">{{ Session::get('message') }}</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<form method="GET" action="home3">
						<div class="form-row">
							<div class="form-group col-lg-4 col-xs-12">
								<select class="form-control" name="id_bidang" id="id_bidang" required onchange="this.form.submit()">
									<?php foreach ($bidangs as $data) { ?>
										<option value="{{ $data->id_bidang }}" 
										  	<?php 
												if ($id_bidang == $data->id_bidang) {
													echo "selected";
												}
										  	?>
										>{{ $data->bidang_name }}</option>
									<?php } ?>
								</select>
							</div>
		              	</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<table id="table" class="table col-xs-10">
								<thead>
								<?php
									for ($i=0; $i <= count($rooms); $i++) { 
										if ($i == 0) {
											echo "<th class='col-xs-1'>Waktu</th>";
										} else {
											echo "<th>".$rooms[$i-1]->room_name."</th>";
										}
									}
								?>
								</thead>
								<tbody>
								<?php
									$bookingcount = count($bookings) - 1;
									if ($bookingcount >= 0) {
										$bookingnow = 0;
										for ($i=0; $i < count($times); $i++) {
											echo "<tr>"; 
											for ($j=0; $j <= count($rooms); $j++) { 
												if ($j == 0) {
													$timesplit = explode(":", explode(" ", $times[$i]->time_name)[1]);
													echo "<td>".$timesplit[0].":".$timesplit[1]."</td>";
												} else {
													if($bookings[$bookingnow]->booking_room == $rooms[$j-1]->id_room && 
														$bookings[$bookingnow]->time_start == $times[$i]->id_time) {
														$rowspan = $bookings[$bookingnow]->time_end - $bookings[$bookingnow]->time_start + 1;
														echo "<td bgcolor='blue' rowspan='$rowspan' style='padding: 10px; background: #667db6; background: -webkit-linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); background: linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); 
															'></td>";
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
									} else {
										$colspan = count($rooms) + 1;
										echo "<td colspan='".$colspan."' style='text-align: center;'>No data available</td>";
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
							<h4 class="modal-title" ><strong>Detail</strong></h4>
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
			$('#example1').DataTable();
		});
	</script>
	<!-- <script src="{{ URL::asset('plugins2/bower_components/calendar/dist/cal-init.js') }}"></script> -->
@endsection
