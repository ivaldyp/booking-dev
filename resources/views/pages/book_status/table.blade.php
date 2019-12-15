@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Status Booking</h4> 
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
                        <!-- <h3 class="box-title">Status Booking</h3> -->
                        <div class="table-responsive">
                        	<table id="example1" class="table table-hover">
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
					</div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable')

<script>
  $(function () {
  	$("#btn-hide").remove();
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