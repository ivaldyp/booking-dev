@extends('layouts.master')

@section('content')


	<!-- <div class=<section class="content">
	<div class="row">
		<div class="col-lg-12">
			@if(Session::has('message'))
				<div class="alert alert-danger">{{ Session::get('message') }}</div>
			@endif
		</div>
	</div>"row">
		<div class="col-xs-3">
			<button class="btn btn-success" style="margin-bottom: 10px">Tambah</button>
		</div>
	</div> -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Rapat Internal</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example1" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Acara</th>
								<th>Deskripsi</th>
								<th>Nama Peminjam</th>
								<th>Bidang Peminjam</th>
								<th>Ruang</th>
								<th class="col-lg-1">Waktu</th>
								<th>File Surat</th>
								<th>File Notulen</th>
								<th>Foto Daftar Hadir</th>
								<th>Foto Dokumentasi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($notulens as $key => $data) { ?>
							<tr>
								<input type="hidden" name="id_booking" id="form_notulen_id_booking" value="{{ $data->id_booking }}">
								<td>{{ $key + 1 }}</td>
								<td>{{ $data->surat_judul }}</td>
								<td>{{ $data->surat_deskripsi }}</td>
								<td>{{ $data->name }}</td>
								<td>{{ $data->bidang_name }}</td>
								<td>{{ $data->room_name }}</td>
								<td>{{ $data->booking_date }} <hr> {{ $data->time_start }} </td>
								<?php $file_name = explode("~", $data->file_name); ?>
								<td><a href="{{ url('booking/downloadSurat') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>

								<?php 
									if (is_null($data->notulen_name)) {
										if (Auth::check()) { ?>
											<td><a href="{{ url('notulen/tambah') }}/{{ $data->id_surat }}"><button class="btn btn-success" style="margin-bottom: 10px">Tambah</button></a></td>;
											<?php
										} else {
											echo "<td> - </td>";
										}
									} else {
										$notulen_name = explode("~", $data->notulen_name); ?>
										echo "<td><a href="{{ url('notulen/downloadNotulen') }}/{{ $data->id_surat }}"> {{$notulen_name[2]}} </a></td>";
								<?php 
									}
								?>
								
								<?php $file_name = explode("~", $data->file_name); ?>
								<td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>

								<?php $file_name = explode("~", $data->file_name); ?>
								<td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->

				
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
	});
</script>

@endsection
