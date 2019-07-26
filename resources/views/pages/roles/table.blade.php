@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hak Akses Pengguna</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
	                </tr>
                </thead>
                <tbody>
                	<?php foreach($user_status as $key => $data) { ?>
	                <tr>
	                  <td>{{ $key + 1 }}</td>
	                  <td>{{ $data->userType_name }}</td>

	                  <?php if ($data->can_bookRoom == 1) { ?>
	                  	<td> <i class="fa fa-check" style="color:green"></i> </td>
	                  <?php } else { ?>
	                  	<td> <i class="fa fa-check" style="color:red"></i> </td>
	                  <?php } ?>

	                  <?php if ($data->can_editUser == 1) { ?>
	                  	<td> <i class="fa fa-check" style="color:green"></i> </td>
	                  <?php } else { ?>
	                  	<td> <i class="fa fa-check" style="color:red"></i> </td>
	                  <?php } ?>

	                  <?php if ($data->can_editRoom == 1) { ?>
	                  	<td> <i class="fa fa-check" style="color:green"></i> </td>
	                  <?php } else { ?>
	                  	<td> <i class="fa fa-check" style="color:red"></i> </td>
	                  <?php } ?>

	                  <?php if ($data->can_approve == 1) { ?>
	                  	<td> <i class="fa fa-check" style="color:green"></i> </td>
	                  <?php } else { ?>
	                  	<td> <i class="fa fa-check" style="color:red"></i> </td>
	                  <?php } ?>

	                  <?php if ($data->can_bookFood == 1) { ?>
	                  	<td> <i class="fa fa-check" style="color:green"></i> </td>
	                  <?php } else { ?>
	                  	<td> <i class="fa fa-check" style="color:red"></i> </td>
	                  <?php } ?>
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