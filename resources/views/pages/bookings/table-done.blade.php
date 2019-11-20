@extends('layouts.master2')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Pinjaman Telah Disetujui</h4> 
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
                        <div class="alert alert-danger">{{ Session::get('message') }}</div>
                    @endif
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
                                    <th>Bidang Peminjam</th>
                                    <th>Ruang</th>
                                    <th>Jumlah Peserta</th>
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
                                    <td>{{ $data->bidang->bidang_name }}</td>
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
                                    <td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
                                    <td bgcolor="#64de5d">
                                      {{ $data->status->status_name }}
                                    </td>
                                    <!-- <td>{{$data->created_at}}</td> -->
                                    <td><button type="button" class="btn btn-primary btn_booking_done_edit_stat" data-toggle="modal" data-target="#modal-default" id="{{ $data->id_booking }}"><i class="fa fa-edit"></i></button></td>
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
                    <div class="checkbox">
                      <label for="booking_status" class="control-label">
                        <input type="checkbox" name="booking_status" id="optionsCheck2" value="2">
                        Batal
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
      <!-- /.modal -->

@endsection

@section('datatable')

<script>
  $(function () {
    $("#example1").DataTable();
    $('.btn_booking_done_edit_stat').click(function() {      
      var data = (this.id).split('||');
      console.log(this.id);

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
