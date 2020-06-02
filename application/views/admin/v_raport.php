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
  <title>SEKOLAH ANAK PANAH | Raport</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, siswa-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Datepicker -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>

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

            <li>
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


            <li class="treeview active">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>E-Raport</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
                <li class="active"><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
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
           Input Nilai Pelajaran
           <small></small>
         </h1>
         <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">E-Raport</li>
          <li class="active">Tahun Ajaran</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- Left col -->
          <div class="col-md-5">
            <!-- MAP & BOX PANE -->
            <div class="box">
              <div class="box-header with-border">
                <a href="<?= site_url('mapel') ?>" class="btn btn-primary" style="margin-bottom: 10px"><i class="fa fa-fw fa-chevron-left"></i> Back</a>
                <a id="trigermodalmapel" class="btn btn-primary" style="margin-bottom: 10px" ><i class="fa fa-fw fa-plus"></i> Tambah</a>
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Tahun Ajaran</th>
                      <th>Semester</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $thn_ajaran = $this->db->select('*')->from('tbl_thn_ajaran')->order_by('id_ta', 'desc')->get()->result_array();
                    $no = 1;
                    foreach ($thn_ajaran as $ta) { $id=$ta['id_ta'];?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $ta['thn_ajaran'] ?></td>
                      <td><?= $ta['semester'] ?></td>
                      <td><a href="<?= site_url('nilai_raport/raport_siswa/').'/'.str_replace('/', '-', $ta['thn_ajaran']).'/'.$ta['semester'] ?>" class="btn btn-primary">Submit</a>
                        <!-- <a class="btn btn-primary" onclick="edit_ta('<?= $id ?>')">Edit</a> -->
                        <a class="btn btn-primary" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span> Edit</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $thn_ajaran = $this->db->select('*')->from('tbl_thn_ajaran')->order_by('id_ta', 'desc')->get()->result_array();
  $no = 1;
  foreach ($thn_ajaran as $ta) { $id=$ta['id_ta'];
  ?>
  <div class="modal fade" id="ModalEdit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Tahun Ajaran</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'nilai_raport/edit_ta'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body">    
            <input type="hidden" value="<?= $ta['thn_ajaran']  ?>" name="xta" id="ta" class="form-control" >
            <input type="hidden" name="xsms" value="<?= $ta['semester']  ?>" id="sms" class="form-control" >
            <div class="form-group">
              <div class="col-md-12">
                <label class="form-label col-md-3">Tgl. Raport Dikeluarkan</label>
                <div class="col-md-4">
                  <div class="input-group date">
                    <input type="text" class="form-control" name="tgl_dikel" value="<?= $ta['tgl_dikeluarkan']  ?>" placeholder="yyyy-mm-dd">
                    <div class="input-group-addon">
                      <span class="fa fa-fw fa-calendar"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-12">
                <label class="form-label col-md-3">Aktifkan</label>
                <div class="col-md-4">
                  <label class="radio-inline"><input type="radio" name="aktiv" value="1" <?= ($ta['aktifkan']=='1') ? 'checked' : '' ;  ?>>Ya</label>
                  <label class="radio-inline"><input type="radio" name="aktiv" value="0" <?= ($ta['aktifkan']=='1') ? '' : 'checked' ;  ?>>Tidak</label>
                </div>
              </div>
            </div>

            <!-- <input id="test" type="text" name="xta"> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
<!--Modal Edit Album-->

<div class="modal fade" id="modaltambahta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Tahun Pelajaran</h4>
      </div>
      <form class="form-horizontal" action="<?= site_url('nilai_raport/tambah_ta')?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="col-md-12">       
            <div class="form-group">
              <label>Tahun Ajaran</label>
              <input type="text" class="form-control" name="xta" placeholder="2019" maxlength="4" onkeypress="return checknumber()">
            </div>
            <div class="form-group">
              <label>Semester</label>
              <input type="text" class="form-control" name="xsms" onkeypress="return checknumber()" maxlength="1">
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

<!-- modal edit mapel -->
<div class="modal fade" id="modaleditta" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel"><label id="judul"></label></h4>
      </div>

      <form class="form-horizontal" action="<?php echo base_url().'nilai_raport/edit_ta'?>" method="post" enctype="multipart/form-data">

        <div class="modal-body">   

          <input type="hidden" name="xta" id="ta" class="form-control" >
          <input type="hidden" name="xsms" id="sms" class="form-control" >

          <div class="form-group">
            <div class="col-md-12">
              <label class="form-label col-md-3">Tgl. Raport Dikeluarkan</label>
              <div class="col-md-4">
                <div class="input-group date">
                  <input type="text" class="form-control" name="tgl_dikel" id="tgl" placeholder="yyyy-mm-dd">
                  <div class="input-group-addon">
                    <span class="fa fa-fw fa-calendar"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="form-label col-md-3">Aktifkan</label>
              <div class="col-md-4">
                <label class="radio-inline"><input type="radio" name="aktiv" value="1" >Ya</label>
                <label class="radio-inline"><input type="radio" name="aktiv" value="0" checked>Tidak</label>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
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
  $( "#trigermodalmapel" ).click(function() {
    // alert("Test.");
    $('#modaltambahta').modal('show');
  });

  function checknumber(){
   return event.keyCode >= 48 && event.keyCode <= 57 ;
 }

 function edit_ta($id){
  $.ajax({
    url: "<?= site_url('nilai_raport/update_ta') ?>"+'/'+$id,
    type: "post",
    dataType: "json",
    success: function(data){
      // alert("Test.");
      $('#modaleditta').modal('show');
      $('#judul').text('Edit Tahun Ajaran ('+data[0].thn_ajaran+')');
      $('#ta').val(data[0].thn_ajaran);
      $('#sms').val(data[0].semester);
      $('#sms').val(data[0].aktifkan);
      $('#tgl').val(data[0].tgl_dikeluarkan);
    }
  });
}

$('.input-group.date').datepicker({
  format: 'yyyy-mm-dd',
  startDate: '-0d',
  autoclose: true,
  todayHighlight: true,
  // beforeShowDay: function(date) {
  //   var hilightedDays = [16];
  //     // get current month

  //     // if date.getMonth() === currentMonth, then highlight the date
  //     if (date.getMonth() === currentMonth && ~hilightedDays.indexOf(date.getDate()) && (hilightedDays)) {
  //       return {
  //         tooltip: 'Example tooltip',
  //         classes: 'active'
  //       }
  //     }
  //   }

      // beforeShow: function() {
      //       $(this).datepicker('option', 'maxDate', $('.input-group.date').val());
      //     }

    });
  </script>

</body>
</html>
