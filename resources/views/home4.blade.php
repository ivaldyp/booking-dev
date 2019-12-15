@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Starter Page</h4> </div>
                <!-- <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">Starter Page</li>
                    </ol>
                </div> -->
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-sm-12">
					<form method="GET" action="home4">
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
                        	<table class="table table-hover table-bordered">
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
									if ($bookingcount >= 0) {
										$bookingnow = 0;
										for ($i=0; $i < count($rooms); $i++) {
											echo "<tr>"; 
											for ($j=0; $j <= count($times); $j++) { 
												if ($j == 0) {
													echo "<td><b>".$rooms[$i]->room_name."</b></td>";
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
