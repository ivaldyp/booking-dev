@extends('layouts.master2')

@section('content')
	<div id="page-wrapper">
		<div class="container-fluid">
			<div class="row bg-title">
				<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					<h4 class="page-title">Form</h4> 
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
				<div class="col-sm-1"></div>
				<div class="col-sm-10">
					<div class="white-box">
						<form class="form-horizontal" method="POST" action="store" enctype="multipart/form-data" name="newbooking">
						  @csrf
							<!-- <input type="hidden" name="id_booking" value="<?php echo md5(uniqid()); ?>"> -->
							<input type="hidden" name="id_surat" value="<?php echo md5(uniqid()); ?>">
							<!-- <input type="hidden" name="booking_status" value="1"> -->
							<input type="hidden" name="request_hapus" value="0">
							
							<div class="form-group">
							  <label for="nip_peminjam" class="col-lg-2 control-label"> NIP </label>
							  <div class="col-lg-8">
								<input type="number" class="form-control" id="nip_peminjam" name="nip_peminjam" autocomplete="off" maxlength="18">
							  </div>
							</div>

							<div class="form-group">
							  <label for="nama_peminjam" class="col-lg-2 control-label"><span style="color: red">*</span> Nama Peminjam </label>
							  <div class="col-lg-8">
								<input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" autocomplete="off" required>
							  </div>
							</div>

							<div class="form-group">
							  <label for="subbidang_peminjam" class="col-lg-2 control-label"><span style="color: red">*</span> Subbidang Peminjam </label>
							  <div class="col-lg-8">
								<select class="form-control" name="subbidang_peminjam" id="subbidang_peminjam" required>
								  <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Subbidang --</option>
								  <?php $bidang_now = 0; foreach ($subbidangs  as $data) { 
								  	if ($data->id_bidang != $bidang_now){ 
								  		$bidang_now = $data->id_bidang ?>
								  		<optgroup label="{{ $data->bidang_name }}">
								  <?php 
								  	}
								  ?>
									<option value="{{ $data->id_bidang }}||{{ $data->id_subbidang }}">{{ $data->subbidang_name }}</option>
								  <?php } ?>
								</select>
							  </div>
							</div>

							<div class="form-group">
							  <label for="booking_date" class="col-lg-2 control-label"><span style="color: red">*</span> Tanggal </label>
							  <div class="col-lg-4">
								<div class="input-group date">
								  <div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								  </div>
								  <input type="text" class="form-control pull-right booking_date" id="datepicker-autoclose" name="booking_date" autocomplete="off" required>
								</div>
							  </div>  
							</div>

							<div class="form-group">
							  <label class="col-lg-2 control-label"><span style="color: red">*</span> Jam Mulai </label>
							  <div class="col-lg-4">
								<select class="form-control" name="time_start" id="time_start" required>
								  <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Waktu --</option>
								  <?php
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
							  <label for="booking_room" class="col-lg-2 control-label"><span style="color: red">*</span> Ruang Rapat </label>
							  <div class="col-lg-2">
								<select class="form-control" name="total_room" id="total_room" required >
								  <option value="1"> 1 </option>
								  <option value="2"> 2 </option>
								  <option value="3"> 3 </option>
								  <option value="4"> 4 </option>
								</select>
							  </div>
							  <!-- <div class="col-lg-8">
								<select class="form-control" name="booking_room[]" id="booking_room" required >
								  <option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
								  <?php foreach ($rooms as $data) { ?>
									<option value="{{ $data->id_room }}" roomcap="{{$data->room_capacity}}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option>
								  <?php } ?>
								</select>
							  </div> -->
							</div>

							<div id="ruang-tambahan">
							  <div class="form-group">
								<label for="booking_room" class="col-lg-2 control-label"></label>
								<div class="col-lg-8">
								  <select class="form-control booking_room" name="booking_room[]" required >
									<option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option>
									<?php $bidang_now=0; foreach ($rooms as $data) { 
									  if ($data->room_owner != $bidang_now) {
										$bidang_now = $data->room_owner; 
									?> 
										<optgroup label="{{ $data->bidang_name }}">
									<?php
									  }
									?>

									  <option value="{{ $data->id_room }}||{{ $data->room_owner }}||{{ $data->room_subowner }}" roomcap="{{$data->room_capacity}}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option>
									<?php } ?>
								  </select>
								</div>
							  </div>
							</div>
				
							<div class="form-group">
							  <label for="booking_total_tamu" class="col-lg-2 control-label"> Jumlah Peserta </label>
							  <div class="col-lg-4">
								<input type="text" class="form-control" id="booking_total_tamu" name="booking_total_tamu" autocomplete="off" maxlength="3">
							  </div>
							</div>

							<div class="form-group">
							  <label for="booking_total_snack" class="col-lg-2 control-label"> Jumlah Snack </label>
							  <div class="col-lg-4">
								<input type="number" class="form-control" id="booking_total_snack" name="booking_total_snack" autocomplete="off" maxlength="3">
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
							  <label for="surat_file" class="col-lg-2 control-label"><span style="color: red">*</span> Upload Surat <br> <span style="font-size: 10px">Hanya berupa PDF, JPG, JPEG, dan PNG</span> </label>
							  <div class="col-lg-8">
								<input type="file" class="form-control" id="surat_file" name="surat_file" required>
							  </div>
							</div>

						  <!-- /.box-body -->
						  	<div class="form-group">
						  		<div class="col-lg-2"></div>
								<div class="col-lg-8">
								  <!-- <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modal-default" id="btn_form_booking_modal">
									Simpan
								  </button> -->

								  <!-- <button type="submit" class="btn btn-primary pull-right" id="btn_form_booking_modal"> -->
								  <button type="submit" class="btn btn-primary pull-right">
									Simpan
								  </button>
								<div class="col-lg-2"></div>
						  	</div>
						  </div>
						  <!-- /.box-footer -->
						</form>
					</div>
				</div>
				<div class="col-sm-1"></div>
			</div>
		</div>
		<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
	</div>
	
