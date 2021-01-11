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

</head>
<style>
    /*Check box*/
    input[type="checkbox"]+.label-text:before {
        content: "\f096";
        font-family: "FontAwesome";
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        width: 1em;
        display: inline-block;
        margin-right: 5px;
    }

    input[type="checkbox"]:checked+.label-text:before {
        content: "\f14a";
        color: #2980b9;
        animation: effect 250ms ease-in;
    }

    input[type="checkbox"]:disabled+.label-text {
        color: #aaa;
    }

    input[type="checkbox"]:disabled+.label-text:before {
        content: "\f0c8";
        color: #ccc;
    }

    @keyframes effect {
        0% {
            transform: scale(0);
        }

        25% {
            transform: scale(1.3);
        }

        75% {
            transform: scale(1.4);
        }

        100% {
            transform: scale(1);
        }
    }
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
                    <a class="btn btn-info btn-flat"><span class="fa fa-cog"></span> Seting Jadwal Kelas</a>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kalendar</li>
                    <li class="active">Jadwal Kelas</li>

                </ol>
            </section>

            <!-- Main content -->
            <section class="content" style="min-height: 1000px;">

                <div class="row">
                    <!-- LAYOUT CALENDAR -->
                    <div class="col-xs-12">
                        <div class="box">

                            <div class="box-body">
                                <div class="col-md-6">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($jadwal as $value) {
                                            ?>
                                                <tr>
                                                    <th scope="row"><?= $no++ ?></th>
                                                    <td><?= $value['kelas_nama'] ?></td>
                                                    <td><a class="btn btn-info btn-flat"><span class="fa fa-cog"></span> Seting</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
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

    <script>
        $(function() {
            $('.button-checkbox').each(function() {

                // Settings
                var $widget = $(this),
                    $button = $widget.find('button'),
                    $checkbox = $widget.find('input:checkbox'),
                    color = $button.data('color'),
                    settings = {
                        on: {
                            icon: 'glyphicon glyphicon-check'
                        },
                        off: {
                            icon: 'glyphicon glyphicon-unchecked'
                        }
                    };

                // Event Handlers
                $button.on('click', function() {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                });
                $checkbox.on('change', function() {
                    updateDisplay();
                });

                // Actions
                function updateDisplay() {
                    var isChecked = $checkbox.is(':checked');

                    // Set the button's state
                    $button.data('state', (isChecked) ? "on" : "off");

                    // Set the button's icon
                    $button.find('.state-icon')
                        .removeClass()
                        .addClass('state-icon ' + settings[$button.data('state')].icon);

                    // Update the button's color
                    if (isChecked) {
                        $button
                            .removeClass('btn-default')
                            .addClass('btn-' + color + ' active');
                    } else {
                        $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                    }
                }

                // Initialization
                function init() {

                    updateDisplay();

                    // Inject the icon if applicable
                    if ($button.find('.state-icon').length == 0) {
                        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                    }
                }
                init();
            });
        });
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