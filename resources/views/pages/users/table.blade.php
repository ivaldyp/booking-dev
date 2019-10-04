@extends('layouts.master')

@section('content')

		<section class="content">
			<div class="row">
				<div class="col-xs-3">
					<a href="/registeruser"><button class="btn btn-success" style="margin-bottom: 10px">Tambah</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Daftar Pengguna</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Username</th>
										<th>Nama Lengkap</th>
										<th>Bidang</th>
										<th>Status</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($users as $key => $data) { ?>
									<tr>
										<td>{{ $key + 1 }}</td>
										<td>{{ $data->username }}</td>
										<td>{{ ucwords($data->name) }}</td>

										<?php if (is_null($data->bidang_name)) { ?>
											<td> - </td>
										<?php } else { ?>
											<td> {{ $data->bidang_name }} </td>
										<?php } ?>

										<td>{{ $data->userType_name }}</td>
										<td>
											<div class="btn-group">
												<button class="btn btn-warning btn_modal_update_user" data-toggle="modal" data-target="#modal-update" onclick="myFunction('{{$data->id_user}}', '{{$data->name}}', '{{$data->nrk}}', '{{$data->nip}}', '{{$data->username}}', '{{$data->email}}', '{{$data->id_userType}}', '{{$data->id_bidang}}')">
													<i class="fa fa-edit"></i>
												</button>
												<button class="btn btn-danger"  data-toggle="modal" data-target="#deleteUser{{$key}}">
													<i class="fa fa-trash-o"></i>
												</button>
											</div>

											<div id="deleteUser{{$key}}" class="modal fade" role="dialog">
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
																		Apa benar ingin menghapus data "{{$data->name}}" ?
																	</h4>
																</tbody>
															</table>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<a href="{{ url('users/delete') }}/{{ $data->id_user }}">
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
						<!-- /.box-body -->
					</div>

					<div id="modal-update" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<form method="POST" action="users/update" class="form-horizontal">
									@csrf
									<div class="modal-header">
										<h4 class="modal-title"><b>Ubah Data</b></h4>
									</div>
									<div class="modal-body">
										<input type="hidden" name="id_user" id="modal_update_id_user">

										<div class="form-group">
											<label for="modal_update_user_name" class="col-lg-3
											control-label"> Nama </label>
											<div class="col-lg-8">
												<input type="text" name="name" id="modal_update_user_name" class="form-control" autocomplete="off">
											</div>
										</div>

										<div class="form-group">
											<label for="modal_update_user_nrk" class="col-lg-3
											control-label"> NRK </label>
											<div class="col-lg-8">
												<input type="text" name="nrk" id="modal_update_user_nrk" class="form-control" autocomplete="off">
											</div>
										</div>

										<div class="form-group">
											<label for="modal_update_user_nip" class="col-lg-3
											control-label"> NIP </label>
											<div class="col-lg-8">
												<input type="text" name="nip" id="modal_update_user_nip" class="form-control" autocomplete="off">
											</div>
										</div>

										<div class="form-group">
											<label for="modal_update_user_username" class="col-lg-3
											control-label"> Username </label>
											<div class="col-lg-8">
												<input type="text" name="username" id="modal_update_user_username" class="form-control" autocomplete="off">
											</div>
										</div>

										<div class="form-group">
											<label for="modal_update_user_email" class="col-lg-3
											control-label"> Email </label>
											<div class="col-lg-8">
												<input type="text" name="email" id="modal_update_user_email" class="form-control" autocomplete="off">
											</div>
										</div>

										<div class="form-group">
                      <label for="modal_update_user_status" class="col-lg-3 control-label"> Tipe Pengguna </label>
                      <div class="col-lg-8">
                        <select class="form-control" name="user_status" id="modal_update_user_status">
                          <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Tipe Pengguna --</option>
                          <?php foreach ($user_types as $data) { ?>
                            <option value="{{ $data->id_userType }}">{{ $data->userType_name }}</option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="modal_update_user_bidang" class="col-lg-3 control-label"> Bidang </label>
                      <div class="col-lg-8">
                        <select class="form-control" name="user_bidang" id="modal_update_user_bidang">
                          <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Bidang --</option>
                          <option value="<?php echo NULL; ?>">Tidak Ada</option>
                          <?php foreach ($bidangs as $data) { ?>
                            <option value="{{ $data->id_bidang }}">{{ $data->bidang_name }}</option>
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
						</div>
					</div>

					<!-- /.box -->
				</div>
			</div>
		</section>

		<script type="text/javascript">
			function myFunction(id_user, name, nrk, nip, username, email, id_userType, id_bidang) {
				document.getElementById("modal_update_id_user").value = id_user;
				document.getElementById("modal_update_user_name").value = name;
				document.getElementById("modal_update_user_nrk").value = nrk;
				document.getElementById("modal_update_user_nip").value = nip;
				document.getElementById("modal_update_user_username").value = username;
				document.getElementById("modal_update_user_email").value = email;
				document.getElementById("modal_update_user_status").value = id_userType;
				document.getElementById("modal_update_user_bidang").value = id_bidang;
			}
		</script>

@endsection

@section('datatable')

<script>
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