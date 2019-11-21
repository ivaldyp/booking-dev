@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Rapat Internal</h4> 
                </div>
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
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white;">&times;</button>{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <!-- <h3 class="box-title">Rapat Internal</h3> -->
                        <div class="table-responsive">
                        	<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Acara</th>
										<th>Deskripsi</th>
										<!-- <th>Nama Peminjam</th> -->
										<!-- <th>Bidang Peminjam</th> -->
										<th>Ruang</th>
										<th class="col-sm-1">Waktu</th>
										<th class="col-sm-1">File Surat</th>
										<th class="col-sm-1">File Notulen</th>
										<th class="col-sm-1">File Daftar Hadir</th>
										<th class="col-sm-1">Foto Dokumentasi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($notulens as $key => $data) { ?>
									<tr>
										<input type="hidden" name="id_booking" id="form_notulen_id_booking" value="{{ $data->id_booking }}">
										<td>{{ $key + 1 }}</td>
										<td>{{ $data->surat_judul }}</td>
										<td>{{ $data->surat_deskripsi }}</td>
										<!-- <td>{{ $data->name }}</td> -->
										<!-- <td>{{ $data->bidang_name }}</td> -->
										<td>{{ $data->room_name }}</td>
										<td>{{ $data->booking_date }} <hr> {{ $data->time_start }} </td>
										<?php $file_name = explode("~", $data->file_name); ?>
										<td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>

										<?php 
											if (is_null($data->notulen_name)) {
												if (Auth::check()) { ?>
													<!-- <td><a href="{{ url('notulen/tambah') }}/{{ $data->id_surat }}"><button class="btn btn-success" style="margin-bottom: 10px">Tambah</button></a></td> -->
													<td><button data-toggle="modal" data-target="#notulen-create" class="btn btn-success" style="margin-bottom: 10px" onclick="myFunction('{{$data->id_surat}}')">Tambah</button></td>
													<?php
												} else {
													echo "<td> - </td>";
												}
											} else {
												$notulen_name = explode("~", $data->notulen_name); ?>
												<td>
													<a href="{{ url('notulen/download') }}/{{ $data->id_surat }}"> {{$notulen_name[2]}} </a>
													<?php if(Auth::check()) { ?>
														<hr>
														<button data-toggle="modal" data-target="#notulen-create" class="btn btn-warning" style="margin-bottom: 10px" onclick="myFunction('{{$data->id_surat}}')">Ubah File</button>
													<?php } ?>
												</td>
										<?php 
											}
										?>

										<?php 
											if (is_null($data->hadir_name)) {
												if (Auth::check()) { ?>
													<!-- <td><a href="{{ url('notulen/tambah') }}/{{ $data->id_surat }}"><button class="btn btn-success" style="margin-bottom: 10px">Tambah</button></a></td> -->
													<td><button data-toggle="modal" data-target="#hadir-create" class="btn btn-success" style="margin-bottom: 10px" onclick="myFunction('{{$data->id_surat}}')">Tambah</button></td>
													<?php
												} else {
													echo "<td> - </td>";
												}
											} else {
												$hadir_name = explode("~", $data->hadir_name); ?>
												<td>
													<a href="{{ url('notulen/downloadHadir') }}/{{ $data->id_surat }}"> {{$hadir_name[2]}} </a>
													<?php if(Auth::check()) { ?>
														<hr>
														<button data-toggle="modal" data-target="#hadir-create" class="btn btn-warning" style="margin-bottom: 10px" onclick="myFunction('{{$data->id_surat}}')">Ubah File</button>
													<?php } ?>
												</td>
										<?php 
											}
										?>

										<!-- <td></td> -->

										<?php 
											if (is_null($data->photo1_fullpath) && is_null($data->photo2_fullpath) && is_null($data->photo3_fullpath)) { ?>
												<td><button data-toggle="modal" data-target="#photo-create" class="btn btn-success" style="margin-bottom: 10px" onclick="myFunction('{{$data->id_surat}}')">Tambah</button></td>
											<?php } else { ?>
												<?php 
													$photo1 = explode("\\", $data->photo1_fullpath)[6];
													$photo2 = explode("\\", $data->photo2_fullpath)[6];
													$photo3 = explode("\\", $data->photo3_fullpath)[6];

													$loc1 = "images/" . $photo1;
													$loc2 = "images/" . $photo2;
													$loc3 = "images/" . $photo3;
												?>
												<td>
													<img width="200px" src="{{$loc1}}"><hr>
													<img width="200px" src="{{$loc2}}"><hr>
													<img width="200px" src="{{$loc3}}">
													
												</td>
											<?php } 
										?>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="modal fade" id="photo-create">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="POST" action="notulen/storePhoto" class="form-horizontal" enctype="multipart/form-data">
										@csrf
										<div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										    	<span aria-hidden="true">&times;</span></button>
										    <h4 class="modal-title">Upload Foto Dokumentasi</h4>
										</div>
										<div class="modal-body">
											<input type="hidden" id="modal_create_foto_surat" name="id_surat">

											<div class="form-group">
							                  	<label for="photo1_fullpath" class="col-sm-2 control-label"> Upload Foto 1 </label>
							                  	<div class="col-sm-8">
							                    	<input type="file" class="form-control" id="photo1_fullpath" name="photo1_fullpath">
							                  	</div>
							                </div>
							                <div class="form-group">
							                  	<label for="photo2_fullpath" class="col-sm-2 control-label"> Upload Foto 2 </label>
							                  	<div class="col-sm-8">
							                    	<input type="file" class="form-control" id="photo2_fullpath" name="photo2_fullpath">
							                  	</div>
							                </div>
							                <div class="form-group">
							                  	<label for="photo3_fullpath" class="col-sm-2 control-label"> Upload Foto 3 </label>
							                  	<div class="col-sm-8">
							                    	<input type="file" class="form-control" id="photo3_fullpath" name="photo3_fullpath">
							                  	</div>
							                </div>
										</div>
										<div class="modal-footer">
										    <button type="submit" class="btn btn-success pull-right">Simpan</button>
										    <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
			            </div>

						<div class="modal fade" id="notulen-create">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="POST" action="notulen/store" class="form-horizontal" enctype="multipart/form-data">
										@csrf
										<div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										    	<span aria-hidden="true">&times;</span></button>
										    <h4 class="modal-title">Upload File Notulen</h4>
										</div>
										<div class="modal-body">
											<input type="hidden" id="modal_create_notulen_surat" name="id_surat">

											<div class="form-group">
							                  	<label for="notulen_file" class="col-sm-2 control-label"> Upload Notulen </label>
							                  	<div class="col-sm-8">
							                    	<input type="file" class="form-control" id="notulen_file" name="notulen_file">
							                  	</div>
							                </div>
										</div>
										<div class="modal-footer">
										    <button type="submit" class="btn btn-success pull-right">Simpan</button>
										    <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
			            </div>

			            <div class="modal fade" id="hadir-create">
							<div class="modal-dialog">
								<div class="modal-content">
									<form method="POST" action="notulen/storeHadir" class="form-horizontal" enctype="multipart/form-data">
										@csrf
										<div class="modal-header">
										    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										    	<span aria-hidden="true">&times;</span></button>
										    <h4 class="modal-title">Upload File Daftar Hadir</h4>
										</div>
										<div class="modal-body">
											<input type="hidden" id="modal_create_hadir_surat" name="id_surat">

											<div class="form-group">
							                  	<label for="hadir_file" class="col-sm-2 control-label"> Upload Daftar Hadir </label>
							                  	<div class="col-sm-8">
							                    	<input type="file" class="form-control" id="hadir_file" name="hadir_file">
							                  	</div>
							                </div>
										</div>
										<div class="modal-footer">
										    <button type="submit" class="btn btn-success pull-right">Simpan</button>
										    <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	function myFunction(id_surat) {
		document.getElementById("modal_create_notulen_surat").value = id_surat;
		document.getElementById("modal_create_hadir_surat").value = id_surat;
		document.getElementById("modal_create_foto_surat").value = id_surat;
	}
</script>

@endsection

@section('datatable')

<script>
	$(function () {
		$("#example1").DataTable();
	});
</script>

@endsection
