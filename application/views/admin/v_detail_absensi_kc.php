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
    <title>SEKOLAH ANAK PANAH | Data Absen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, siswa-scalable=no" name="viewport">
    <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />

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
                                    <small class="label pull-right"></small>
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

                        <li class="treeview" class="active">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Kesiswaan</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="active"><a href="<?php echo base_url() . 'siswa' ?>"><i class="fa fa-users"></i> Data Siswa</a></li>
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
                    Data Absensi <?= $nama['siswa_nama'] ?>
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Siswa</li>
                    <li class="active">Detail Absensi</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <a href="<?= site_url('siswa/detail_absensi_siswa/') . $this->uri->segment(3) ?>" class="btn btn-primary" style="margin-bottom: 10px"> Forum</a>
                                <a href="<?= site_url('siswa/detail_absensi_siswa_tgs/') . $this->uri->segment(3) ?>" class="btn btn-primary" style="margin-bottom: 10px"> Tugas</a>
                                <a href="<?= site_url('siswa/detail_absensi_siswa_oc/') . $this->uri->segment(3) ?>" class="btn btn-primary" style="margin-bottom: 10px"> Kelas Online</a>
                                <a href="<?= site_url('siswa/detail_absensi_siswa_kc/') . $this->uri->segment(3) ?>" class="btn btn-primary" style="margin-bottom: 10px"> Kelas Komunitas</a>
                            </div>
                            <div class="box-header" style="text-align: center;">
                                <label class="label label-primary" style="font-size: 20px;">Kelas Online</label>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php foreach ($mapel as $dtmapel) {
                                ?>
                                    <div class="col-md-4">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading"> <?= $dtmapel['nm_mapel'] ?></div>
                                            <div class="panel-body">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Tgl</th>
                                                            <th>absen/hadir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $datakc = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $dtmapel['id_pelajaran']])->row_array();
                                                        if (!empty($datakc)) {
                                                            if ($datakc['dt_kc'] !== null) {
                                                                $dt_unser = unserialize($datakc['dt_kc']);
                                                                foreach ($dt_unser as $dt_kc) { ?>
                                                                    <tr>
                                                                        <td><?= $dt_kc['tgl'] ?></td>
                                                                        <td>
                                                                            <?php
                                                                            if (($key = array_search($this->uri->segment(3), array_column($dt_kc['data'], 'nis'))) !== false) {
                                                                                echo $dt_kc['data'][$key]['absensi'];
                                                                            } else {
                                                                                echo 'Belum di Absen';
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                    </tr>
                                                        <?PHP }
                                                            } else {
                                                                echo '<tr><td colspan="4">Belum ada data</td><tr>';
                                                            }
                                                        } else {
                                                            echo '<tr><td colspan="4">Belum ada data</td><tr>';
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- <div class="panel-footer">Panel Footer</div> -->
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
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
    <!-- DataTables -->
    <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
    <!-- JS Datepicker -->
    <script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
    <!-- page script -->


    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
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
                text: "Pegawai Berhasil disimpan ke database.",
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
                text: "Pegawai berhasil di update",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
            });
        </script>
    <?php elseif ($this->session->flashdata('msg') == 'info_keluar') : ?>
        <script type="text/javascript">
            $.toast({
                heading: 'Info',
                text: "Pegawai berhasil di keluarkan",
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
                text: "Pegawai Berhasil dihapus.",
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