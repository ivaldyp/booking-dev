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
        <div class="col-xs-2">
          <a href="{{ url('booking/form') }}"><button class="btn btn-success" style="margin-bottom: 10px"> Tambah </button></a>
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
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-12">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama file</th>
                <th>Download</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($files as $key => $data) { ?>
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $data->file_name }}</td>
                  <td><a href="{{ url('booking/download') }}/{{ $data->id_surat }}">
                    <button class="btn btn-success" type="submit">DONLOD</button>
                  </a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
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
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
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
