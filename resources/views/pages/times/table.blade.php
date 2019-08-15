@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
      	<div class="col-xs-3">
      		<button class="btn btn-success" style="margin-bottom: 10px" data-toggle="modal" data-target="#modal-create">Tambah</button>
      	</div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Waktu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Waktu</th>
	                  <th>Created At</th>
	                  <th>Updated At</th>
	                  <th>Aksi</th>
	                </tr>
                </thead>
                <tbody>
                	<?php foreach($times as $key => $data) { ?>
	                <tr>
	                  <td>{{ $key + 1 }}</td>
	                  <td>{{ $data->time_name }}</td>
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

            <div class="modal fade" id="modal-create">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <form method="POST" action="createTimes" class="form-horizontal">
                  @csrf
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Waktu Baru</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="time_name" class="col-lg-2
                        control-label"> Waktu </label>
                        <div class="col-lg-8">
                          <input type="time" name="time_name" id="time_name" class="form-control">
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
          <!-- /.box -->
        </div>
      </div>
    </section>

@endsection

@section('datatable')

<script>
  $(function () {
    $("#example1").DataTable({
      "iDisplayLength": 25
    });
  });
</script>

@endsection