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
        <div class="col-lg-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Booking Baru</h3>
            </div>
            <form class="form-horizontal" method="POST" action="store" enctype="multipart/form-data">
              @csrf
              <div class="box-body">

                <input type="hidden" name="id_booking" value="<?php echo md5(uniqid()); ?>">
                <input type="hidden" name="id_surat" value="<?php echo md5(uniqid()); ?>">
                <input type="hidden" name="booking_status" value="1">
                <input type="hidden" name="request_hapus" value="0">
                
                <div class="form-group">
                  <label for="nip_peminjam" class="col-lg-2 control-label"> NIP </label>
                  <div class="col-lg-8">
                    <input type="number" class="form-control" id="nip_peminjam" name="nip_peminjam" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="nama_peminjam" class="col-lg-2 control-label"><span style="color: red">*</span> Nama Peminjam </label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="bidang_peminjam" class="col-lg-2 control-label"><span style="color: red">*</span> Bidang Peminjam </label>
                  <div class="col-lg-8">
                    <select class="form-control" name="bidang_peminjam" id="bidang_peminjam" required>
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Bidang --</option>
                      <?php foreach ($bidangs as $data) { ?>
                        <option value="{{ $data->id_bidang }}">{{ $data->bidang_name }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_room" class="col-lg-2 control-label"><span style="color: red">*</span> Ruang Rapat </label>
                  <div class="col-lg-8">
                    <select class="form-control" name="booking_room" id="booking_room" required>
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
                      <?php foreach ($rooms as $data) { ?>
                        <option value="{{ $data->id_room }}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_total_tamu" class="col-lg-2 control-label"> Jumlah Peserta </label>
                  <div class="col-lg-4">
                    <input type="number" class="form-control" id="booking_total_tamu" name="booking_total_tamu" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_total_snack" class="col-lg-2 control-label"> Jumlah Snack </label>
                  <div class="col-lg-4">
                    <input type="number" class="form-control" id="booking_total_snack" name="booking_total_snack" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="booking_date" class="col-lg-2 control-label"><span style="color: red">*</span> Tanggal </label>
                  <div class="col-lg-4">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right booking_date" id="datepicker" name="booking_date" autocomplete="off" required>
                    </div>
                  </div>  
                </div>

                <div class="form-group">
                  <label class="col-lg-2 control-label"><span style="color: red">*</span> Jam Mulai </label>
                  <div class="col-lg-4">
                    <select class="form-control" name="time_start" id="time_start" required>
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Waktu --</option>
                      <?php
                        // $i = 0;
                        // foreach ($times as $data) {
                        //   $time_name = explode(":", explode(" ", $data->time_name)[1]);
                        //   if ($i == count($times) - 1) {
                        //     break;
                        //   } else {
                        //     echo "<option value=".$data->id_time.">".$time_name[0].":". $time_name[1]."</option>";
                        //   }
                        //   $i++;
                        // }
                        foreach ($times as $data) { 
                          $time_name = explode(":", explode(" ", $data->time_name)[1]); ?>
                          <option value="{{ $data->id_time }}">{{ $time_name[0].":". $time_name[1] }}</option>
                        <?php }
                      ?>
                      
                    </select>
                  </div>
                </div> 

                <div class="form-group">
                  <label class="col-lg-2 control-label"><span style="color: red">*</span> Jam Selesai </label>
                  <div class="col-lg-4">
                    <select class="form-control" name="time_end" id="time_end" required> 
                      <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Waktu --</option>
                      <?php foreach ($times as $data) { 
                        $time_name = explode(":", explode(" ", $data->time_name)[1]); ?>
                        <option id="timend{{$data->id_time}}" value="{{ $data->id_time }}">{{ $time_name[0].":". $time_name[1] }}</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_judul" class="col-lg-2 control-label"><span style="color: red">*</span> Judul Acara </label>
                  <div class="col-lg-8">
                    <input type="text" class="form-control" id="surat_judul" name="surat_judul" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_deskripsi" class="col-lg-2 control-label"> Deskripsi Acara </label>
                  <div class="col-lg-8">
                    <textarea class="form-control" id="surat_deskripsi" name="surat_deskripsi" rows="3" autocomplete="off"></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="surat_file" class="col-lg-2 control-label"><span style="color: red">*</span> Upload Surat <br> <span style="font-size: 8px">Hanya berupa PDF, JPG, JPEG, dan PNG</span> </label>
                  <div class="col-lg-8">
                    <input type="file" class="form-control" id="surat_file" name="surat_file" required>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default" id="btn_form_booking_modal">
                    Simpan
                  </button>
                </div>
                <div class="col-lg-2"></div>
              </div>
              <!-- /.box-footer -->

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Apakah data dibawah sudah benar??</h4>
                    </div>
                    <div class="modal-body">

                      <div class="form-group">
                        <label for="nip_peminjam" class="col-lg-2 control-label"> NIP </label>
                        <div class="col-lg-8">
                          <h5 id="modal-nip_peminjam"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="nama_peminjam" class="col-lg-2 control-label"> Nama Peminjam </label>
                        <div class="col-lg-8">
                          <h5 id="modal-nama_peminjam"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="bidang_peminjam" class="col-lg-2 control-label"> Bidang Peminjam </label>
                        <div class="col-lg-8">
                          <h5 id="modal-bidang_peminjam"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="booking_room" class="col-lg-2 control-label"> Ruang Rapat </label>
                        <div class="col-lg-8">
                          <h5 id="modal-booking_room"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="booking_date" class="col-lg-2 control-label"> Tanggal </label>
                        <div class="col-lg-4">
                          <h5 id="modal-booking_date"></h5>
                        </div>  
                      </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label"> Jam Mulai </label>
                        <div class="col-lg-4">
                          <h5 id="modal-time_start"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label"> Jam Selesai </label>
                        <div class="col-lg-4">
                          <h5 id="modal-time_end"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surat_judul" class="col-lg-2 control-label"> Judul Acara </label>
                        <div class="col-lg-8">
                          <h5 id="modal-surat_judul"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surat_deskripsi" class="col-lg-2 control-label"> Deskripsi </label>
                        <div class="col-lg-8">
                          <h5 id="modal-surat_deskripsi"></h5>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surat_deskripsi" class="col-lg-2 control-label"> File </label>
                        <div class="col-lg-8">
                          <h5 id="modal-surat_file"></h5>
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success pull-right">Simpan</button>
                      <button type="button" class="btn btn-default pull-right" style="margin-right: 10px" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

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
      beforeShowDay: $.datepicker.noWeekends,
      autoclose: true,
      numberOfMonths: 3,
      startDate: new Date(),
      minDate: new Date(),
      maxDate: new Date(),
      format: 'dd/mm/yyyy'
    });
  });
