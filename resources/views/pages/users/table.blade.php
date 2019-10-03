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
	                  		<button class="btn btn-warning">
	                  			<i class="fa fa-edit"></i>
	                  		</button>
	                  		<button class="btn btn-danger">
	                  			<i class="fa fa-trash-o"></i>
	                  		</button>
	                  	</div>
	                  </td>
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