@endsection

@section('formvalidation')

<script language="javascript" type="text/javascript">
  $(function() {

	$("#total_room").change(function () {
	  $("#ruang-tambahan").empty();
	  for (var i = 0; i < $("#total_room").val(); i++) {
		$("#ruang-tambahan").append('<div class="form-group"><label for="booking_room" class="col-lg-2 control-label"></label><div class="col-lg-8"><select class="form-control booking_room" name="booking_room[]" required ><option value="<?php echo NULL; ?>" selected disabled>-- Pilih Ruang --</option><?php foreach ($rooms as $data) { if ($data->room_owner != $bidang_now) { $bidang_now = $data->room_owner; ?><optgroup label="{{ $data->bidang_name }}"><?php } ?><option value="{{ $data->id_room }}||{{ $data->room_owner }}||{{ $data->room_subowner }}" roomcap="{{$data->room_capacity}}">{{ $data->room_name }} (Kapasitas {{$data->room_capacity}} orang)</option><?php } ?></select></div></div>');
	  }
	});

	//WARNING KALAU TAMU LEBIH BANYAK DARI KAPASITAS RUANG
	$("#booking_total_tamu").on("keypress keyup blur",function (event) {    
	  $(this).val($(this).val().replace(/[^\d].+/, ""));
	  if ((event.which < 48 || event.which > 57)) {
		event.preventDefault();
	  }
	});

	// ---------------------------------------------------------------------- //

	$('#nip_peminjam').unbind('keyup change input paste').bind('keyup change input paste',function(e){
	  var $this = $(this);
	  var val = $this.val();
	  var valLength = val.length;
	  var maxCount = $this.attr('maxlength');
	  if(valLength>maxCount){
		  $this.val($this.val().substring(0,maxCount));
	  }
	});

	$('#booking_total_snack').unbind('keyup change input paste').bind('keyup change input paste',function(e){
	  var $this = $(this);
	  var val = $this.val();
	  var valLength = val.length;
	  var maxCount = $this.attr('maxlength');
	  if(valLength>maxCount){
		  $this.val($this.val().substring(0,maxCount));
	  }
	});

	$('#booking_total_tamu').unbind('keyup change input paste').bind('keyup change input paste',function(e){
	  var $this = $(this);
	  var val = $this.val();
	  var valLength = val.length;
	  var maxCount = $this.attr('maxlength');
	  if(valLength>maxCount){
		  $this.val($this.val().substring(0,maxCount));
	  }
	});

	$('#surat_file').bind('change', function() {
	  var ext = $("#surat_file").val().split('.').pop();
	  if (ext != 'pdf' && ext != 'pdf' && ext != 'pdf' && ext != 'pdf') {
		alert("File hanya boleh memiliki ekstensi PDF / JPG / JPEG / PNG");
		$('#surat_file').val('');
	  }
	  if (this.files[0].size > 2100000) {
		alert("Ukuran file tidak dapat melebihi 2MB");
		$('#surat_file').val('');
	  }
	  //this.files[0].size gets the size of your file.
	  // alert(this.files[0].size);

	});
	$("form[name='newbooking']").validate({
	  rules: {
		nama_peminjam: "required",
		bidang_peminjam: "required",
		booking_room: "required",
		booking_date: "required",
		time_start: "required",
		time_end: "required",
		surat_judul: "required",
		surat_file: {
		  required: true,
		},
	  },
	  highlight: function(element) {
		  $(element).css('background', '#ffdddd');
	  },
	  unhighlight: function(element) {
		$(element).css('background', '#ffffff');
	  },
	  messages: {
		nama_peminjam: "Masukkan Nama Peminjam",
		bidang_peminjam: "Pilih Bidang",
		booking_room: "Pilih Ruang Rapat",
		booking_date: "Pilih Tanggal Rapat",
		time_start: "Pilih Waktu Mulai",
		time_end: "Pilih Waktu Selesai",
		surat_judul: "Masukkan Nama Acara",
		surat_file: {
		  required: "Unggah Surat",
		},
	  }
	});
  });
</script>

@endsection

@section('datepicker')

<script>
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
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom'
        , align: 'left'
        , autoclose: true
        , 'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done'
    , }).find('input').change(function () {
        console.log(this.value);
    });
    $('#check-minutes').click(function (e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
		todayHighlight: true, 
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm']
        , applyClass: 'btn-danger'
        , cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true
        , format: 'MM/DD/YYYY h:mm A'
        , timePickerIncrement: 30
        , timePicker12Hour: true
        , timePickerSeconds: false
        , buttonClasses: ['btn', 'btn-sm']
        , applyClass: 'btn-danger'
        , cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY'
        , minDate: '06/01/2015'
        , maxDate: '06/30/2015'
        , buttonClasses: ['btn', 'btn-sm']
        , applyClass: 'btn-danger'
        , cancelClass: 'btn-inverse'
        , dateLimit: {
            days: 6
        }
    });
</script>

@endsection