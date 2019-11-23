@extends('layouts.master2')

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
  });
</script>

@endsection
