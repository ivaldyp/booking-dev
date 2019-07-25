@extends('layouts.master')

@section('content')

		<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hak Akses Pengguna {{ Session::get('user_status') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
	                <tr>
	                  <th>No</th>
	                  <th>Jenis Pengguna</th>
	                  <th>Kelola Pengguna</th>
	                  <th>Kelola Ruang</th>
	                  <th>Sewa Ruang</th>
	                  <th>Setujui Ruangan</th>
	                  <th>Beli Snack</th>
	                </tr>
                </thead>
                <tbody>
	                <tr>
	                  <td>Trident</td>
	                  <td>Internet
	                    Explorer 4.0
	                  </td>
	                  <td>Win 95+</td>
	                  <td> 4</td>
	                  <td>X</td>
	                </tr>
	                <tr>
	                  <td>Trident</td>
	                  <td>Internet
	                    Explorer 5.0
	                  </td>
	                  <td>Win 95+</td>
	                  <td>5</td>
	                  <td>C</td>
	                </tr>
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