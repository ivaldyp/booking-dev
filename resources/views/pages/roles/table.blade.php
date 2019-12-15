@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Hak Akses</h4> 
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
                <div class="col-sm-3">
                    <button data-toggle="modal" data-target="#modal-create" class="btn btn-info" style="margin-bottom: 10px">Tambah</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <!-- <h3 class="box-title">Status Booking</h3> -->
                        <div class="table-responsive">
                        	<table id="example1" class="table table-bordered table-hover">
							<thead>
								<tr>
								  <th>No</th>
								  <th>Jenis Pengguna</th>
								  <th>Kelola Pengguna</th>
								  <th>Kelola Ruang</th>
								  <th>Sewa Ruang</th>
								  <th>Setujui Ruangan</th>
								  <th>Beli Snack</th>
								  <th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($user_status as $key => $data) { ?>
								<tr>
								  <td>{{ $key + 1 }}</td>
								  <td>{{ $data->userType_name }}</td>

								  <?php if ($data->can_editUser == 1) { ?>
									<td> <i class="fa fa-check" style="color:green"></i> </td>
								  <?php } else { ?>
									<td> <i class="fa fa-close" style="color:red"></i> </td>
								  <?php } ?>

								  <?php if ($data->can_editRoom == 1) { ?>
									<td> <i class="fa fa-check" style="color:green"></i> </td>
								  <?php } else { ?>
									<td> <i class="fa fa-close" style="color:red"></i> </td>
								  <?php } ?>

								  <?php if ($data->can_bookRoom == 1) { ?>
									<td> <i class="fa fa-check" style="color:green"></i> </td>
								  <?php } else { ?>
									<td> <i class="fa fa-close" style="color:red"></i> </td>
								  <?php } ?>

								  <?php if ($data->can_approve == 1) { ?>
									<td> <i class="fa fa-check" style="color:green"></i> </td>
								  <?php } else { ?>
									<td> <i class="fa fa-close" style="color:red"></i> </td>
								  <?php } ?>

								  <?php if ($data->can_bookFood == 1) { ?>
									<td> <i class="fa fa-check" style="color:green"></i> </td>
								  <?php } else { ?>
									<td> <i class="fa fa-close" style="color:red"></i> </td>
								  <?php } ?>

								  <td>
									<div class="btn-group">
									  <button class="btn btn-warning btn_modal_update_userType" data-toggle="modal" data-target="#modal-update" onclick="myFunction('{{$data->id_userType}}', '{{$data->userType_name}}', '{{$data->can_editUser}}', '{{$data->can_editRoom}}', '{{$data->can_bookRoom}}', '{{$data->can_approve}}', '{{$data->can_bookFood}}')">
										<i class="fa fa-edit"></i>
									  </button>
									  <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTipeUser{{$key}}">
										<i class="fa fa-trash-o"></i>
									  </button>
									</div>

									<div id="deleteTipeUser{{$key}}" class="modal fade" role="dialog">
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
												  Apa benar ingin menghapus data "{{$data->userType_name}}" ?
												</h4>
											  </tbody>
											</table>
										  </div>
										  <div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											  <a href="{{ url('roles/delete') }}/{{ $data->id_userType }}">
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
							<form method="POST" action="roles/store" class="form-horizontal">
							@csrf
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title">Tipe Pengguna Baru</h4>
							  </div>
							  <div class="modal-body">
								<div class="form-group">
								  <label for="userType_name" class="col-sm-3
								  control-label"> Jenis Pengguna </label>
								  <div class="col-sm-8">
									<input type="text" name="userType_name" id="userType_name" class="form-control" autocomplete="off">
								  </div>
								</div>

								<div class="form-group">
								  <label for="can_editUser" class="col-sm-3 control-label"> Kelola Pengguna </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_editUser" id="can_editUser" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="can_editRoom" class="col-sm-3 control-label"> Kelola Ruang </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_editRoom" id="can_editRoom" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="can_bookRoom" class="col-sm-3 control-label"> Sewa Ruang </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_bookRoom" id="can_bookRoom" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="can_approve" class="col-sm-3 control-label"> Setujui Ruangan </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_approve" id="can_approve" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="can_bookFood" class="col-sm-3 control-label"> Beli Snack </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_bookFood" id="can_bookFood" style="width: 30px; height: 30px; top: 0px"></label>
									
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
							<form method="POST" action="roles/update" class="form-horizontal">
							  @csrf
							  <div class="modal-header">
								<h4 class="modal-title"><b>Ubah Data</b></h4>
							  </div>
							  <div class="modal-body">
								<input type="hidden" name="id_userType" id="modal_update_id_usertype">

								<div class="form-group">
								  <label for="modal_update_usertype_name" class="col-lg-3
								  control-label"> Jenis Pengguna </label>
								  <div class="col-lg-8">
									<input type="text" name="userType_name" id="modal_update_usertype_name" class="form-control" autocomplete="off">
								  </div>
								</div>

								<div class="form-group">
								  <label for="modal_update_usertype_can_edituser" class="col-sm-3 control-label"> Kelola Pengguna </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_editUser" id="modal_update_usertype_can_edituser" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="modal_update_usertype_can_editroom" class="col-sm-3 control-label"> Kelola Ruang </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_editRoom" id="modal_update_usertype_can_editroom" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="modal_update_usertype_can_bookroom" class="col-sm-3 control-label"> Sewa Ruang </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_bookRoom" id="modal_update_usertype_can_bookroom" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="modal_update_usertype_can_approve" class="col-sm-3 control-label"> Setujui Ruangan </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_approve" id="modal_update_usertype_can_approve" style="width: 30px; height: 30px; top: 0px"></label>
									
								  </div>
								</div>

								<div class="form-group">
								  <label for="modal_update_usertype_can_bookFood" class="col-sm-3 control-label"> Beli Snack </label>
									<div class="col-sm-1">
									  
										<label><input type="checkbox" name="can_bookFood" id="modal_update_usertype_can_bookfood" style="width: 30px; height: 30px; top: 0px"></label>
									
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
	function myFunction(id_userType, userType_name, can_editUser, can_editRoom, can_bookRoom, can_approve, can_bookFood) {
		document.getElementById("modal_update_id_usertype").value = id_userType;
		document.getElementById("modal_update_usertype_name").value = userType_name;

		if (can_editUser == 1) {
		  document.getElementById("modal_update_usertype_can_edituser").checked = true;
		}

		if (can_editRoom == 1) {
		  document.getElementById("modal_update_usertype_can_editroom").checked = true;
		}

		if (can_bookRoom == 1) {
		  document.getElementById("modal_update_usertype_can_bookroom").checked = true;
		}

		if (can_approve == 1) {
		  document.getElementById("modal_update_usertype_can_approve").checked = true;
		}

		if (can_bookFood == 1) {
		  document.getElementById("modal_update_usertype_can_bookfood").checked = true;
		} 
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

	$("#modal-update").on("hidden.bs.modal", function () {
	  $("#modal_update_usertype_can_edituser").prop("checked", false);
	  $("#modal_update_usertype_can_editroom").prop("checked", false);
	  $("#modal_update_usertype_can_bookroom").prop("checked", false);
	  $("#modal_update_usertype_can_approve").prop("checked", false);
	  $("#modal_update_usertype_can_bookfood").prop("checked", false);
	});
  });
</script>

@endsection