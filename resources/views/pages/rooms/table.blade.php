@extends('layouts.master2')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Ruang</h4> 
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
                        <!-- <h3 class="box-title">Ruang</h3> -->
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Nama Ruang</th>
                                  <th>Pemilik</th>
                                  <th>Jenis Ruangan</th>
                                  <th>Lantai</th>
                                <th>Kapasitas Ruang</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $bidangnow = 0; foreach($rooms as $key => $data) { 
                                if ($bidangnow != $data->room_owner) {
                                  $bidangnow = $data->room_owner;
                                  echo "<tr>";
                                  echo "<td colspan=7><b>".$data->bidang->bidang_name."</b></td>";
                                  echo "</tr>";
                                }
                              ?>
                                <tr>
                                  <td>{{ $key + 1 }}</td>
                                  <td>{{ ucwords($data->room_name) }}</td>
                                  <td>{{ $data->bidang_name }}</td>
                                  <td>{{ $data->roomType_name }}</td>
                                <td>{{ $data->room_floor }}</td>
                                <td>{{ $data->room_capacity }}</td>
                                  <td>
                                    <div class="btn-group">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modal-update" onclick="myFunction('{{$data->id_room}}', '{{$data->room_name}}', '{{$data->bidang->id_bidang}}', '{{$data->roomtype->id_roomType}}', '{{$data->room_floor}}', '{{$data->room_capacity}}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteRoom{{$key}}">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </div>

                                  <div id="deleteRoom{{$key}}" class="modal fade" role="dialog">
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
                                                Apa benar ingin menghapus data "{{ ucwords($data->room_name) }}" ?
                                              </h4>
                                            </tbody>
                                          </table>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <a href="{{ url('ruang/delete') }}/{{ $data->id_room }}">
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
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <form method="POST" action="ruang/store" class="form-horizontal">
                            @csrf
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ruang Baru</h4>
                              </div>
                              <div class="modal-body">
                                
                                <input type="hidden" name="id_room" value="<?php echo md5(uniqid()); ?>">

                                <div class="form-group">
                                  <label for="room_name" class="col-lg-2
                                  control-label"> Nama </label>
                                  <div class="col-lg-8">
                                    <input type="text" name="room_name" id="room_name" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="room_owner" class="col-lg-2 control-label"> Pemilik Ruangan </label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="room_owner" id="room_owner">
                                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Bidang --</option>
                                      <?php $id=0; foreach ($bidangs as $data) { 
                                        if ($data->id_bidang != $id) {
                                          $id = $data->id_bidang;
                                          echo "<optgroup label='$data->bidang_name'>";
                                        }
                                      ?>
                                        <option value="{{ $data->id_bidang }}||{{ $data->id_subbidang }}">{{ $data->subbidang_name }}</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="room_type" class="col-lg-2 control-label"> Jenis Ruangan </label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="room_type" id="room_type">
                                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Tipe Ruang --</option>
                                      <?php foreach ($room_types as $data) { ?>
                                        <option value="{{ $data->id_roomType }}">{{ $data->roomType_name }}</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="room_floor" class="col-lg-2
                                  control-label"> Lokasi Lantai </label>
                                  <div class="col-lg-4">
                                    <input type="text" name="room_floor" id="room_floor" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="room_capacity" class="col-lg-2
                                  control-label"> Kapasitas Ruang </label>
                                  <div class="col-lg-4">
                                    <input type="text" name="room_capacity" id="room_capacity" class="form-control" autocomplete="off">
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

                      <div class="modal fade" id="modal-update">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <form method="POST" action="ruang/update" class="form-horizontal">
                            @csrf
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ruang Baru</h4>
                              </div>
                              <div class="modal-body">
                                
                                <input type="hidden" name="id_room" id="modal_update_id_room">

                                <div class="form-group">
                                  <label for="modal_update_room_name" class="col-lg-2
                                  control-label"> Nama </label>
                                  <div class="col-lg-8">
                                    <input type="text" name="room_name" id="modal_update_room_name" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="modal_update_room_owner" class="col-lg-2 control-label"> Pemilik Ruangan </label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="room_owner" id="modal_update_room_owner">
                                      <?php $bidangnow = 0; foreach ($bidangs as $data) { 
                                        if ($data->id_bidang != $id) {
                                          $id = $data->id_bidang; ?>
                                          <optgroup label="{{$data->bidang_name}}">
                                      <?php
                                        }
                                      ?>
                                        <option value="{{ $data->id_bidang }}||{{ $data->id_subbidang }}">{{ $data->subbidang_name }}</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="modal_update_room_type" class="col-lg-2 control-label"> Jenis Ruangan </label>
                                  <div class="col-lg-8">
                                    <select class="form-control" name="room_type" id="modal_update_room_type">
                                      <?php foreach ($room_types as $data) { ?>
                                        <option value="{{ $data->id_roomType }}">{{ $data->roomType_name }}</option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="modal_update_room_floor" class="col-lg-2
                                  control-label"> Lokasi Lantai </label>
                                  <div class="col-lg-4">
                                    <input type="text" name="room_floor" id="modal_update_room_floor" class="form-control" autocomplete="off">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="modal_update_room_capacity" class="col-lg-2
                                  control-label"> Kapasitas Ruang </label>
                                  <div class="col-lg-4">
                                    <input type="text" name="room_capacity" id="modal_update_room_capacity" class="form-control" autocomplete="off">
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

    <script type="text/javascript">
      function myFunction(id_room, room_name, id_bidang, id_roomType, room_floor, room_capacity) {
        document.getElementById("modal_update_id_room").value = id_room;
        document.getElementById("modal_update_room_name").value = room_name;
        document.getElementById("modal_update_room_owner").value = id_bidang;
        document.getElementById("modal_update_room_type").value = id_roomType;
        document.getElementById("modal_update_room_floor").value = room_floor;
        document.getElementById("modal_update_room_capacity").value = room_capacity;
      }
    </script>

@endsection

@section('datatable')

<script>
  $(function () {
    // $("#example1").DataTable();
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