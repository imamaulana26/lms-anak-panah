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
  <title>SEKOLAH ANAK PANAH | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- Ionicons -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">

</head>

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

            <li class="active">
              <a href="<?php echo base_url() . 'dashboard' ?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
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
          Dashboard
          <small></small>
          <a class="btn btn-danger btn-flat" id="trigerpengumuman"><span class="fa fa-plus"></span> Buat Pengumuman</a>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>

        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-graduation-cap"></i></span>
              <div class="info-box-content">
                <?php $alumnisd = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => 16])->num_rows();
                $alumnismp = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => 17])->num_rows();
                $alumnisma = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => 18])->num_rows();
                ?>
                <p style="font-size: 32px"><?= $alumnisd + $alumnismp + $alumnisma ?></p>
                <p>Jumlah Alumni</p>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-red"><i class="fa fa-fw fa-users"></i></span>
              <div class="info-box-content">
                <?php $siswa = $this->db->get_where('tbl_siswa', ['siswa_kelas_id <' => 16, 'soft_deleted' => 0])->num_rows(); ?>
                <p style="font-size: 32px"><?= $siswa ?></p>
                <p>Jumlah Siswa Aktif</p>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix visible-sm-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-fw fa-user"></i></span>
              <div class="info-box-content">
                <?php $pegawai = $this->db->get_where('tbl_pegawai', ['soft_deleted' => 0])->num_rows(); ?>
                <p style="font-size: 32px"><?= $pegawai ?></p>
                <p>Jumlah Pegawai</p>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-yellow">#</span>
              <div class="info-box-content">
                <?php $last_nis = $this->db->query("select * from tbl_siswa order by siswa_nis desc limit 1")->row_array(); ?>
                <p style="font-size: 32px"><?= $last_nis['siswa_nis'] ?></p>
                <p>NIS Terakhir</p>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Rincian Murid Aktif</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#siswa">Siswa</a></li>
                      <li><a data-toggle="tab" href="#satelit">Satelit</a></li>
                      <li><a data-toggle="tab" href="#datasatelit">Data Satelit</a></li>
                    </ul>

                    <div class="panel panel-default">
                      <div class="panel-body">
                        <div class="tab-content">

                          <div id="siswa" class="tab-pane fade in active">
                            <?php $sql = "select count(a.siswa_nis) as jumlah, b.kelas_nama from tbl_siswa a inner join tbl_kelas b on a.siswa_kelas_id = b.kelas_id where b.kelas_id != 19 and a.soft_deleted=0 group by b.kelas_id";
                            $dt = $this->db->query($sql)->result_array();
                            $no = 1; ?>
                            <div class="row">
                              <div class="col-md-4">
                                <table class="table table-bordered table-hover table-stripped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Kelas</th>
                                      <th>Jumlah Siswa</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($dt as $val) { ?>
                                      <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="<?= site_url('siswa') ?>"><?= $val['kelas_nama'] ?></a></td>
                                        <td><?= $val['jumlah'] ?> Siswa</td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <div id="satelit" class="tab-pane fade">
                            <?php $sql1 = "select count(a.siswa_nis) as jumlah, b.satelit_nama from tbl_siswa a inner join tbl_satelit b on a.satelit = b.satelit_id where a.siswa_kelas_id != 16 and a.soft_deleted=0 group by b.satelit_id";
                            $dts = $this->db->query($sql1)->result_array();
                            $no = 1; ?>

                            <div class="row">
                              <div class="col-md-4">
                                <table class="table table-bordered table-hover table-stripped">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Satelit</th>
                                      <th>Jumlah Siswa</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($dts as $val1) { ?>
                                      <tr>
                                        <td><?= $no++ ?></td>
                                        <td><a href="<?= site_url('satelit') ?>"><?= $val1['satelit_nama'] ?></a>
                                        </td>
                                        <td><?= $val1['jumlah'] ?> Siswa</td>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>


                          <div id="datasatelit" class="tab-pane fade">
                            <?php $sql2 = "select * from tbl_satelit";
                            $dtl = $this->db->query($sql2)->result_array();
                            $no = 1; ?>
                            <div class="row">
                              <table id="table" class="table table-bordered table-hover table-stripped">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Cabang</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Email</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($dtl as $val2) { ?>
                                    <tr>
                                      <td><?= $no++ ?></td>
                                      <td><a href="<?= site_url('satelit') ?>"><?= $val2['satelit_nama'] ?></a></td>
                                      <td><?= $val2['satelit_pic'] ?></td>
                                      <td><?= $val2['satelit_alamat'] ?></td>
                                      <td><?= $val2['satelit_notelp'] ?></td>
                                      <td><?= $val2['satelit_email'] ?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.col -->

                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./box-body -->

              <!-- /.box-footer -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- MODAL PENGUMUMAN -->
    <div class="modal fade" id="tambahpengumuman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Buat Pengumuman</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url() . 'dashboard/pengumuman' ?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <?php $pengumuman = $this->db->get('tbl_pengumuman')->row_array(); ?>
              <div class="form-group">
                <label class="col-sm-2 control-label">Aktifkan</label>
                <div class="col-sm-10">
                  <label class="radio-inline"><input type="radio" name="aktiv" value="1" <?= ($pengumuman['aktifkan'] == '1') ? 'checked' : '';  ?>>Ya</label>
                  <label class="radio-inline"><input type="radio" name="aktiv" value="0" <?= ($pengumuman['aktifkan'] == '1') ? '' : 'checked';  ?>>Tidak</label>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-7">
                  <textarea name="pengumuman" cols="65" rows="10"><?= $pengumuman['pengumuman_deskripsi']  ?></textarea>
                </div>
              </div>


              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>


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
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url() . 'assets/plugins/sparkline/jquery.sparkline.min.js' ?>"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- ChartJS 1.0.1 -->
  <script src="<?php echo base_url() . 'assets/plugins/chartjs/Chart.min.js' ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url() . 'assets/dist/js/pages/dashboard2.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>

  <script>
    $("#trigerpengumuman").click(function() {
      $('#tambahpengumuman').modal('show');
    });
  </script>

  <script>
    var lineChartData = {
      labels: <?php echo json_encode($bulan); ?>,
      datasets: [

        {
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(152,235,239,1)",
          data: <?php echo json_encode($value); ?>
        }

      ]

    }

    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

    var canvas = new Chart(myLine).Line(lineChartData, {
      scaleShowGridLines: true,
      scaleGridLineColor: "rgba(0,0,0,.005)",
      scaleGridLineWidth: 0,
      scaleShowHorizontalLines: true,
      scaleShowVerticalLines: true,
      bezierCurve: true,
      bezierCurveTension: 0.4,
      pointDot: true,
      pointDotRadius: 4,
      pointDotStrokeWidth: 1,
      pointHitDetectionRadius: 2,
      datasetStroke: true,
      tooltipCornerRadius: 2,
      datasetStrokeWidth: 2,
      datasetFill: true,
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      responsive: true
    });
  </script>

</body>

</html>