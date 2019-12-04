@extends('layouts.master2')

@section('css')
<style type="text/css">
    
</style>
@endsection

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Pinjaman <br> {{Session::get('user_data')->bidang_name}}</h4> 
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
                        <div class="alert alert-success alert-dismissable">{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                         <div class="row row-in">
                              <div class="col-lg-4 col-sm-6 row-in-br">
                                <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-danger"><i class="ti-close"></i></span>
                                        </li>
                                        <li class="col-last"><h3 class="counter text-right m-t-15">{{ $countstatus[0] }}</h3></li>
                                        <li class="col-middle">
                                            <h4>Pinjaman Dibatalkan</h4>
                                        </li>
                                        
                                </ul>
                              </div>
                              <div class="col-lg-4 col-sm-6 row-in-br  b-r-none">
                                <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-warning"><i class="ti-help"></i></span>
                                        </li>
                                        <li class="col-last"><h3 class="counter text-right m-t-15">{{ $countstatus[1] }}</h3></li>
                                        <li class="col-middle">
                                            <h4>Pinjaman Belum Disetujui</h4>
                                        </li>
                                        
                                </ul>
                              </div>
                              <div class="col-lg-4 col-sm-6 row-in-br">
                                <ul class="col-in">
                                        <li>
                                            <span class="circle circle-md bg-success"><i class="ti-check"></i></span>
                                        </li>
                                        <li class="col-last"><h3 class="counter text-right m-t-15">{{ $countstatus[2] }}</h3></li>
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
                        <h3 class="box-title">Pinjaman Disetujui</h3>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Acara</th>
                                <th class="col-lg-3">Deskripsi</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Waktu</th>
                                <th>File Surat</th>
                                <th>Status Booking</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($bookingdone as $key => $data) { ?>
                              <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->surat->surat_judul }}</td>
                                <td>{{ $data->surat->surat_deskripsi }}</td>
                                <td>{{ $data->room->room_name }}</td>
                                <td>{{ $data->booking_total_tamu }}</td>

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
                                <td>
                                    <button type="button" class="btn btn-info btn_booking_not_edit_stat" data-toggle="modal" data-target="#modal-default" id="{{ $data->id_booking }}||{{ $data->keterangan_status }}||{{ $data->booking_date }}||{{ $data->time1->id_time }}||{{ $data->time2->id_time }}||{{ $data->room->booking_room }}||{{ $data->status->status_id }}"><i class="fa fa-edit"></i></button>
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Pinjaman Belum Disetujui</h3>
                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Acara</th>
                                <th class="col-lg-3">Deskripsi</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Waktu</th>
                                <th>File Surat</th>
                                <th>Status Booking</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($bookingnot as $key => $data) { ?>
                              <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->surat->surat_judul }}</td>
                                <td>{{ $data->surat->surat_deskripsi }}</td>
                                <td>{{ $data->room->room_name }}</td>
                                <td>{{ $data->booking_total_tamu }}</td>
                                
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
                                <td bgcolor='yellow'>
                                  {{ $data->status->status_name }}
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Pinjaman Dibatalkan</h3>
                        <div class="table-responsive">
                            <table id="example3" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Acara</th>
                                <th class="col-lg-3">Deskripsi</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Waktu</th>
                                <th>File Surat</th>
                                <th>Status Booking</th>
                                <th>Keterangan</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach($bookingcancel as $key => $data) { ?>
                              <tr>
                                <input type="hidden" name="id_booking" id="form_book_not_id_booking" value="{{ $data->id_booking }}">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->surat->surat_judul }}</td>
                                <td>{{ $data->surat->surat_deskripsi }}</td>
                                <td>{{ $data->room->room_name }}</td>
                                <td>{{ $data->booking_total_tamu }}</td>
                                
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
                                <td bgcolor="#ff3333" style="color: white;"><b>
                                  {{ $data->status->status_name }}
                                </b></td>
                                <td>Buat ulang pinjaman
                                  <?php if ($data->keterangan_status != 'NULL' && $data->keterangan_status != '') {
                                    echo "<br><hr>";
                                    echo $data->keterangan_status;
                                  } ?>
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

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ubah status booking ruangan</h4>
          </div>
            <form method="POST" action="updateStatus" class="form-horizontal">
            @csrf
              <div class="modal-body">
                <input type="hidden" name="id_booking" class="modal_id_booking">
                <input type="hidden" name="booking_date" class="modal_booking_date">
                <input type="hidden" name="time_start" class="modal_time_start">
                <input type="hidden" name="time_end" class="modal_time_end">
                <input type="hidden" name="booking_room" class="modal_booking_room">
                <input type="hidden" name="status_id" class="modal_status_id">

                <div class='form-group'>
                  <label for='booking_status' class='col-lg-2 control-label'> Ubah Status </label>
                  <div class='col-lg-8'>
                    <div class='checkbox'>
                      <label for='booking_status' class='control-label'>
                        <input type='checkbox' name='booking_status' id='optionsCheck2' value='2'>Batal
                      </label>
                    </div>
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
    $("#example2").DataTable();
    $("#example3").DataTable();

    $('.btn_booking_not_edit_stat').click(function() {
      var data = (this.id).split('||');
      $('.modal_id_booking').val(data[0]);
      if (data[1] == '' || data[1] == null) {
        $('.modal_keterangan_status').val('-');
      } else {
        $('.modal_keterangan_status').val(data[1]);
      }
      $('.modal_booking_date').val(data[2]);
      $('.modal_time_start').val(data[3]);
      $('.modal_time_end').val(data[4]);
      $('.modal_booking_room').val(data[5]);
    });
  });
</script>

@endsection

@section('stylishtabs')
<script type="text/javascript">
    (function () {
            [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
            new CBPFWTabs(el);
        });
    })();
</script>
@endsection