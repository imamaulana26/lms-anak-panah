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
  <title>SEKOLAH ANAK PANAH | Data Pegawai</title>
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
              <a href="<?php echo base_url() . 'jadwal' ?>">
                <i class="fa fa-calendar"></i> <span>Kalendar</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
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


          <li class="active">
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
          Data pegawai
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">pegawai</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <a id="trigeraddpegawai" class="btn btn-primary" style="margin-bottom: 10px" ><i class="fa fa-fw fa-plus"></i> Tambah</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                                <table id="example1" class="table table-striped" style="font-size:13px;">
                  <thead>
                    <tr>
                     <th>Photo</th>
                     <th>NIP</th>
                     <th>Nama</th>
                     <th>Tempat/Tgl Lahir</th>
                     <th>Jenis Kelamin</th>
                     <th>Bagian</th>
                     <th>Lokasi Dinas</th>

                     <th style="text-align:right;">Aksi</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php 
                  // $this->db->get_where('tbl_pegawai',['soft_deleted'=>0])->result_array();  
                  $this->db->select('*'); 
                  $this->db->from('tbl_pegawai'); 
                  $this->db->join('tbl_satelit','tbl_pegawai.lokasi_dinas = tbl_satelit.satelit_id','INNER');
                  $this->db->where('tbl_pegawai.soft_deleted',0); 
                  $data =  $this->db->get()->result_array();

                  ?>
                  <?php foreach ($data as $value) { $id = $value['pegawai_nip'];
                  ?>
                  <tr>
                    <?php $photo = ($value['pegawai_photo']!=null) ? "./assets/filepegawai/".$value['pegawai_nip'].'/'.$value['pegawai_photo'] : "./assets/images/user_blank.png" ; ?>
                    <td><img style="width: 50px" src="<?= $photo  ?>"></td>
                    <td><?= $value['pegawai_nip']  ?></td>
                    <td><?= $value['pegawai_nama']  ?></td>
                    <td><?= $value['pegawai_tmp_lahir'].', '. tgl_indo($value['pegawai_tgl_lahir']);?></td>
                    <td><?php $jeniskelamin = ($value['pegawai_jenkel']=='L') ? "Laki-Laki" : "Perempuan" ;echo $jeniskelamin;   ?></td>
                    <td><?= $value['pegawai_bagian']  ?></td>
                    <td><?= $value['satelit_nama']  ?></td>
                    <td style="text-align:right;">
                      <a class="btn" data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span></a>
                      <a class="btn" data-toggle="modal" data-target="#ModalDelete<?php echo $id;?>"><span class="fa fa-trash"></span></a>
                    </td>
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

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
</footer>

</div>
<!-- ./wrapper -->

<!--Modal Add Pegawai-->
<div class="modal fade" id="tambahpegawai" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Add pegawai</h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'pegawai/simpan_pegawai'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label" required>Photo</label>
            <div class="col-sm-7">
              <input type="file" name="file0"/>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">NIP</label>
            <div class="col-sm-7">
              <input type="text" name="xnip" class="form-control" id="inputUserName" placeholder="NIP" onkeypress="return checknumber()" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
            <div class="col-sm-7">
             <div class="radio radio-info radio-inline">
              <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
              <label for="inlineRadio1"> Laki-Laki </label>
            </div>
            <div class="radio radio-info radio-inline">
              <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
              <label for="inlineRadio2"> Perempuan </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
          <div class="col-sm-7">
            <input type="text" name="xtmp_lahir" class="form-control" id="inputUserName" placeholder="Tempat Lahir" required>
          </div>
        </div>

        <div class="form-group">
          <label for="inputUserName" class="col-sm-4 control-label">Tanggal Lahir</label>
          <div class="col-sm-4">
            <div class="input-group date">
              <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="yyyy-mm-dd">
              <div class="input-group-addon">
                <span class="fa fa-fw fa-calendar"></span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputUserName" class="col-sm-4 control-label">Bagian</label>
          <div class="col-sm-7">
            <input type="text" name="xbagian" class="form-control" id="inputUserName" placeholder="Contoh: Pendidik,Staff,Keamanan" required>
          </div>
        </div>

        <div class="form-group">
          <label  class="col-sm-4 control-label">Wilayah Dinas</label>
          <div class="col-sm-4">
            <select name="xsatelit" class="form-control" required>
              <option selected disabled>--Pilih--</option>
              <?php $satelit = $this->db->get('tbl_satelit')->result_array();
              foreach ($satelit as $st) {
               echo "<option value=".$st['satelit_id'].">".$st['satelit_nama']."</option>";
             } ?>
           </select>
         </div>
       </div>

       <div class="form-group">
        <label for="inputUserName" class="col-sm-4 control-label">File</label>
        <div class="col-sm-7">
          <input type="file" name="file1" required>
          NB: Berisi dokumen lengkap Pegawai berupa (CV,KTP,KK,Akte,Ijazah) ,file harus bertype pdf. Ukuran maksimal 2,7 MB.
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

<!--Modal Edit Pegawai-->
<?php $data = $this->db->get_where('tbl_pegawai',['soft_deleted'=>0])->result_array();  ?>
<?php foreach ($data as $value) { $id = $value['pegawai_nip'];
?>
<div class="modal fade" id="ModalEdit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Edit pegawai</h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'pegawai/update_pegawai'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
            <div class="col-sm-7">
              <img id="img" src="<?= base_url('assets/filepegawai').'/'.$value['pegawai_nip'].'/'.$value['pegawai_photo'] ?>" width="50px" height="50px">
              <input name="file0" type="file" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">NIP</label>
            <div class="col-sm-7">
              <input type="text" name="xnip" value="<?= $value['pegawai_nip'] ?>" class="form-control" id="inputUserName" placeholder="NIP" required readonly>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" name="xnama" value="<?= $value['pegawai_nama'] ?>" class="form-control" id="inputUserName" placeholder="Nama" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Kelamin</label>
            <div class="col-sm-7">
              <label class="radio radio-info radio-inline">
                <input type="radio" id="inlineRadio1" value="L" name="xjenkel" <?= $value['pegawai_jenkel'] == 'L' ? 'checked' : '' ?>>Laki-Laki</label>
                <label class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="P" name="xjenkel" <?= $value['pegawai_jenkel'] == 'P' ? 'checked' : '' ?>>Perempuan</label>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
                <div class="col-sm-7">
                  <input type="text" name="xtmp_lahir"  value="<?= $value['pegawai_tmp_lahir'] ?>" class="form-control" id="inputUserName" placeholder="Tempat Lahir" required>
                </div>
              </div>

              <div class="form-group">
               <label class="col-sm-4 control-label">Tanggal Lahir</label>
               <div class="col-md-6">
                <div class="input-group date">
                  <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?= $value['pegawai_tgl_lahir'] ?>" placeholder="yyyy-mm-dd">
                  <div class="input-group-addon">
                    <span class="fa fa-fw fa-calendar"></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">Bagian</label>
              <div class="col-sm-7">
                <input type="text" name="xbagian" value="<?= $value['pegawai_bagian'] ?>" class="form-control" id="inputUserName" placeholder="Contoh: Pendidik,Staff,Keamanan" required>
              </div>
            </div>

            <div class="form-group">
              <label  class="col-sm-4 control-label">Satelit</label>
              <div class="col-sm-7">
                <select name="xsatelit" class="form-control">
                  <?php $datasatelit = $this->db->get('tbl_satelit')->result_array();
                  foreach ($datasatelit as $st) {
                    $st['satelit_id'] == $value['lokasi_dinas'] ? $select = 'selected' : $select = '';
                    echo "<option value=".$st['satelit_id']." ".$select.">".$st['satelit_nama']."</option>";
                  } ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputUserName" class="col-sm-4 control-label">File Pegawai</label>
              <div class="col-sm-7">
                <input type="file" id="filePDF" name="file1">
                <!-- <input type="button" value="Preview" onclick="preview();"> -->
                <label>
                  NB: Berisi dokumen lengkap Pegawai berupa (CV,KTP,KK,Akte,Ijazah) ,file harus bertype pdf. Ukuran maksimal 2,7 MB.
                </label>
              </div>
              <div class="col-md-offset-4">
                <iframe src="<?= base_url('assets/filepegawai').'/'.$value['pegawai_nip'].'/'.$value['pegawai_file'] ?>" frameborder="0" scrolling="no" width="300" height="200"></iframe>
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
<?php } ?>

<!--Modal Hapu Pegawai-->
<?php $data = $this->db->get_where('tbl_pegawai',['soft_deleted'=>0])->result_array();  ?>
<?php foreach ($data as $value) { $id = $value['pegawai_nip'];
?>
<div class="modal fade" id="ModalDelete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus pegawai <?= $value['pegawai_nama'] ?></h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'pegawai/delete_pegawai'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input name="xnip" type="hidden" value="<?= $value['pegawai_nip']  ?>">
          <label><h4>Apakah Anda Yakin?? Data Terkait Pegawai Akan Di Hapus</h4></label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-danger btn-flat" id="simpan">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

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

  function checknumber(){
   return event.keyCode >= 48 && event.keyCode <= 57 ;
 }


    // $.fn.datepicker.dates['en'] = {
    //   days: ["Minggu", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    //   daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    //   daysMin: ["Mi", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    //   months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    //   monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //   today: "Today",
    //   clear: "Clear",
    //   format: "mm/dd/yyyy",
    //   titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    //   weekStart: 0
    // };

    $( "#trigeraddpegawai" ).click(function() {
    // alert("Test.");
    $('#tambahpegawai').modal('show');
  });

    $('.input-group.date').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true,
      todayHighlight: true,
      startView : 'year',
      // language: 'en',
    // beforeShowYear: true,

  });

    function delete_pegawai(id, nama){
      var del = confirm("Apakah anda yakin ingin menghapus semua data terkait pegawai "+nama+" ?");
      if (del){
        document.location.href = "<?= site_url('pegawai/delete_pegawai') ?>"+"/"+id;
      }
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
          text: "Pegawai Berhasil disimpan ke database.",
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
            text: "Pegawai berhasil di update",
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
              text: "Pegawai berhasil di keluarkan",
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
                text: "Pegawai Berhasil dihapus.",
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
