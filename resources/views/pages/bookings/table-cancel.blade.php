@extends('layouts.master')

@section('content')

    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          @if(Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
          @endif
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-xs-3">
          <button class="btn btn-success" style="margin-bottom: 10px">Tambah</button>
        </div>
      </div> -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Booking Dibatalkan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Acara</th>
                    <th class="col-lg-3">Deskripsi</th>
                    <th>Nama Peminjam</th>
                    <th>NIP</th>
                    <th>Bidang Peminjam</th>
                    <th>Ruang</th>
                    <th>Jumlah Peserta</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>File Surat</th>
                    <th>Disetujui Oleh</th>
                    <th>Status Booking</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($rooms as $key => $data) { ?>
                  <tr>
                    <input class="form_book_done_id_booking" type="hidden" name="id_booking" value="{{ $data->id_booking }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->surat_judul }}</td>
                    <td>{{ $data->surat_deskripsi }}</td>
                    <td>{{ $data->nama_peminjam }}</td>
                    <td>{{ $data->nip_peminjam }}</td>
                    <td>{{ $data->bidang_name }}</td>
                    <td>{{ $data->room_name }}</td>
                    <td>{{ $data->booking_total_tamu }}</td>
                    <td>{{ $data->booking_date2 }}</td>
                    <td>{{ $data->time_start }} - {{ $data->time_end }}</td>
                    <?php $file_name = explode("~", $data->file_name); ?>
                    <td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}"> {{ $file_name[2] }} </a></td>
                    <td>{{ ucwords($data->name) }}</td>
                    <td bgcolor="#ff3333">
                      {{ $data->status_name }}
                    </td>
                    <td>Buat ulang pinjaman <br><hr> 
                      {{ $data->keterangan_status }}
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
    $('.btn_booking_done_edit_stat').click(function() {
      console.log(this.id);
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
