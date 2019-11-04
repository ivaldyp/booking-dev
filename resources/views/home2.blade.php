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
			<div class="row">
				<div class="col-xs-3">
		      		<a href="{{ url('/home') }}"><button class="btn btn-success" style="margin-bottom: 10px">Month View</button></a>
		      	</div>
			</div>
			<div class="row">
				<!-- /.col -->
				<!-- <div class="col-md-2"></div> -->
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-body no-padding">
							<!-- THE CALENDAR -->
							<div id="calendar"></div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /. box -->
				</div>
				<!-- <div class="col-md-2"></div> -->
				<!-- /.col -->
			</div>

			<style type="text/css">
				th.ui-widget-header {
				    font-size: 52pt;
				    font-family: Verdana, Arial, Sans-Serif;
				}
			</style>

			<!-- BEGIN MODAL -->
			<div class="modal fade" id="my-event">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><strong>Detail</strong></h4>
						</div>
						<div class="modal-body"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
							<!-- <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
							<button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button> -->
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Add Category -->
			<div class="modal fade" id="add-new-event">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><strong>Add</strong> a category</h4>
						</div>
						<div class="modal-body">
							<form role="form">
								<div class="row">
									<div class="col-md-6">
										<label class="control-label">Category Name</label>
										<input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
									</div>
									<div class="col-md-6">
										<label class="control-label">Choose Category Color</label>
										<select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
												<option value="success">Success</option>
												<option value="danger">Danger</option>
												<option value="info">Info</option>
												<option value="primary">Primary</option>
												<option value="warning">Warning</option>
												<option value="inverse">Inverse</option>
										</select>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
							<button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->

	    <script src="{{ URL::asset('plugins2/bower_components/calendar/dist/cal-init2.js') }}"></script>

@endsection 

@section('cal-init')
	<script src="{{ URL::asset('plugins2/bower_components/calendar/dist/cal-init2.js') }}"></script>
@endsection

