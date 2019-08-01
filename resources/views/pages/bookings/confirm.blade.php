@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          @if(Session::has('message'))
            <div class="alert alert-danger">{{ Session::get('message') }}</div>
          @endif
        </div>
        <div class="col-lg-2"></div>
      </div>
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Konfirmasi</h3>
            </div>
            <form class="form-horizontal" method="POST" action="store" enctype="multipart/form-data">
              @csrf
              <div class="box-body">

                <input type="hidden" name="id_booking" value="<?php echo $id_booking; ?>">
                <input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>">
                <input type="hidden" name="booking_status" value="1">
                <input type="hidden" name="request_hapus" value="0">
                
                <div class="form-group">
                  <label for="id_peminjam" class="col-lg-2 control-label"> NIP </label>
                  <div class="col-lg-8">
                    <h5><?php echo $id_peminjam; ?></h5>
                    <input type="hidden" name="id_peminjam" value="<?php echo $id_peminjam; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama_peminjam" class="col-lg-2 control-label"> Nama Peminjam </label>
                  <div class="col-lg-8">
                    <h5><?php echo $nama_peminjam; ?></h5>
                    <input type="hidden" name="nama_peminjam" value="<?php echo $nama_peminjam; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="bidang_peminjam" class="col-lg-2 control-label"> Bidang Peminjam </label>
                  <div class="col-lg-8">
                    <h5><?php echo $bidang[0]->bidang_name; ?></h5>
                    <input type="hidden" name="bidang_peminjam" value="<?php echo $bidang_peminjam; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_room" class="col-lg-2 control-label"> Ruang Rapat </label>
                  <div class="col-lg-8">
                    <h5><?php echo $ruang[0]->room_name; ?></h5>
                    <input type="hidden" name="booking_room" value="<?php echo $booking_room; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_date" class="col-lg-2 control-label"> Tanggal </label>
                  <div class="col-lg-4">
                    <h5><?php echo $booking_date; ?></h5>
                    <input type="hidden" name="booking_date" value="<?php echo $booking_date; ?>">
                  </div>  
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label"> Jam Mulai </label>
                  <div class="col-lg-4">
                    <h5><?php echo $start[0]->time_name; ?></h5>
                    <input type="hidden" name="time_start" value="<?php echo $time_start; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label"> Jam Mulai </label>
                  <div class="col-lg-4">
                    <h5><?php echo $end[0]->time_name; ?></h5>
                    <input type="hidden" name="time_end" value="<?php echo $time_end; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_judul" class="col-lg-2 control-label"> Judul Acara </label>
                  <div class="col-lg-8">
                    <h5><?php echo $surat_judul; ?></h5>
                    <input type="hidden" name="surat_judul" value="<?php echo $surat_judul; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_deskripsi" class="col-lg-2 control-label"> Deskripsi </label>
                  <div class="col-lg-8">
                    <h5><?php echo $surat_deskripsi; ?></h5>
                    <input type="hidden" name="surat_deskripsi" value="<?php echo $surat_deskripsi; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_file" class="col-lg-2 control-label"> Upload Surat </label>
                  <div class="col-lg-8">
                    <h5><?php echo $surat_file->getClientOriginalName(); ?></h5>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-lg-2"></div>
                <div class="col-lg-10">
                  <button type="submit" class="btn btn-success pull-right">Simpan</button>
                </div>
                <!-- <div class="col-lg-2"></div> -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </section>

    

@endsection

@section('datepicker')

<script language="javascript" type="text/javascript">
  var today = new Date(); 
  $(function () {
    $('#datepicker').datepicker({
      autoclose: true,
      numberOfMonths: 3,
      startDate: new Date(),
    });
  });
</script>

@endsection