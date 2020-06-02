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
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SEKOLAH ANAK PANAH | Inbox</title>
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

          <li class="active">
            <a href="<?php echo base_url().'dashboard'?>">
              <i class="fa fa-home"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url().'datalembaga'?>">
              <i class="fa fa-home"></i> <span>Lembaga</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url().'satelit'?>">
              <i class="fa fa-users"></i> <span>Data Satelit</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>


          <li>
            <a href="<?php echo base_url().'pegawai'?>">
              <i class="fa fa-users"></i>
              <span>pegawai</span>
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
              <li><a href="<?php echo base_url().'siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
              <li><a href="<?php echo base_url().'siswa_keluar'?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
            </ul>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>E-Raport</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-clone"></i> Mapel</a></li>
              <li><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-picture-o"></i> Nilai Raport</a></li>
            </ul>
          </li>

          <li>
            <a href="<?php echo base_url().'kisikisi'?>">
              <i class="fa fa-envelope"></i> <span>kisi-Kisi</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green"></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url().'keuangan'?>">
              <i class="fa fa-envelope"></i> <span>Keuangan</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green"></small>
              </span>
            </a>
          </li>


          <?php else: ?>
           <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'biodata'?>">
                <i class="fa fa-newspaper-o"></i> <span>Biodata</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan_siswa'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>


            <li>
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-file-text"></i> <span>Kisi - Kisi</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'evaluasi'?>">
                <i class="fa fa-files-o"></i> <span>Evaluasi</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li class="active">
              <a href="<?php echo base_url().'inbox'?>">
                <i class="fa fa-envelope-o"></i> <span>Inbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

        <?php endif ?>
        <li >
          <a href="<?php echo base_url().'login/logout'?>" >
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
        Inbox
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <div class="box">
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-striped" style="font-size:12px;">
                  <thead>
                    <tr>
                     <th width="10px">#</th>
                     <th width="10%">Tanggal</th>
                     <th>Pesan</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  $no = 1;
                  foreach ($inbox->result_array() as $i) :
                    $arr = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                    $exp = explode(' ', $i['inbox_tanggal']);
                    $tgl = explode('-', $exp[0]);
                    $bln = substr($tgl[1], -1) > 0 ? $arr[substr($tgl[1], -1)] : $arr[$tgl[1]];
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $tgl[2].' '.$bln.' '.$tgl[0].'<br>'.$exp[1] ?></td>
                      <td><?= '<b>From : '.$i['inbox_nama'].'</b><br>'.$i['inbox_pesan'] ?></td>
                    </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
<script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/datepicker/bootstrap-datepicker.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/timepicker/bootstrap-timepicker.min.js'?>"></script>
<script src="<?php echo base_url().'assets/plugins/daterangepicker/daterangepicker.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>
<!-- page script -->
<script>
  $("#example1").DataTable();
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

  <?php elseif($this->session->flashdata('msg')=='info'):?>
    <script type="text/javascript">
      $.toast({
        heading: 'Info',
        text: "Agenda berhasil di update",
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
          text: "Pesan Berhasil dihapus.",
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