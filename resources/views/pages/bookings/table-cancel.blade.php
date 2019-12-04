@extends('layouts.master2')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Pinjaman Dibatalkan</h4> 
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
                        <div class="alert alert-danger alert-dismissable">{{ Session::get('message') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="white-box">
                      <div class="row row-in">
                            <div class="col-lg-12 col-sm-6">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-danger"><i class="ti-close"></i></span>
                                    </li>
                                    <li class="col-last"><h3 class="counter text-right m-t-15">{{ $countstatus }}</h3></li>
                                    <li class="col-middle">
                                        <h4>Pinjaman Dibatalkan</h4>
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
                        <h3 class="box-title">Pinjaman Dibatalkan</h3>
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Acara</th>
                                    <th class="col-lg-3">Deskripsi</th>
                                    <th>Nama Peminjam</th>
                                    <th>Subbidang Peminjam</th>
                                    <th>Ruang</th>
                                    <th>Jumlah Peserta</th>
                                    <th class="col-lg-1">Waktu</th>
                                    <th>File Surat</th>
                                    <th>Status Booking</th>
                                    <th>Keterangan</th>
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
                                    <td>Buat ulang pinjaman <br><hr> 
                                      {{ $data->keterangan_status }}
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
    $('.btn_booking_done_edit_stat').click(function() {
      var data = (this.id).split('||');
      $('#modal_id_booking').val(data[0]);
      if (data[1] == '' || data[1] == null) {
        $('#modal_keterangan_status').val('-');
      } else {
        $('#modal_keterangan_status').val(data[1]);
      }
    });
  });
</script>

@endsection
