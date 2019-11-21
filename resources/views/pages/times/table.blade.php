@extends('layouts.master2')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Waktu</h4> 
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
            <div class="row" id="btn-hide">
                <div class="col-sm-3">
                    <button data-toggle="modal" data-target="#modal-create" class="btn btn-info" style="margin-bottom: 10px">Tambah</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <!-- <h3 class="box-title">Waktu</h3> -->
                        <div class="table-responsive">
                            <table id="example1" class="table table-hover">
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
                                <?php
                                  $time1 = explode(":", explode(" ", $data->time_name)[1]);
                                ?>
                                  <td>{{ $time1[0] . ":" . $time1[1] }}</td>
                                  <td>{{ $data->created_at }}</td>
                                  <td>{{ $data->updated_at }}</td>
                                  <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning btn_modal_update_time" data-toggle="modal" data-target="#modal-update" id="{{$data->id_time}}||{{$data->time_name}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTime{{$key}}">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>

                                  <div id="deleteTime{{$key}}" class="modal fade" role="dialog">
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
                                                Apa benar ingin menghapus data {{$data->time_name}} ?
                                              </h4>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <a href="{{ url('time/delete') }}/{{ $data->id_time }}">
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
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <form method="POST" action="time/store" class="form-horizontal">
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
                                    <div class="col-lg-8 ">
                                        <!--  -->
                                      <input type="time" name="time_name" id="time_name" class="form-control" autocomplete="off">
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
                          <div class="modal-dialog modal-sm">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <form method="POST" action="time/update" class="form-horizontal">
                                @csrf
                                <div class="modal-header">
                                  <h4 class="modal-title"><b>Ubah Data</b></h4>
                                </div>
                                <div class="modal-body">
                                  <input type="hidden" name="id_time" id="modal_update_id_time">

                                  <div id="modal_update_time"></div>

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
  $(function () {
    $("#example1").DataTable({
      "iDisplayLength": 25
    });


    $('.btn_modal_update_time').click(function() {
      var data = (this.id).split('||');
      var time_full = data[1].split(" ");
      var time = time_full[1].split(":");
      
      $("#modal_update_id_time").val(data[0]);
      $("#modal_update_time").append("<div class='form-group'><label for='time_name' class='col-lg-2 control-label'> Waktu </label><div class='col-lg-8'><input type='time' name='time_name' id='time_name' class='form-control' value='"+time[0] +":"+ time[1]+"'></div> </div>");
    });

    $("#modal-update").on("hidden.bs.modal", function () {
      $("#modal_update_time").empty();
    });
  });
</script>

@endsection