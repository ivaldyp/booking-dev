@extends('layouts.master')

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          @if(Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
          @endif
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Peminjaman Telah Disetujui</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                    <td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
                    <td bgcolor="#64de5d">
                      {{ $data->status->status_name }}
                    </td>
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

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Peminjaman Belum Disetujui</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                    <td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
                    <td bgcolor='yellow'>
                      {{ $data->status->status_name }}
                    </td>
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

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Peminjaman Tidak Disetujui</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
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
                    <td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
                    <td bgcolor="#ff3333"><b>
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
    $("#example2").DataTable();
    $("#example3").DataTable();
  });
</script>

@endsection
