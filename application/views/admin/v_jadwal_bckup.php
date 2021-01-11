<!--Counter Inbox-->
<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
?>
<?php
$id_admin = $this->session->userdata('idadmin');
$q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
$c = $q->row_array();
?>
<?php
if ($c['pengguna_level'] == 2) {
    $url = base_url() . 'dashboard';
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    exit();
    // die();
};
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SEKOLAH ANAK PANAH | Lembaga</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/daterangepicker/daterangepicker.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/timepicker/bootstrap-timepicker.min.css' ?>">
    <!-- fullcalendar css -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php
        $this->load->view('admin/v_header');
        ?>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">

                    <li class="header">Menu Utama</li>
                    <?php if ($c['pengguna_level'] == 1) : ?>

                        <li>
                            <a href="<?php echo base_url() . 'dashboard' ?>">
                                <i class="fa fa-home"></i> <span>Dashboard</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li class="active">
                            <a href="#">
                                <i class="fa fa-calendar"></i> <span>Jadwal</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'datalembaga' ?>">
                                <i class="fa fa-building"></i> <span>Lembaga</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'satelit' ?>">
                                <i class="fa fa-rocket"></i> <span>Data Satelit</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url() . 'pegawai' ?>">
                                <i class="fa fa-server" aria-hidden="true"></i>
                                <span>Pegawai</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Kesiswaan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url() . 'siswa' ?>"><i class="fa fa-users"></i> Data Siswa</a></li>
                                <li><a href="<?php echo base_url() . 'siswa_keluar' ?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
                            </ul>
                        </li>


                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>E-Raport</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo base_url() . 'mapel' ?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
                                <li><a href="<?php echo base_url() . 'nilai_raport' ?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'kisikisi' ?>">
                                <i class="fa fa-file-text"></i> <span>Kisi-Kisi</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right bg-green"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'keuangan' ?>">
                                <i class="fa fa-money"></i> <span>Keuangan</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right bg-green"></small>
                                </span>
                            </a>
                        </li>


                    <?php else : ?>

                        <li class="active">
                            <a href="<?php echo base_url() . 'dashboard-siswa' ?>">
                                <i class="fa fa-home"></i> <span>Dashboard</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'keuangan-siswa' ?>">
                                <i class="fa fa-calendar"></i> <span>Keuangan</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url() . 'kisikisi' ?>">
                                <i class="fa fa-calendar"></i> <span>Kisi - Kisi</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-calendar"></i> <span>Evaluasi</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                    <?php endif ?>
                    <li>
                        <a href="<?php echo base_url() . 'login/logout' ?>">
                            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                            <span class="pull-right-container">
                                <small class="p pull-right"></small>
                            </span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Jadwal
                    <small></small>
                </h1>
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Jadwal</li>
                </ol>
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- tambah jadwal -->
                    <div class="col-xs-3">
                        <!-- LIST AGENDA CALENDAR -->
                        <!-- <div class="box">
                            <div class="box-body">
                                <div id="external-events">
                                    <div class="external-event bg-success">Lunch</div>
                                    <div class="external-event bg-warning">Go home</div>
                                    <div class="external-event bg-info">Do homework</div>
                                    <div class="external-event bg-primary">Work on UI design</div>
                                    <div class="external-event bg-danger">Sleep tight</div>
                                    <div class="checkbox">
                                        <label for="drop-remove">
                                            <input type="checkbox" id="drop-remove">
                                            remove after drop
                                        </label>
                                    </div>

                                </div>
                            </div>

                        </div> -->
                        <!-- END OF LIST AGENDA CALENDAR -->

                        <!-- MENU TAMBAH AGENDA CALENDAR -->
                        <div class="box">
                            <div class="box-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <button type="button" id="color-chooser-btn" class="btn btn-info btn-block dropdown-toggle" data-toggle="dropdown">Color <span class="caret"></span></button>
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-success" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <div class="input-group">
                                    <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                    <div class="input-group-append">
                                        <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF MENU TAMBAH AGENDA CALENDAR -->

                    <!-- LAYOUT CALENDAR -->
                    <div class="col-xs-9">
                        <div class="box">
                            <div class="box-body">
                                <div id="calendar"></div>
                                <div id="calendarTrash" class="calendar-trash"><span style="width: 40px;"><i class="fa fa-trash"></i></span></div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF LAYOUT CALENDAR -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>

    <!-- FULL CALENDAR PACKAGES -->
    <!-- fullCalendar 2.2.5 -->
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/moment/moment.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-interaction/main.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.js' ?>"></script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Bootstrap -->
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <!-- jQuery UI -->
    <script src="<?php echo base_url() . 'assets/fullcalendarpackage/jquery-ui/jquery-ui.min.js' ?>"></script>
    <!-- END OF FULL CALENDAR PACKAGES -->

    <!-- jquery -->
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
    <!-- page script -->
    <script>
        function checknumber() {
            return event.keyCode >= 48 && event.keyCode <= 57;
        }
    </script>

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

            // initialize the external events
            // -----------------------------------------------------------------

            // SENGAJA DI COMMENT, MENU UNTUK DRAG LIST AGENDA KE CALENDAR
            // new Draggable(containerEl, {
            //     itemSelector: '.external-event',
            //     eventData: function(eventEl) {

            //         console.log(eventEl);
            //         return {
            //             title: eventEl.innerText,
            //             backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            //             borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
            //             textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
            //         };

            //     }
            // });

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
                    // untuk event 1 hari
                    // {
                    //     title: 'All Day Event',
                    //     start: new Date(2020, 11, 01),
                    //     end: new Date(2020, 11, 04 + 1), // +1 untuk penyimpanan database
                    //     backgroundColor: '#f56954', //red
                    //     borderColor: '#f56954', //red
                    //     allDay: true
                    // }
                    // {
                    //     title: 'All Day Event',
                    //     start: new Date(2020, 11, 01),
                    //     end: new Date(2020, 11, 04 + 1), // +1 untuk penyimpanan database
                    //     backgroundColor: '#f56954', //red
                    //     borderColor: '#f56954', //red
                    //     allDay: true
                    // }
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

                drop: function(info) {
                    // alert(info.event.title + " was dropped on ");
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }

                    var year = (info.date).getFullYear();
                    var month = (info.date).getMonth() + 1;
                    var day = (info.date).getDate();
                    // console.log(info.date);
                    alert(" judulnya " + info.draggedEl.textContent + " tanggalnya di " + day + "-" + month + "-" + year);
                    // alert(" Tanggal ada di " + info.draggedEl.textContent);
                },
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
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '<?= site_url('jadwal/hapus_jadwal') ?>', // url
                                type: 'POST',
                                dataType: 'JSON',
                                data: {
                                    title: event.title,
                                    tanggal: event.date
                                }, // data form
                                success: function(data) { // respons success
                                    Swal.fire('Deleted!', 'Data Berhasil Di Hapus', 'success').then((data) => {
                                        location.reload();
                                    })
                                }
                            });
                        }
                    })
                }


            });

            calendar.render();
            // $('#calendar').fullCalendar()

            /* ADDING EVENTS */
            var currColor = '#3c8dbc' //Red by default
            //Color chooser button
            var colorChooser = $('#color-chooser-btn')
            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                //Save color
                currColor = $(this).css('color')
                //Add color effect to button
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })

            // tambah event baru
            $('#add-new-event').click(function(e) {
                e.preventDefault()
                //Get value and make sure it is not null
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                //Create events
                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.html(val)
                $('#external-events').prepend(event)

                //Add draggable funtionality
                ini_events(event)

                //Remove event from text input
                $('#new-event').val('')
            })
        })
    </script>

    <?php if ($this->session->flashdata('msg') == 'error') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Error',
                text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
                showHideTransition: 'slide',
                icon: 'error',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#FF4859'
            });
        </script>

    <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Pengumuman Berhasil disimpan ke database.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'info') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Pengumuman berhasil di update",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'success-hapus') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Success',
                text: "Pengumuman Berhasil dihapus.",
                showHideTransition: 'slide',
                icon: 'success',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#7EC857'
            });
        </script>
    <?php else : ?>

    <?php endif; ?>
</body>

</html>