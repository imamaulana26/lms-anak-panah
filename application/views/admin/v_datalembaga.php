<!--Counter Inbox-->
<?php 
$query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan=$query->num_rows();
?>
<?php
$id_admin=$this->session->userdata('idadmin');
$q=$this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
$c=$q->row_array();
?>
<?php 
if ($c['pengguna_level']==2) {
  $url=base_url().'dashboard';
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
	<link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.css'?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.css'?>">
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.css'?>">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datepicker/datepicker3.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

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
          <?php if ($c['pengguna_level']==1): ?>

            <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
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

            <li class="active">
              <a href="<?php echo base_url().'datalembaga'?>">
                <i class="fa fa-building"></i> <span>Lembaga</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'satelit'?>">
                <i class="fa fa-rocket"></i> <span>Data Satelit</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            
            <li>
              <a href="<?php echo base_url().'pegawai'?>">
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
                <li><a href="<?php echo base_url().'siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
                <li><a href="<?php echo base_url().'siswa_keluar'?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
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
                <li><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
                <li><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
              </ul>
            </li>

            <li>
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-file-text"></i> <span>Kisi-Kisi</span>
                <span class="pull-right-container">
                  <small class="p pull-right bg-green"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="p pull-right bg-green"></small>
                </span>
              </a>
            </li>


            <?php else: ?>

              <li class="active">
                <a href="<?php echo base_url().'dashboard-siswa'?>">
                  <i class="fa fa-home"></i> <span>Dashboard</span>
                  <span class="pull-right-container">
                    <small class="p pull-right"></small>
                  </span>
                </a>
              </li>

              <li>
                <a href="<?php echo base_url().'keuangan-siswa'?>">
                  <i class="fa fa-calendar"></i> <span>Keuangan</span>
                  <span class="pull-right-container">
                    <small class="p pull-right"></small>
                  </span>
                </a>
              </li>


              <li>
                <a href="<?php echo base_url().'kisikisi'?>">
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
            <li >
              <a href="<?php echo base_url().'login/logout'?>" >
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
          Data Lembaga
          <small></small>
          <a id="trigermodaleditlembaga" class="btn btn-primary" style="margin-bottom: 10px" >Edit</a>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Data Lembaga</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?php $select = $this->db->get('tbl_lembaga')->row_array(); ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-body">
                <div class="col-md-12">
                  <h4>
                    <table>
                      <tr>
                        <td style="padding-right: 50px">Nama Lembaga</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['nm_lembaga'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Nomor Ijin Operasional</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['npsn'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Alamat</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['almt'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Kelurahan</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['kel'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Kecamatan</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['kec'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Kabupaten</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['kab'] ?></td>
                      </tr><tr>
                        <td style="padding-right: 50px">Provinsi</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['prov'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Kodepos</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['kode_pos'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Website</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['website'] ?></td>
                      </tr>
                      <tr>
                        <td style="padding-right: 50px">Kepala Sekolah</td>
                        <td style="padding-right: 20px">:</td>
                        <td><?= $select['kepsek'] ?></td>
                      </tr>

                    </table>
                    <!-- <p>Nomor Pokok Sekolah Nasional (NPSN) : <?= $select['npsn'] ?></p>
                    <p>Nomor Ijin Operasional: <?= $select['no_ijin'] ?></p>
                    <p>Alamat: <?= $select['almt'] ?></p>
                    <p>Kelurahan: <?= $select['kel'] ?></p>
                    <p>Kecamatan: <?= $select['kec'] ?></p>
                    <p>Kabupaten: <?= $select['kab'] ?></p>
                    <p>Provinsi: <?= $select['prov'] ?></p>
                    <p>Kodepos: <?= $select['kode_pos'] ?></p>
                    <p>website: <?= $select['website'] ?></p>
                    <p>Kepala Sekolah:<?= $select['kepsek'] ?></p> -->
                  </h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="modal fade" id="modaleditdatalembaga" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-p="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalp">Edit Data Lembaga</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url().'datalembaga/update_lembaga'?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Nama Lembaga</p>
                <div class="col-sm-7">
                  <input type="text" name="nmlembaga" class="form-control" id="inputUserName" placeholder="Nama Lembaga" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Nomor Pokok Sekolah Nasional</p>
                <div class="col-sm-7">
                  <input type="text" name="npsn" class="form-control" id="inputUserName" placeholder="NPSN" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Nomor Ijin Operasional</p>
                <div class="col-sm-7">
                  <input type="text" name="nomorijin" class="form-control" id="inputUserName" placeholder="Nomor Ijin Operasional" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Alamat</p>
                <div class="col-sm-7">
                  <input type="text" name="alamat" class="form-control" id="inputUserName" placeholder="Alamat" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Kelurahan</p>
                <div class="col-sm-7">
                  <input type="text" name="kelurahan" class="form-control" id="inputUserName" placeholder="Kelurahan" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Kecamatan</p>
                <div class="col-sm-7">
                  <input type="text" name="kecamatan" class="form-control" id="inputUserName" placeholder="Kecamatan" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Kabupaten</p>
                <div class="col-sm-7">
                  <input type="text" name="kabupaten" class="form-control" id="inputUserName" placeholder="Kabupaten" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Provinsi</p>
                <div class="col-sm-7">
                  <input type="text" name="provinsi" class="form-control" id="inputUserName" placeholder="Provinsi" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p" >Kode Pos</p>
                <div class="col-sm-7">
                  <input type="text" name="kodepos" class="form-control" id="inputUserName" placeholder="Kode Pos" required onkeypress="return checknumber()">
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Website</p>
                <div class="col-sm-7">
                  <input type="text" name="website" class="form-control" id="inputUserName" placeholder="Website" required>
                </div>
              </div>

              <div class="form-group">
                <p for="inputUserName" class="col-sm-4 control-p">Kepsek</p>
                <div class="col-sm-7">
                  <input type="text" name="kepsek" class="form-control" id="inputUserName" placeholder="Kepala Sekolah" required>
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
  <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
  <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
  <!-- JS Datepicker -->
  <script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
  <!-- page script -->
  <script>
   $( "#trigermodaleditlembaga" ).click(function() {
    // alert("Test.");
    $('#modaleditdatalembaga').modal('show');
  });
   function checknumber(){
     return event.keyCode >= 48 && event.keyCode <= 57 ;
   }
 </script>
 <script>
   $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
     "paging": true,
     "lengthChange": false,
     "searching": false,
     "ordering": true,
     "info": true,
     "autoWidth": false
   });

    $('#datepicker').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd'
   });
    $('#datepicker2').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd'
   });
    $('.datepicker3').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd'
   });
    $('.datepicker4').datepicker({
     autoclose: true,
     format: 'yyyy-mm-dd'
   });
    $(".timepicker").timepicker({
     showInputs: true
   });


  });
</script>
<?php if($this->session->flashdata('msg')=='error'):?>
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

<?php elseif($this->session->flashdata('msg')=='success'):?>
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
<?php elseif($this->session->flashdata('msg')=='info'):?>
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
<?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
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
<?php else:?>

<?php endif;?>
</body>
</html>