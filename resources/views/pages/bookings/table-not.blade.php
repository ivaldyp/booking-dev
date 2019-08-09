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
										<th>NIP</th>
										<th>Bidang Peminjam</th>
										<th>Ruang</th>
										<th>Jumlah Peserta</th>
										<th>Tanggal</th>
										<th>Waktu</th>
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
										<td>{{ $data->surat_judul }}</td>
										<td>{{ $data->surat_deskripsi }}</td>
										<td>{{ $data->nama_peminjam }}</td> 
										<td>{{ $data->nip_peminjam }}</td>
										<td>{{ $data->bidang_name }}</td>
										<td>{{ $data->room_name }}</td>
										<td>{{ $data->booking_total_tamu }}</td>
										<td>{{ $data->booking_date2 }}</td>
										<td>{{ $data->time_start }} - {{ $data->time_end }}</td>
										<?php $file_name = explode("~", $data->file_name); ?>
										<td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>
										<td bgcolor='yellow'>
											{{ $data->status_name }}
										</td>
										<td>
											<?php if (is_null($data->keterangan_status) || $data->keterangan_status == '') {
												echo "-";
											} else {
												echo $data->keterangan_status;
											}?>
										</td>
										<td><button type="button" class="btn btn-success btn_booking_not_edit_stat" data-toggle="modal" data-target="#modal-default" id="{{ $data->id_booking }}||{{ $data->keterangan_status }}"><i class="fa fa-edit"></i></button></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->

						<div class="modal fade" id="modal-default">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Ubah status booking ruangan</h4>
									</div>
										<form method="POST" action="updateStatus" class="form-horizontal">
										@csrf
											<div class="modal-body">
												<input type="hidden" name="id_booking" id="modal_id_booking">

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
		$("#example1").DataTable();
		$('.btn_booking_not_edit_stat').click(function() {
			console.log(this.id);
			var data = (this.id).split('||');
			$('#modal_id_booking').val(data[0]);
			if (data[1] == '' || data[1] == null) {
				$('#modal_keterangan_status').val('-');
			} else {
				$('#modal_keterangan_status').val(data[1]);
			}
		});
	});
</script>

@endsection
