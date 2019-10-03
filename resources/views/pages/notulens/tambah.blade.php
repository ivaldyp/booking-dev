@extends('layouts.master')

@section('content')

<section class="content">
	<!-- <div class="row">
		<div class="col-lg-12">
			@if(Session::has('message'))
				<div class="alert alert-danger">{{ Session::get('message') }}</div>
			@endif
		</div>
	</div> -->

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Tambah Surat Notulen {{ $surat_judul[0] }}</h3>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection