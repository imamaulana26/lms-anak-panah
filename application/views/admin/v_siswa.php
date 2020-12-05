<!--Counter Inbox-->
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
  <title>PKBM Anak Panah | Data Siswa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, siswa-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
  <!-- Selectpicker -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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

            <li class="treeview active">
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
          Data Siswa
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Siswa</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <div class="row">
                  <div class="col-md-4">
                    <label class="control-label">Filter Kelas</label>
                    <select id="kategori" class="form-control">
                      <option selected="true" disabled="true">pilih</option>
                      <option value="all">all</option>
                      <?php
                      $list = $this->db->get('tbl_kelas')->result_array();
                      foreach ($list as $x) {
                        echo "<option value='" . $x['kelas_id'] . "'>" . $x['kelas_nama'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="col-md-6" style="float: right;">
                    <div class="box-header">
                      <a class="btn btn-success btn-flat" style="float: right;" href="<?= site_url('siswa/add_siswa') ?>"><span class="fa fa-plus"></span> Add Siswa</a>
                      <a href="<?= site_url('siswa/komunitas_class') ?>" class="btn btn-info btn-flat" style="float: right; margin-right: 20px;">Kelas Komunitas</a>
                      <a href="<?= site_url('siswa/online_class') ?>" class="btn btn-warning btn-flat" style="float: right; margin-right: 20px;">Online Class</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div>
                  <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Email</th>
                        <th>No. Telepon</th>
                        <th>Satelit</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody id="data_siswa">
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box">
                <div id="table2"> </div>
              </div>
            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.row -->
      </section>
    </div>
    <!-- /.content -->
    <div class="modal fade" id="modaleditsiswa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">x </h4>
          </div>
          <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="inputsiswaName" class="col-sm-4 control-label"></label>
                <p>Name: <input id="nama" type="text" name="siswa"></p>
                <div class="col-sm-7">
                  <h2></h2>
                </div>
                <div class="form-group">
                  <label for="inputsiswaName" class="col-sm-4 control-label">Keterangan</label>
                  <div class="col-sm-7">
                    <textarea cols="30" rows="3" name="xkeuanganket">xx</textarea>
                  </div>
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

    <div class="modal fade" id="modal_send_msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Kirim Pesan Siswa</h4>
          </div>
          <form class="form-horizontal" id="form_msg">
            <div class="modal-body">
              <input type="hidden" name="nis" id="nis">
              <div class="form-group">
                <label for="inputsiswaName" class="col-sm-4 control-label">Keterangan</label>
                <div class="col-sm-7">
                  <textarea cols="30" rows="3" name="pesan" id="pesan"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <span class="btn btn-primary btn-flat" onclick="save_form()">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
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
  <!--Modal movetosoftdeleted Album-->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
  <script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
  <!-- Selectpicker -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
  <!-- page script -->

  <script type="text/javascript">
    $(document).ready(function() {
      var table;

      table = $('#table').DataTable({
        'processing': true,
        'serverSide': true,
        'order': [],
        'ajax': {
          'url': "<?= site_url('siswa/list_siswa') ?>",
          'type': "POST"
        },
        'columnDefs': [{
          'targets': [0, -1],
          'orderable': false
        }]
      });

      $('#kategori').change(function() {
        if (!!$(this).val()) {
          table.column(2).search($(this).val()).draw();
        } else {
          table.column(2).search($(this).val()).draw();
        }
      });
    });

    function reload_table() {
      table.ajax.reload(null, false);
    }

    function delete_siswa(id, nama) {
      var del = confirm("Apakah anda yakin ingin mengeluarkan" + nama + " dari kelas?");
      if (del) {
        document.location.href = "<?= site_url('siswa/delete_siswa') ?>" + "/" + id;
      }
    }

    function destroy_datatable() {
      $("#table2").fadeOut("slow");
      $("html, body").animate({
        scrollTop: 0
      }, 500);
    }

    function send_msg(id) {
      $('#modal_send_msg').modal('show');
      $.ajax({
        url: "<?= site_url('siswa/get_siswa') ?>" + "/" + id,
        type: "get",
        dataType: "json",
        success: function(data) {
          $('#nis').val(data.siswa_nis);
        }
      });
    }

    function send_msg(id) {
      $('#modal_send_msg').modal('show');
      $.ajax({
        url: "<?= site_url('siswa/get_siswa') ?>" + "/" + id,
        type: "get",
        dataType: "json",
        success: function(data) {
          $('#nis').val(data.siswa_nis);
        }
      });
    }

    function save_form() {
      $.ajax({
        url: "<?= site_url('siswa/save_msg') ?>",
        type: "post",
        data: $('#form_msg').serialize(),
        success: function(data) {
          $('#modal_send_msg').modal('hide');
          $('#form_msg')[0].reset();
          alert('Pesan berhasil dikirim');
        }
      });
    }

    function detail_siswa(id) {
      $("#table2").fadeIn(500);
      $("html, body").animate({
        scrollTop: $("#table2").offset().top
      }, 500);
      $.ajax({
        url: "<?= site_url('siswa/detail_siswa') ?>" + '/' + id,
        type: "post",
        dataType: "json",
        success: function(data) {
          var gender;
          if (data.siswa_jenkel == 'L') {
            gender = "Laki-laki";
          } else {
            gender = "Perempuan";
          }
          const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          };
          var html = "<table class='table table-hover' id='tbl_detail'>";
          html += '<tr><td style="width:15%;"> Nama</td><td style="width:1%;">:</td><td>' + data.siswa_nama + '</td></tr>';
          html += '<tr><td id="test" style="width:15%;"> Tempat Tanggal Lahir</td><td style="width:1%;">:</td><td>' + data.siswa_tempat + ', ' + new Date(data.siswa_tgl_lahir).toLocaleDateString(undefined, options) + '</td></tr>';
          html += '<tr><td style="width:15%;"> NIS Siswa</td><td style="width:1%;">:</td><td>' + data.siswa_nis + '</td></tr>';
          html += '<tr><td style="width:15%;"> NISN Siswa</td><td style="width:1%;">:</td><td>' + data.siswa_nisn + '</td></tr>';
          html += '<tr><td style="width:15%;"> Jenis Kelamin</td><td style="width:1%;">:</td><td>' + gender + '</td></tr>';
          html += '<tr><td style="width:15%;"> Agama</td><td style="width:1%;">:</td><td>' + data.agama_nama + '</td></tr>';
          html += '<tr><td style="width:15%;"> Kewarganegaraan</td><td style="width:1%;">:</td><td>' + data.siswa_kewarganegaraan + '</td></tr>';
          html += '<tr><td style="width:15%;"> Alamat</td><td style="width:1%;">:</td><td>' + data.siswa_alamat + '</td></tr>';
          html += '<tr><td style="width:15%;"> Email</td><td style="width:1%;">:</td><td>' + data.siswa_email + '</td></tr>';
          html += '<tr><td style="width:15%;"> Nomor Telepon</td><td style="width:1%;">:</td><td>' + data.siswa_no_telp + '</td></tr>';
          html += '<tr><td style="width:15%;"> Kelas</td><td style="width:1%;">:</td><td>' + data.kelas_nama + '</td></tr>';
          html += '<tr><td style="width:15%;"> Satelit</td><td style="width:1%;">:</td><td>' + data.satelit_nama + '</td></tr>';
          html += '</table>';
          html += '<div class="box" >';
          html += "<table class='table table-striped table-bordered table-hover' >";
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> Ayah : ' + data.ayah_nama + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> Ibu : ' + data.ibu_nama + '</td>';
          html += '<td> Wali : ' + data.wali_nama + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> NIK : ' + data.ayah_nik + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> NIK : ' + data.ibu_nik + '</td>';
          html += '<td> NIK : ' + data.wali_nik + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> Pendidikan Terakhir : ' + data.ayah_pendidikan + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> Pendidikan Terakhir : ' + data.ibu_pendidikan + '</td>';
          html += '<td> Pendidikan Terakhir : ' + data.wali_pendidikan + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> Pekerjaan : ' + data.ayah_pekerjaan + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> Pekerjaan  : ' + data.ibu_pekerjaan + '</td>';
          html += '<td> Pekerjaan  : ' + data.wali_pekerjaan + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> Penghasilan : ' + data.ayah_penghasilan + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> Penghasilan : ' + data.ibu_penghasilan + '</td>';
          html += '<td> Penghasilan : ' + data.wali_penghasilan + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> No Telpon : ' + data.no_telp_ayah + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> No Telpon : ' + data.no_telp_ibu + '</td>';
          html += '<td> No Telpon : ' + data.wali_notelp + '</td>';
          html += '</tr>';
          html += '<tr>';
          html += '<td style="border-right:5px solid #ecf0f5"> Email : ' + data.email_ayah + '</td>';
          html += '<td style="border-right:5px solid #ecf0f5"> Email : ' + data.email_ibu + '</td>';
          html += '<td> <button onclick="destroy_datatable()" class="btn btn-danger btn-flat"><span class="fa fa-times"></span>Close</button></td>';
          html += '</tr>';
          html += '</table>';
          html += '</div>';
          $('#table2').html(html);
        }
      });
    }
  </script>

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
        text: "Siswa Berhasil disimpan ke database.",
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
        text: "Siswa berhasil di update",
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
        text: "Siswa berhasil di keluarkan",
        showHideTransition: 'slide',
        icon: 'info',
        hideAfter: false,
        position: 'bottom-right',
        bgColor: '#00C9E6'
      });
    </script>
  <?php else : ?>

  <?php endif; ?>
</body>

</html>