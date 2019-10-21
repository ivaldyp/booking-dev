@extends('layouts.master')

@section('content')

<section class="content">
	<div class="row">
		<div class="col-lg-12">
			@if(Session::has('message'))
				<div class="alert alert-danger">{{ Session::get('message') }}</div>
			@endif
		</div>
	</div>
	<!-- <div class="row">
		<div class="col-xs-3">
			<button class="btn btn-success" style="margin-bottom: 10px">Tambah</button>
		</div>
	</div> -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Booking Belum Disetujui</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Acara</th>
								<th class="col-lg-3">Deskripsi</th>
								<th>Nama Peminjam</th>
								<th>Bidang Peminjam</th>
								<th>Ruang</th>
								<th>Jumlah Peserta</th>
								<th class="col-lg-1">Waktu</th>
								<th>File Surat</th>
								<th>Status Booking</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($rooms as $key => $data) { ?>
							<tr>
								<input type="hidden" name="id_booking" id="form_book_not_id_booking" value="{{ $data->id_booking }}">
								<td>{{ $key + 1 }}</td>
								<td>{{ $data->surat->surat_judul }}</td>
								<td>{{ $data->surat->surat_deskripsi }}</td>
								<td>{{ $data->nama_peminjam }}<hr>{{ $data->nip_peminjam }}</td>
								<td>{{ $data->bidang->bidang_name }}</td>
								<td>{{ $data->room->room_name }}</td>
								<td>{{ $data->booking_total_tamu }}</td>

								<?php 
									$booking_date2 = DateTime::createFromFormat('Y-m-d', $data->booking_date);
									$booking_date3 = $booking_date2->format('d-M-Y');
			                    ?>
			                    <td>{{ $booking_date3 }}<hr>

								<?php
									$time1 = explode(":", explode(" ", $data->time1->time_name)[1]);
									$time2 = explode(":", explode(" ", $data->time2->time_name)[1]);
			                    ?>
			                    {{ $time1[0] . ":" . $time1[1] }} - {{ $time2[0] . ":" . $time2[1] }}</td>

								<?php $file_name = explode("~", $data->surat->file_name); ?>
								<td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
								<td bgcolor='yellow'>
									{{ $data->status->status_name }}
								</td>
								<td>
									<?php if (is_null($data->keterangan_status) || $data->keterangan_status == '') {
										echo "-";
									} else {
										echo $data->keterangan_status;
									}?>
								</td>
								<td><button type="button" class="btn btn-success btn_booking_not_edit_stat" data-toggle="modal" data-target="#modal-default" id="{{ $data->id_booking }}||{{ $data->keterangan_status }}||{{ $data->booking_date }}||{{ $data->time1->id_time }}||{{ $data->time2->id_time }}||{{ $data->booking_room }}"><i class="fa fa-edit"></i></button></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->

				<div class="modal fade" id="modal-default">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Ubah status booking ruangan</h4>
							</div>
								<form method="POST" action="updateStatus" class="form-horizontal">
								@csrf
									<div class="modal-body">
										<input type="text" name="id_booking" id="modal_id_booking">
										<input type="text" name="booking_date" id="modal_booking_date">
										<input type="text" name="time_start" id="modal_time_start">
										<input type="text" name="time_end" id="modal_time_end">
										<input type="text" name="booking_room" id="modal_booking_room">

										<div class="form-group">
											<label for="booking_status" class="col-lg-2 control-label"> Ubah Status </label>
											<div class="col-lg-8">
												<div class="radio">
													<label>
														<input type="radio" name="booking_status" id="optionsRadios3" value="3" checked>
														OK
													</label>
												</div>
												<div class="radio">
													<label>
														<input type="radio" name="booking_status" id="optionsRadios2" value="2">
														Batal
													</label>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="keterangan_status" class="col-lg-2 control-label"> Keterangan </label>
											<div class="col-lg-8">
												<textarea class="form-control" id="modal_keterangan_status" name="keterangan_status" rows="3" autocomplete="off"></textarea>
											</div>
										</div>

										<div class="form-group">
											<label for="booking_room_change" class="col-lg-2 control-label"> Ubah Ruang? </label>
											<div class="col-lg-1">
				                            	<div class="checkbox">
													<label><input type="checkbox" name="checkchangeroom" id="checkchangeroom" style="width: 30px; height: 30px; top: 0px"></label>
				                            	</div>
				                          	</div>
											<div class="col-lg-7">
							                    <select class="form-control" name="booking_room_change" id="booking_room_change" disabled="">
							                      	<option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
							                      	<?php foreach ($roomlists as $data) { ?>
							                        	<option value="{{ $data->id_room }}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option>
							                      	<?php } ?>
							                    </select>
						                  	</div>
					                  	</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-success pull-right">Simpan</button>
										<button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>
					<!-- /.modal -->

			</div>
			<!-- /.box -->
		</div>
	</div>
</section>

@endsection

@section('datatable')

<script>
	$(function () {
		$("#checkchangeroom").on("change", function(event) {
			if($(this).is(":checked")) {
				$('#booking_room_change').prop("disabled", false);      
			} else {
				$('#booking_room_change').prop("disabled", true);      
			}
		});
		$("#example1").DataTable();
		$('.btn_booking_not_edit_stat').click(function() {
			var data = (this.id).split('||');
			$('#modal_id_booking').val(data[0]);
			if (data[1] == '' || data[1] == null) {
				$('#modal_keterangan_status').val('-');
			} else {
				$('#modal_keterangan_status').val(data[1]);
			}
			$('#modal_booking_date').val(data[2]);
			$('#modal_time_start').val(data[3]);
			$('#modal_time_end').val(data[4]);
			$('#modal_booking_room').val(data[5]);
		});
	});
</script>

@endsection

@section('inlineedit')

<script>
$(function(){
	var booking_room;
	$('.status').click(function(){
		booking_room = $(this).attr("roomid");
		$(this).editable({
	        value: booking_room,   
	        pk: 1, 
	        source: [
				{value: '908c8316d17662a84bb99cfeb9098c76', text: 'Ruang Rapat Simaster'},
				{value: 'fdc50bb09e12dc0b6219405948406059', text: 'Ruang Rapat Sierra'}
			],
			url: '/'
	    });
	});
    
});
</script>

@endsection