@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Tipe Ruang</h4> 
                </div>
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
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: white;">&times;</button>{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row" id="btn-hide">
                <div class="col-sm-3">
                    <button data-toggle="modal" data-target="#modal-create" class="btn btn-info" style="margin-bottom: 10px">Tambah</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <!-- <h3 class="box-title">Tipe Ruang</h3> -->
                        <div class="table-responsive">
                        	<table id="example1" class="table table-hover">
							<thead>
								<tr>
								  <th>No</th>
								  <th>Nama Tipe Ruangan</th>
								<th>Keterangan</th>
								  <th>Created At</th>
								  <th>Updated At</th>
								  <th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($room_types as $key => $data) { ?>
								<tr>
								  <td>{{ $key + 1 }}</td>
								  <td>{{ ucwords($data->roomType_name) }}</td>
								<td>
								  <?php 
									if (is_null($data->roomType_ket)) {
									  echo "-";
									} else {
									  echo $data->roomType_ket;
									}
								  ?>
								</td>
								  <td>{{ $data->created_at }}</td>
								  <td>{{ $data->updated_at }}</td>
								  <td>
									<div class="btn-group"> 
										<button class="btn btn-warning btn_modal_update_roomtype" data-toggle="modal" data-target="#modal-update" onclick="myFunction('{{$data->id_roomType}}', '{{$data->roomType_name}}', '{{$data->roomType_ket}}')">
											<i class="fa fa-edit"></i>
										</button>
										<button class="btn btn-danger" data-toggle="modal" data-target="#deleteRoomType{{$key}}">
											<i class="fa fa-trash-o"></i>
										</button>
									</div>

								  <div id="deleteRoomType{{$key}}" class="modal fade" role="dialog">
									<div class="modal-dialog">
									  <!-- Modal content-->
									  <div class="modal-content">
										<div class="modal-header">
										  <h4 class="modal-title"><b>Warning</b></h4>
										</div>
										<div class="modal-body">
										  <table>
											<tbody>
											  <h4>
												Apa benar ingin menghapus data "{{$data->roomType_name}}" ?
											  </h4>
											</tbody>
										  </table>
										</div>
										<div class="modal-footer">
										  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<a href="{{ url('tipe_ruang/delete') }}/{{ $data->id_roomType }}">
												<button type="button" class="btn btn-danger">Delete</button>
											</a>
										</div>
									  </div>
									</div>
								  </div>

								  </td>
								</tr>
								<?php } ?>
							</tbody>
						  </table>
						</div>
						<div class="modal fade" id="modal-create">
							<div class="modal-dialog ">
							  <div class="modal-content">
								<form method="POST" action="tipe_ruang/store" class="form-horizontal">
								@csrf
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Tipe Ruang Baru</h4>
								  </div>
								  <div class="modal-body">
									<div class="form-group">
									  <label for="roomType_name" class="col-lg-2
									  control-label"> Nama </label>
									  <div class="col-lg-8">
										<input type="text" name="roomType_name" id="roomType_name" class="form-control" autocomplete="off">
									  </div>
									</div>
									<div class="form-group">
									  <label for="roomType_ket" class="col-lg-2
									  control-label"> Keterangan </label>
									  <div class="col-lg-8">
										<input type="text" name="roomType_ket" id="roomType_ket" class="form-control" autocomplete="off">
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

						  <div id="modal-update" class="modal fade" role="dialog">
							<div class="modal-dialog">
							  <!-- Modal content-->
							  <div class="modal-content">
								<form method="POST" action="tipe_ruang/update" class="form-horizontal">
								  @csrf
								  <div class="modal-header">
									<h4 class="modal-title"><b>Ubah Data</b></h4>
								  </div>
								  <div class="modal-body">
									<input type="hidden" name="id_roomType" id="modal_update_id_roomtype">

									<div class='form-group'>
										<label for='roomType_name' class='col-lg-2 control-label'> Nama </label>
										<div class='col-lg-8'>
											<input type='text' name='roomType_name' id='modal_update_roomtype_name' class='form-control'>
										</div> 
									</div>
																			
									<div class='form-group'>
										<label for='roomType_ket' class='col-lg-2 control-label'> Keterangan </label>
										<div class='col-lg-8'>
											<input type='text' name='roomType_ket' id='modal_update_roomtype_ket' class='form-control'>
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

@endsection

@section('datatable')

<script>
	function myFunction(id_roomtype, roomType_name, roomtype_ket) {
        document.getElementById("modal_update_id_roomtype").value = id_roomtype;
        document.getElementById("modal_update_roomtype_name").value = roomType_name;
        document.getElementById("modal_update_roomtype_ket").value = roomtype_ket;
    }
	$(function () {
		$("#example1").DataTable();
		// $('#example2').DataTable({
		//   "paging": true,
		//   "lengthChange": true,
		//   "searching": false,
		//   "ordering": true,
		//   "info": false,
		//   "autoWidth": false
		// });
	});
</script>

@endsection