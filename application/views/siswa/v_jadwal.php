<!-- fullcalendar css -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.css' ?>">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <!-- Announcement -->
            <?php $notif = $this->db->get('tbl_pengumuman')->row_array();
            if ($notif['aktifkan'] > 0) { ?>
                <div class="row">
                    <div class="offset-1 col-sm-10">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Announcement!</h4>
                            <p><?= $notif['pengumuman_deskripsi'] ?></p>
                            <hr>
                            <p class="mb-0">&copy; Anak Panah Cyber Scholl.</p>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <!-- Tagihan -->
            <div class="row">
                <div class="offset-1 col-sm-10 media-nav">
                    <!-- Index Prestasi -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0"><i class="fas fa-fw fa-calendar-alt fa-lg" style="padding-right: 1.5em"></i> Kalender Akademik</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->


        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- FULL CALENDAR PACKAGES -->
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/moment/moment.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-interaction/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.js' ?>"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- END OF FULL CALENDAR PACKAGES -->
<?php $this->load->view('siswa/layout/v_js'); ?>
<script>
    $(function() {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)


                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag


                })


            })
        }

        // SENGAJA DI COMMENT, INIT UNTUK SYNC LIST AGENDA KE CALENDAR
        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendarInteraction.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        var calendar = new Calendar(calendarEl, {

            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            'themeSystem': 'bootstrap',
            //Random default events
            events: [
                <?= $str ?>

            ],
            eventTimeFormat: {
                hour: '2-digit', //2-digit, numeric
                minute: '2-digit', //2-digit, numeric
                meridiem: false, //lowercase, short, narrow, false (display of AM/PM)
                hour12: false //true, false
            },

            // CONFIG UNTUK AGENDA DAPAT DIGESER PADA CALENDAR
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            // END OF CONFIG UNTUK AGENDA DAPAT DIGESER PADA CALENDAR

            eventClick: function(event, element1) {

                event.title = event.event.title;
                event.date = event.event._instance.range.start.getFullYear() + '-' + event.event._instance.range.start.getMonth() + '-' + event.event._instance.range.start.getDate();

                // event.id = event.event.Id;
                // event.date = info.date;
                // removeEvents.(this);
                // console.log(event.event.title);
                // console.log(event.event._instance.range.start.getDate());
                // console.log(event.event._instance.range.start.getMonth());
                // console.log(event.event._instance.range.start);
                // console.log(event.date);
                // console.log(event.event.defId);
                // alert(" judulnya " + event.title);
                Swal.fire({
                    icon: 'info',
                    title: 'Detail',
                    text: event.title
                });

            }


        });

        calendar.render();
        // $('#calendar').fullCalendar()

    })
</script>