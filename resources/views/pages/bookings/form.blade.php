@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Booking Baru</h3>
            </div>
            <form class="form-horizontal" method="POST" action="store">
              @csrf
              <div class="box-body">

                <input type="hidden" name="id_booking" value="<?php echo md5(uniqid()); ?>">
                <input type="hidden" name="id_surat" value="<?php echo md5(uniqid()); ?>">
                <input type="hidden" name="booking_status" value="1">
                <input type="hidden" name="request_hapus" value="0">
                
                <div class="form-group">
                  <label for="id_peminjam" class="col-lg-2 control-label"> NIP </label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="id_peminjam" name="id_peminjam" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama_peminjam" class="col-lg-2 control-label"> Nama Peminjam </label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_room" class="col-lg-2 control-label"> Bidang Peminjam </label>
                  <div class="col-lg-8">
                    <select class="form-control">
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Bidang --</option>
                      <?php foreach ($bidangs as $data) { ?>
                        <option value="{{ $data->id_bidang }}">{{ $data->bidang_name }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_room" class="col-lg-2 control-label"> Ruang Rapat </label>
                  <div class="col-lg-8">
                    <select class="form-control">
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
                      <?php foreach ($rooms as $data) { ?>
                        <option value="{{ $data->id_room }}">{{ $data->room_name }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_date" class="col-lg-2 control-label"> Tanggal </label>
                  <div class="col-lg-4">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="booking_date" autocomplete="off">
                    </div>
                  </div>  
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label"> Jam Mulai </label>
                  <div class="col-lg-4">
                    <select class="form-control" name="time_start">
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Waktu --</option>
                      <?php foreach ($times as $data) { ?>
                        <option value="{{ $data->id_time }}">{{ $data->time_name }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label"> Jam Mulai </label>
                  <div class="col-lg-4">
                    <select class="form-control" name="time_end">
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Waktu --</option>
                      <?php foreach ($times as $data) { ?>
                        <option value="{{ $data->id_time }}">{{ $data->time_name }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_judul" class="col-lg-2 control-label"> Judul Acara </label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="surat_judul" name="surat_judul" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_deskripsi" class="col-lg-2 control-label"> Deskripsi </label>
                  <div class="col-lg-8">
                    <textarea class="form-control" id="surat_deskripsi" name="surat_deskripsi" rows="3" autocomplete="off"></textarea>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <button type="submit" class="btn btn-success pull-right">Submit</button>
                </div>
                <div class="col-lg-2"></div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <div class="col-lg-2"></div>
      </div>
    </section>

    

@endsection

@section('datatable')

<script language="javascript" type="text/javascript">
  $(function () {
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
</script>

@endsection