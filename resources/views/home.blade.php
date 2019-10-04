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

@endsection 

@section('calendar')
		<script language="javascript" type="text/javascript">
			$(document).ready(function () {
				/* initialize the calendar
				 -----------------------------------------------------------------*/
				//Date for the calendar events (dummy data)

				var date = new Date();
				var d = date.getDate(),
						m = date.getMonth(),
						y = date.getFullYear();
				var testt = 2;
				$('#calendar').fullCalendar({
					defaultView: 'listWeek',
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay,listWeek'
					},
					buttonText: {
						today: 'today',
						month: 'month',
						week: 'week',
						day: 'day'
					}
					// ,
					// events: [
					//   <?php for($i=0; $i< "+testt+"; $i++) { ?>
					//   {
					//     title: "<?php echo($i); ?>",
					//     start: '2019-07-24',
					//   },
					//   <?php } ?>
					// ]
					,
					dayClick: function(info) {
						alert('a day has been clicked!');
					},
					// eventClick: function(info) {
					//   var eventObj = info.event;

					//   if (eventObj) {
					//     alert(
					//       'Clicked ' + eventObj.title + '.\n'
					//       // 'Will open ' + eventObj.url + ' in a new tab'
					//     );

					//     // window.open(eventObj.url);

					//     info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
					//   } else {
					//     alert('Clicked ' + eventObj.title);
					//   }
					// },
				});

				var datas;
				// var newEvent = [];
				$.ajax({
					url: "/home/read",
					type: "get",
					success: function(data){
						datas = data.bookings;

						console.log(datas);
						console.log(datas[0].book_hstart);
						console.log(datas[0].booking_judul);
						for(var i=0; i<datas.length; i++)
						{
							// newEvent.push({ title:datas[i].booking_judul, allDay: true });
							var newEvent = {
								// title: datas[i].booking_judul,
								title: 'AAA',
								start: (datas[i].booking_date + " " + datas[i].time_startname),
								end: (datas[i].booking_date + " " + datas[i].time_endname)
							};
							$('#calendar').fullCalendar( 'renderEvent', newEvent , 'stick');    
						}
					}
				});
			});
			 
		</script>
@endsection
