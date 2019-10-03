@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
        <div class="col-lg-12">
          @if(Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
          @endif
        </div>
      </div>
      <!-- <div class="row">
      	<div class="col-xs-3">
      		<button data-toggle="modal" data-target="#modal-create" class="btn btn-success" style="margin-bottom: 10px">Tambah</button>
      	</div>
      </div> -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Status</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Nama Status</th>
	                  <th>Created At</th>
	                  <th>Updated At</th>
	                  <!-- <th>Aksi</th> -->
	                </tr>
                </thead>
                <tbody>
                	<?php foreach($status as $key => $data) { ?>
	                <tr>
	                  <td>{{ $key + 1 }}</td>
	                  <td>{{ ucwords($data->status_name) }}</td>
	                  <td>{{ $data->created_at }}</td>
	                  <td>{{ $data->updated_at }}</td>
	                  <!-- <td>
	                  	<div class="btn-group">
	                  		<button class="btn btn-warning">
	                  			<i class="fa fa-edit"></i>
	                  		</button>
	                  		<button class="btn btn-danger">
	                  			<i class="fa fa-trash-o"></i>
	                  		</button>
	                  	</div>
	                  </td> -->
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