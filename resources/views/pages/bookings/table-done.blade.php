@extends('layouts.master2')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Pinjaman Telah Disetujui</h4> 
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
                        <div class="alert alert-success alert-dismissable">{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <form method="GET" action="done">
                    <div class="form-row">
                      <div class="form-group col-xs-1">
                        <select class="form-control" name="monthnow" id="monthnow" required>
                          <?php foreach ($montharray as $key => $data) { ?>
                            <option value="{{ $key + 1 }}" 
                              <?php 
                                if ($monthnow == $key+1) {
                                  echo "selected";
                                }
                              ?>
                            >{{ $data }}</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-xs-1">
                        <select class="form-control" name="yearnow" id="yearnow" required>
                          <?php foreach ($yeararray as $key => $data) { ?>
                            <option value="{{ $data }}" 
                              <?php 
                                if ($yearnow == $data) {
                                  echo "selected";
                                }
                              ?>
                            >{{ $data }}</option>
                          <?php } ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="white-box">
                      <div class="row row-in">
                            <div class="col-lg-12 col-sm-6">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-success"><i class="ti-check"></i></span>
                                    </li>
                                    <li class="col-last"><h3 class="counter text-right m-t-15">{{ $countstatus }}</h3></li>
                                    <li class="col-middle">
                                        <h4>Pinjaman Disetujui</h4>
                                    </li>
                                </ul>
                          </div>
                        </div>   
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Pinjaman Telah Disetujui</h3>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Acara</th>
                                    <th class="col-lg-2">Deskripsi</th>
                                    <th>Nama Peminjam</th>
                                    <th>Subbidang Peminjam</th>
                                    <th>Ruang</th>
                                    <th>Jumlah Peserta / Snack</th>
                                    <th class="col-lg-1">Waktu</th>
                                    <th>File Surat</th>
                                    <th>Status Booking</th>
                                    <!-- <th>Tanggal Dibuat</th> -->
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($datas as $key => $data) { ?>
                                  <tr>
                                    <input class="form_book_done_id_booking" type="hidden" name="id_booking" value="{{ $data->id_booking }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->surat->surat_judul }}</td>
                                    <td>{{ $data->surat->surat_deskripsi }}</td>
                                    <td>{{ $data->nama_peminjam }}<hr>{{ $data->nip_peminjam }}</td>
                                    <td>{{ $data->subbidang->subbidang_name }}</td>
                                    <td>{{ $data->room->room_name }}</td>
                                    <td>{{ $data->booking_total_tamu }} / {{ $data->booking_total_snack }}</td>

                                    <?php 
                                      $booking_date2 = DateTime::createFromFormat('Y-m-d', $data->booking_date);
                                      $booking_date3 = $booking_date2->format('d-M-Y');
                                    ?>
                                    <td>{{ $booking_date3 }}<hr>

                                    <?php
                                      $time1 = explode(":", explode(" ", $data->time1->time_name)[1]);
                                      $time2 = explode(":", explode(" ", $data->time2->time_name)[1]);
                                    ?>
                                    {{ $time1[0] . ":" . $time1[1] }} - {{ $time2[0] . ":" . $time2[1] }}</td>

                                    <?php $file_name = explode("~", $data->surat->file_name); ?>
                                    <td>
                                      <button type="button" class="btn btn-info btn_file" data-toggle="modal" data-target="#modal-file" data-surat="{{ $data->surat->id_surat }}||{{ $file_name[2] }}"><i class="fa fa-download"></i></button>
                                    </td>
                                    <td bgcolor="#64de5d">
                                      {{ $data->status->status_name }}
                                    </td>
                                    <!-- <td>{{$data->created_at}}</td> -->
                                    <td>
                                      <button type="button" class="btn btn-primary btn_booking_done_edit_stat" data-toggle="modal" data-target="#modal-default" id="{{ $data->id_booking }}"><i class="fa fa-edit"></i></button>
                                      <hr>
                                      <button type="button" class="btn btn-info btn_change_room" data-toggle="modal" data-target="#modal-room" id="{{ $data->id_booking }}||{{ $data->booking_status }}||{{ $data->booking_date }}||{{ $data->time_start }}"><i class="fa fa-map-marker"></i></button>
                                    </td>
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

    <div class="modal fade" id="modal-file">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">File Surat</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive" id="file-isi">
            
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
        </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah status booking ruangan</h4>
          </div>
            <form method="POST" action="updateStatus" class="form-horizontal">
            @csrf
              <div class="modal-body">
                <input type="hidden" name="id_booking" id="modal_id_booking">

                <div class="form-group">
                  <label for="booking_status" class="col-lg-2 control-label"> Ubah Status </label>
                  <div class="col-lg-8">

                      <label for="booking_status" class="control-label">
                        <input type="checkbox" name="booking_status" id="optionsCheck2" value="2">
                        Batal
                      </label>

                  </div>
                </div>

                <div class="form-group">
                  <label for="keterangan_status" class="col-lg-2 control-label"> Keterangan </label>
                  <div class="col-lg-8">
                    <textarea class="form-control" id="modal_keterangan_status" name="keterangan_status" rows="3" autocomplete="off"></textarea>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success pull-right">Simpan</button>
                <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="modal-room">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Ubah Ruang</h4>
            </div>
            <form method="POST" action="updateRoom" class="form-horizontal">
              @csrf
                <div class="modal-body">
                  <input type="hidden" name="id_booking" class="modal_id_booking">
                  <input type="hidden" name="booking_status" class="modal_booking_status">
                  <input type="hidden" name="booking_date" class="modal_booking_date">
                  <input type="hidden" name="time_start" class="modal_booking_time_start">

                  <div id="ruang-tambahan">
                  <div class="form-group">
                    <label for="booking_room" class="col-lg-2 control-label">Ruang</label>
                    <div class="col-lg-8">
                      <select class="form-control booking_room" name="booking_room" required id="modal_change_room_name">
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
                      <?php $bidang_now=0; foreach ($roomlists as $data) { 
                        if ($data->room_owner != $bidang_now) {
                        $bidang_now = $data->room_owner; 
                      ?> 
                        <optgroup label="{{ $data->bidang_name }}">
                      <?php
                        }
                      ?>

                        <option value="{{ $data->id_room }}||{{ $data->room_owner }}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@endsection

@section('datatable')

<script>
  $(function () {
    $('.btn_file').click(function() {
      var surat = $(this).data("surat").split("||");
      $('#file-isi').append("<a href='{{ url('booking/download') }}/"+surat[0]+"'> "+surat[1]+" </a>")
    });

    $("#modal-file").on("hidden.bs.modal", function () {
      $("#file-isi").empty();
    });
    
    $("#example1").DataTable();
    $('.btn_booking_done_edit_stat').click(function() {      
      var data = (this.id).split('||');

      $('#modal_id_booking').val(data[0]);
      if (data[1] == '' || data[1] == null) {
        $('#modal_keterangan_status').val('-');
      } else {
        $('#modal_keterangan_status').val(data[1]);
      }
    });
    $('.btn_change_room').click(function() {
      var data = (this.id).split('||');
      $('.modal_id_booking').val(data[0]);
      $('.modal_booking_status').val(data[1]);
      $('.modal_booking_date').val(data[2]);
      $('.modal_booking_time_start').val(data[3]);
      $('.modal_booking_room').val(data[4]);
      $('.modal_booking_room_owner').val(data[5]);

      // var booking_room = data[4];
      // var booking_room_owner = data[5];

      // $("#modal_change_room_name option[value='"+booking_room+"||"+booking_room_owner+"']").remove();
    });
  });
</script>

@endsection
