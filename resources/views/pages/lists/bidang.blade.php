@extends('layouts.master2')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Rekap Per Bidang</h4> 
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
                <form method="GET" action="bidang">
                    <div class="form-row">
                      <div class="form-group col-xs-3">
                        <select class="form-control" name="bidang_peminjam" id="bidang_peminjam" required>
                          <?php foreach ($bidangs as $data) { ?>
                            <option value="{{ $data->id_bidang }}" 
                              <?php 
                                if ($id_bidang == $data->id_bidang) {
                                  echo "selected";
                                }
                              ?>
                            >{{ $data->bidang_name }}</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-xs-1">
                        <select class="form-control" name="monthnow" id="monthnow" required>
                          <?php foreach ($montharray as $key => $data) { ?>
                            <option value="{{ $key + 1 }}" 
                              <?php 
                                if ($monthnow == $key+1) {
                                  echo "selected";
                                }
                              ?>
                            >{{ $data }}</option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-xs-2">
                        <select class="form-control" name="booking_status" id="booking_status" required>
                        <option <?php if($booking_status == 3) {echo "selected";} ?> value="3">Disetujui</option>
                        <option <?php if($booking_status == 2) {echo "selected";} ?> value="2">Dibatalkan</option>
                        <option <?php if($booking_status == 1) {echo "selected";} ?> value="1">Belum Disetujui</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
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
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Acara</th>
                                        <th>Deskripsi</th>
                                        <th>Nama Peminjam</th>
                                        <th>Subbidang Peminjam</th>
                                        <th>Ruang</th>
                                        <th>Jumlah Peserta</th>
                                        <th class="col-sm-1">Waktu</th>
                                        <th>File Surat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listbidang as $key => $data) { ?>
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
                                        <td><a href="{{ url('booking/download') }}/{{ $data->surat->id_surat }}"> {{ $file_name[2] }} </a></td>
                                      </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
    </div>
    
@endsection

@section('datatable')

<script>
  $(function () {
    // $('#bidang_peminjam').change(function() {
    //     this.form.submit();
    // });

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
