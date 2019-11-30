@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row bg-title">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h4 class="page-title">Kalender</h4> </div>
				<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
					<ol class="breadcrumb">
						<li><a href="#">Dashboard</a></li>
						<li class="active">Starter Page</li>
					</ol>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="row">
				<div class="col-lg-12">
					@if(Session::has('message'))
						<div class="alert alert-success alert-dismissable">{{ Session::get('message') }}</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="white-box">
						<div class="btn-group m-b-20" align="center">
							<!-- <?php $new = explode("-", $datenow); ?> -->
							<!-- <form style="display: inline;" method="GET" action="home6">
								<input type="hidden" name="newdate" value="{{ $new[2] - 1 }}">
								<button onclick="this.form.submit()" data-toggle="tooltip" data-original-title="Kurangi 1 Hari" type="button" class="btn btn-default btn-outline waves-effect"><i class="mdi mdi-arrow-left-bold"></i></button>
							</form> -->
							<form style="display: inline;" method="GET" action="home" id="form6">
								<!-- <input type="hidden" name="newdate" value="{{ date('d') }}"> -->
								<input autocomplete="off" type="text" id="datepicker-autoclose" name="newdate" style="width: 0px">
								<button id="newdate_button" data-toggle="tooltip" data-original-title="Pilih Tanggal" type="button" class="btn btn-default btn-outline waves-effect"><i class="mdi mdi-calendar"></i></button>
							</form>
							<!-- <form style="display: inline;" method="GET" action="home6">
								<input type="hidden" name="newdate" value="{{ $new[2] + 1 }}">
								<button onclick="this.form.submit()" data-toggle="tooltip" data-original-title="Tambah 1 Hari" type="button" class="btn btn-default btn-outline waves-effect"><i class="mdi mdi-arrow-right-bold"></i></button>
							</form> -->
						</div>
						<h3 class="box-title">Rapat Hari Ini<span><h3>{{ $datenow }}</h3></span></h3> 
						<div class="table-responsive">
							<table class="table table-hover table-bordered">
								<thead>
								<?php
									for ($i=0; $i <= count($times); $i++) { 
										if ($i == 0) {
											echo "<th>Ruang</th>";
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
												echo "<tr><td colspan='".(count($times)+1)."'>";
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
															$colspan = $bookings[$bookingnow]->time_end - $bookings[$bookingnow]->time_start;
															$time1 = explode(":", explode(" ", $bookings[$bookingnow]->time1->time_name)[1]);
															$time2 = explode(":", explode(" ", $bookings[$bookingnow]->time2->time_name)[1]);
															echo "<td bgcolor='blue' colspan='$colspan' style='padding: 10px; background: #667db6; background: -webkit-linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); background: linear-gradient(to top, #667db6, #0082c8, #0082c8, #667db6); color:white;'>".
																$bookings[$bookingnow]->surat->surat_judul."<br>".
																$time1[0] . ":" . $time1[1] ." - ". $time2[0] . ":" . $time2[1]
																."</td>";
															$j+=($colspan-1);
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
										$colspan = count($times) + 1;
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

	
@endsection 		

@section('datepicker')
<script type="text/javascript">
	// Date Picker
	jQuery('.mydatepicker, #datepicker').datepicker();
	jQuery('#datepicker-autoclose').datepicker({
		autoclose: true,
		todayHighlight: true,
	});
	$('#newdate_button').click(function() {
	    $('#datepicker-autoclose').datepicker('show');
	});
	$('#datepicker-autoclose').change(function(){
		$('#form6').submit();
	});
	jQuery('#date-range').datepicker({
		toggleActive: true
	});
	jQuery('#datepicker-inline').datepicker({
		todayHighlight: true
	});
	// Daterange picker
	$('.input-daterange-datepicker').daterangepicker({
		buttonClasses: ['btn', 'btn-sm']
		, applyClass: 'btn-danger'
		, cancelClass: 'btn-inverse'
	});
	$('.input-daterange-timepicker').daterangepicker({
		timePicker: true
		, format: 'MM/DD/YYYY h:mm A'
		, timePickerIncrement: 30
		, timePicker12Hour: true
		, timePickerSeconds: false
		, buttonClasses: ['btn', 'btn-sm']
		, applyClass: 'btn-danger'
		, cancelClass: 'btn-inverse'
	});
	$('.input-limit-datepicker').daterangepicker({
		format: 'MM/DD/YYYY'
		, minDate: '06/01/2015'
		, maxDate: '06/30/2015'
		, buttonClasses: ['btn', 'btn-sm']
		, applyClass: 'btn-danger'
		, cancelClass: 'btn-inverse'
		, dateLimit: {
			days: 6
		}
	});
</script>
@endsection	

