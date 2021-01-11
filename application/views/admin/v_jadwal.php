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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SEKOLAH ANAK PANAH | Jadwal</title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- Ionicons -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">

    <!-- fullcalendar css -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.css' ?>">

    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css">

</head>
<style>
    /* .swal2-popup.swal2-modal.swal2-icon-warning.swal2-show {
        font-size: 20px;
    } */

    .swal2-popup.swal2-modal {
        font-size: 20px;
    }

    /* .swal2-header {
        font-size: 20px;
    }

    .swal2-content {
        font-size: 20px !important;
    }

    .swal2-actions {
        font-size: 20px;
    } */
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!--Header-->
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
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li class="active">
                            <a href="<?php echo base_url() . 'jadwal' ?>">
                                <i class="fa fa-calendar"></i> <span>Kalendar</span>
                                <span class="pull-right-container">
                                    <small class="p pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'datalembaga' ?>">
                                <i class="fa fa-building"></i> <span>Lembaga</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'satelit' ?>">
                                <i class="fa fa-rocket"></i> <span>Data Satelit</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url() . 'pegawai' ?>">
                                <i class="fa fa-server" aria-hidden="true"></i>
                                <span>Pegawai</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
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
                                    <small class="label pull-right bg-green"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'keuangan' ?>">
                                <i class="fa fa-money"></i> <span>Keuangan</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green"></small>
                                </span>
                            </a>
                        </li>


                    <?php else : ?>

                        <li class="active">
                            <a href="<?php echo base_url() . 'dashboard-siswa' ?>">
                                <i class="fa fa-home"></i> <span>Dashboard</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url() . 'keuangan-siswa' ?>">
                                <i class="fa fa-calendar"></i> <span>Keuangan</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>


                        <li>
                            <a href="<?php echo base_url() . 'kisikisi' ?>">
                                <i class="fa fa-calendar"></i> <span>Kisi - Kisi</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-calendar"></i> <span>Evaluasi</span>
                                <span class="pull-right-container">
                                    <small class="label pull-right"></small>
                                </span>
                            </a>
                        </li>

                    <?php endif ?>
                    <li>
                        <a href="<?php echo base_url() . 'login/logout' ?>">
                            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                            <span class="pull-right-container">
                                <small class="label pull-right"></small>
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
                    Kalendar
                    <small></small>
                    <a class="btn btn-danger btn-flat" id="trigerjadwal"><span class="fa fa-plus"></span> Buat Event</a>
                    <a href="<?= base_url('jadwal/jadwal_kelas') ?>" class="btn btn-info btn-flat"><span class="fa fa-cog"></span> Seting Jadwal Kelas</a>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kalendar</li>

                </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="min-height: 1000px;">

                <div class="row">
                    <!-- tambah jadwal -->
                    <!-- <div class="col-xs-3"> -->
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
                    <!-- <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title"> List Jadwal Event</h3>
                            </div>
                            <div class="box-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Event</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>x</td>
                                            <td>x</td>
                                            <td>x</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                    <!-- </div> -->
                    <!-- END OF MENU TAMBAH AGENDA CALENDAR -->

                    <!-- LAYOUT CALENDAR -->
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF LAYOUT CALENDAR -->
                </div>

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- MODAL Tambah Jadwal -->
        <div class="modal fade" id="tambahjadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                        <h4 class="modal-title" id="myModalLabel">Buat Event</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('jadwal/add_jadwal') ?>" method="post" id="fm_oc">

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Judul Event </label>
                                <div class="col-sm-8" style="align-content: center; display: grid;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-pencil"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="judul_event" id="judul_event" placeholder="Tulis Nama Event" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Event Dari Tanggal</label>
                                <div class="col-sm-4" style="align-content: center; display: grid;">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="jdl_start" id="jdl_start" placeholder="yyyy-mm-dd" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group clockpicker1" data-placement="left" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock-o"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="start_on" id="start_on">
                                    </div>
                                </div>
                            </div>




                            <!-- <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Dimulai Jam </label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker1" data-placement="left" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock-o"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="start_on" id="start_on">
                                    </div>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Event Sampai Tanggal</label>
                                <div class="col-sm-4" style="align-content: center; display: grid;">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="jdl_end" id="jdl_end" placeholder="yyyy-mm-dd" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group clockpicker2" data-placement="left" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock-o"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="end_on" id="end_on">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Pilih Warna </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-pencil"></i></span>
                                        </div>
                                        <input type="color" class="form-control" name="warna" id="warna" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-4 col-form-label"> Apakah Event Untuk 1 Hari Penuh </label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-cog"></i></span>
                                        </div>
                                        <div class="col-sm-12" style="border-style: solid;border-width: 1px;border-color: #d2d6de;box-shadow: none;padding: 6px 12px;">
                                            <label class="radio-inline"><input type="radio" name="oneday" value="1" required>Ya</label>
                                            <label class="radio-inline"><input type="radio" name="oneday" value="0" required>Tidak</label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- 
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label"> Selesai Jam </label>
                                <div class="col-sm-8">
                                    <div class="input-group clockpicker2" data-placement="left" data-align="top" data-autoclose="true">
                                        <div class="input-group-addon">
                                            <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock-o"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="end_on" id="end_on" placeholder=" (opsional jika event di hari yang sama)">
                                    </div>
                                </div>
                            </div> -->

                            <!-- <h4>Note: Jika Event Hingga </h4> -->


                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary" type="submit" value="Submit" style="float: right;">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->


        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->
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

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>

    <!-- JS Datepicker -->
    <script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.min.js"></script>




    <script>
        $("#trigerjadwal").click(function() {
            $('#tambahjadwal').modal('show');
        });
    </script>
    <script>
        $('.input-group.date').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '0d',
            autoclose: true,
            todayHighlight: true

        });
        $('.clockpicker1').clockpicker();
        $('.clockpicker2').clockpicker();
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
                    if (event.event._instance.range.start.getMonth() > 0) {
                        event.bulan = event.event._instance.range.start.getMonth();
                        event.tahun = event.event._instance.range.start.getFullYear();
                    } else {
                        event.bulan = 12;
                        event.tahun = event.event._instance.range.start.getFullYear() - 1;
                    }

                    event.date = event.tahun + '-' + event.bulan + '-' + event.event._instance.range.start.getDate();

                    // event.id = event.event.Id;
                    // event.date = info.date;
                    // removeEvents.(this);
                    // console.log(event.event.title);
                    // console.log(event.event._instance.range.start.getDate());
                    // console.log(event.event._instance.range.start.getMonth());
                    // console.log(event.event._instance.range.start);
                    // console.log(event.event._instance.range.start.getFullYear() - 1);
                    // console.log(event.event.defId);
                    // alert(" judulnya " + event.title);
                    Swal.fire({
                        title: 'Apakah Kamu Yakin',
                        text: "Event Ini Akan Terhapus Dari Database!",
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonText: "Batalkan",
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Hapus Saja!'
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
            Swal.fire({
                icon: 'error',
                title: 'Gagal Update!',
                text: 'jika Bukan Event 1 Hari, Jam Wajib Di Isi',
                showConfirmButton: false,
                timer: 1500
            })
        </script>

    <?php elseif ($this->session->flashdata('msg') == 'success') : ?>
        <script type="text/javascript">
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Event Berhasil Di Update',
                showConfirmButton: false,
                timer: 1500
            })
        </script>

    <?php else : ?>

    <?php endif; ?>

</body>

</html>