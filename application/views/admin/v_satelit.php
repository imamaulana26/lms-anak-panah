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
  <title>SEKOLAH ANAK PANAH | Data Satelit</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Ionicons -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">

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
          <?php if ($c['pengguna_level']==1): ?>

            <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'datalembaga'?>">
                <i class="fa fa-building"></i> <span>Lembaga</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li class="active">
              <a href="<?php echo base_url().'satelit'?>">
                <i class="fa fa-rocket"></i> <span>Data Satelit</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            
            <li>
              <a href="<?php echo base_url().'pegawai'?>">
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
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>


            <?php else: ?>

              <li class="active">
                <a href="<?php echo base_url().'dashboard-siswa'?>">
                  <i class="fa fa-home"></i> <span>Dashboard</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>

              <li>
                <a href="<?php echo base_url().'keuangan-siswa'?>">
                  <i class="fa fa-calendar"></i> <span>Keuangan</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>


              <li>
                <a href="<?php echo base_url().'kisikisi'?>">
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
            Data Satelit PKBM Anak Panah
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Data Satelit</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

                <div class="box-header">

                  <form action="<?= site_url('satelit/list_siswa')?>" method="post" class="form-horizontal">
                    <div class="col-md-6">
                      <div class="form-group col-md-6">
                        <select name="satelit" class="form-control">
                          <option selected="true" disabled="true">-- Pilih Satelit --</option>
                          <?php $satelit = $this->db->get('tbl_satelit')->result_array();
                          foreach ($satelit as $stlt) {
                           echo "<option value='".$stlt['satelit_id']."'>".$stlt['satelit_nama']."</option>";
                         } ?>
                       </select>
                     </div>
                     <button type="submit" class="btn btn-default" style="margin-left: 10px"><i class="fa fa-fw fa-search"></i> Search</button>
                   </div>
                 </form>

                 <div class="col-md-2" style="float: right;">
                  <div class="box-header">
                    <a class="btn btn-success btn-flat" style="float: right;" id="trigersatelit"><span class="fa fa-plus"></span> Tambah Satelit</a>
                  </div>   
                </div>

              </div>
              <!-- /.box-header -->

              <div class="box-body">
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 15px">No</th>
                      <th>NIS</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Email</th>
                      <th>No. Telepon</th>
                      <th>Satelit</th>
                    </tr>
                  </thead>
                  <tbody >
                    <?php $no = 1;
                    foreach ($siswa as $li) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $li['siswa_nis'] ?></td>
                        <td><?= $li['siswa_nisn'] ?></td>
                        <td><?= $li['siswa_nama'] ?></td>
                        <td><?= $li['kelas_nama'] ?></td>
                        <td><?= $li['siswa_email'] ?></td>
                        <td><?= $li['siswa_no_telp'] ?></td>
                        <td><?= $li['satelit_nama'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
     <div class="modal fade" id="tambasatelit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah Satelit</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url().'satelit/tambah_satelit'?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">   

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Nama Satelit</label>
                <div class="col-sm-7">
                  <input type="text" name="xsatelit" class="form-control" id="inputUserName" placeholder="Isikan Satelit Baru" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Penanggung Jawab</label>
                <div class="col-sm-7">
                  <input type="text" name="xpicsatelit" class="form-control" id="inputUserName" placeholder="PIC" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                <div class="col-sm-7">
                  <input type="text" name="xalamatsatelit" class="form-control" id="inputUserName" placeholder="Isikan Alamat Satelit" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">No telp</label>
                <div class="col-sm-7">
                  <input type="text" name="xnotelpsatelit" class="form-control" placeholder="No-Telpon"  onkeypress="return checknumber()" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-7">
                  <input type="text" name="xemailsatelit" class="form-control" id="inputUserName" placeholder="Isikan Email Satelit" required>
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
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

  <script>
    $(document).ready(function(){
      $('#table').DataTable();
    });

    $( "#trigersatelit" ).click(function() {
    // alert("Test.");
    $('#tambasatelit').modal('show');
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
        text: "Data Satelit Berhasil Ditambahkan.",
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
          text: "Siswa berhasil di update",
          showHideTransition: 'slide',
          icon: 'info',
          hideAfter: false,
          position: 'bottom-right',
          bgColor: '#00C9E6'
        });
      </script>
      <?php elseif($this->session->flashdata('msg')=='info_keluar'):?>
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
        <?php else:?>

        <?php endif;?>

      </body>
      </html>
