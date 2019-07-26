@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
      	<div class="col-xs-3">
      		<button class="btn btn-success" style="margin-bottom: 10px">Tambah</button>
      	</div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Bidang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Nama Tipe Ruangan</th>
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
	                  <td>{{ $data->created_at }}</td>
	                  <td>{{ $data->updated_at }}</td>
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