</script>

@endsection

@section('form_booking')

<script type="text/javascript" language="javascript">
  $(function () {
    $("#time_start").change(function(){

      var selectedtime = $(this).children("option:selected").val();
      for (var i = 1; i <= 22; i++) {
        var timend = '#timend'+i;
        if (i <= selectedtime) {
          $(timend).toggle(false);    
        } else {
          $(timend).toggle(true);  
        }
      }
    });

    $('#btn_form_booking_modal').click(function() {
      $("#modal-nip_peminjam").append($("#nip_peminjam").val());
      $("#modal-nama_peminjam").append($("#nama_peminjam").val());
      if ($("#bidang_peminjam option:selected").text().substr(0,2) != '--') {
        $("#modal-bidang_peminjam").append($("#bidang_peminjam option:selected").text());
      }
      if ($("#booking_room option:selected").text().substr(0,2) != '--') {
        $("#modal-booking_room").append($("#booking_room option:selected").text());
      }
      $("#modal-booking_date").append($(".booking_date").val());
      if ($("#time_start option:selected").text().substr(0,2) != '--') {
        $("#modal-time_start").append($("#time_start option:selected").text());
      }
      if ($("#time_end option:selected").text().substr(0,2) != '--') {
        $("#modal-time_end").append($("#time_end option:selected").text());
      }
      $("#modal-surat_judul").append($("#surat_judul").val());
      $("#modal-surat_deskripsi").append($("#surat_deskripsi").val());
      $("#modal-surat_file").append($("#surat_file").val().replace(/C:\\fakepath\\/i, '')); 
    });

    $("#modal-default").on("hidden.bs.modal", function () {
      $("#modal-nip_peminjam").empty();
      $("#modal-nama_peminjam").empty();
      $("#modal-bidang_peminjam").empty();
      $("#modal-booking_room").empty();
      $("#modal-booking_date").empty();
      $("#modal-time_start").empty();
      $("#modal-time_end").empty();
      $("#modal-surat_judul").empty();
      $("#modal-surat_deskripsi").empty();
      $("#modal-surat_file").empty();
    });
  });
</script>

@endsection