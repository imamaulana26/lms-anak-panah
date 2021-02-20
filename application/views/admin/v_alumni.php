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
  <title>SEKOLAH ANAK PANAH | Data Alumni</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
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
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Menu Utama</li>
          <li>
            <a href="<?php echo base_url().'admin/dashboard'?>">
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
          <li class="treeview">
            <a href="#">
              <i class="fa fa-university"></i>
              <span>Lembaga</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url().'admin/datalembaga'?>"><i class="fa fa-clone"></i> Data Lembaga</a></li>
              <li><a href="<?php echo base_url().'admin/yayasan'?>"><i class="fa fa-building-o"></i> Yayasan</a></li>
              <li><a href="<?php echo base_url().'admin/periodik'?>"><i class="fa fa-picture-o"></i> Periodik</a></li>
              <li><a href="<?php echo base_url().'admin/bantuan'?>"><i class="fa fa-money"></i> Bantuan</a></li>
              <li><a href="<?php echo base_url().'admin/layanan'?>"><i class="fa fa-picture-o"></i> Layanan</a></li>
            </ul>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-users"></i> <span>Sarana Prasarana</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>
          <li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Pendidik/Tendik (PTK)</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'admin/guru'?>"><i class="fa fa-clone"></i> PTK</a></li>
                <li><a href="<?php echo base_url().'admin/guru_keluar'?>"><i class="fa fa-picture-o"></i> PTK Keluar</a></li>
              </ul>
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
                <li><a href="<?php echo base_url().'admin/siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
                <li><a href="<?php echo base_url().'admin/siswa_keluar'?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>

              </ul>
            </li>

            <li>
              <a href="<?php echo base_url().'admin/rombel'?>">
                <i class="fa fa-calendar"></i> <span>Kelas</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Evaluasi</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-clone"></i> Raport Sebelumnya</a></li>
                <li><a href="<?php echo base_url().'admin/galeri'?>"><i class="fa fa-picture-o"></i> Evaluasi</a></li>
              </ul>
            </li>
            <li class="active">
              <a href="<?php echo base_url().'admin/pengumuman'?>">
                <i class="fa fa-volume-up"></i> <span>Alumni</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'admin/instrumen'?>">
                <i class="fa fa-envelope"></i> <span>Instrumen</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>
            <li >
              <a href="<?php echo base_url().'admin/keuangan'?>">
                <i class="fa fa-envelope"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>

            <li >
              <a href="<?php echo base_url().'login/logout'?>" style="bottom: <?php 
              if ($c['pengguna_level']==1) {
                echo "auto;";
              }else{
                echo "400px;";
              } 
              ?>;">
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

              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-striped" style="font-size:13px;">
                    <thead>
                      <tr>
                       <th>Photo</th>
                       <th>NIS</th>
                       <th>NISN</th>
                       <th>Nama</th>
                       <th>Jenis Kelamin</th>
   
                       <th style="text-align:right;">Aksi</th> 
                     </tr>
                   </thead>
                   <tbody>
                    <?php
                    $no=0;
                    foreach ($data->result_array() as $i) :
                      $no++;
                      $id=$i['siswa_id'];
                      $nis=$i['siswa_nis'];
                      $nisn=$i['siswa_nisn'];
                      $nama=$i['siswa_nama'];
                      $jenkel=$i['siswa_jenkel'];
                      $kelas_id=$i['siswa_kelas_id'];
      
                      $photo=$i['siswa_photo'];

                      ?>
                      <tr>
                        <?php if(empty($photo)):?>
                          <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/user_blank.png';?>"></td>
                          <?php else:?>
                            <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/'.$photo;?>"></td>
                          <?php endif;?>
                          <td><?php echo $nis;?></td>
                          <td><?php echo $nisn;?></td>
                          <td><?php echo $nama;?></td>
                          <?php if($jenkel=='L'):?>
                            <td>Laki-Laki</td>
                            <?php else:?>
                              <td>Perempuan</td>
                            <?php endif;?>
              
                            <td style="text-align:right;">
                              <a class="btn" data-toggle="modal" data-target="#ModalDetail<?php echo $id;?>"><span class="fa fa-info"></span></a>
                              <a class="btn" data-toggle="modal" data-target="#ModalPDkeluar<?php echo $id;?>"><span class="fa fa-trash"></span></a>
                            </td>
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
          <strong>Copyright &copy; 2017 <a href="http://mfikri.com">M Fikri Setiadi</a>.</strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
          <!-- Create the tabs -->
          <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
          </ul>
          <!-- Tab panes -->
          <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
              <h3 class="control-sidebar-heading">Recent Activity</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                      <p>Will be 23 on April 24th</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-user bg-yellow"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                      <p>New phone +1(800)555-1234</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                      <p>nora@example.com</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                      <p>Execution time 5 seconds</p>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

              <h3 class="control-sidebar-heading">Tasks Progress</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Custom Template Design
                      <span class="label label-danger pull-right">70%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Update Resume
                      <span class="label label-success pull-right">95%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Laravel Integration
                      <span class="label label-warning pull-right">50%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)">
                    <h4 class="control-sidebar-subheading">
                      Back End Framework
                      <span class="label label-primary pull-right">68%</span>
                    </h4>

                    <div class="progress progress-xxs">
                      <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                    </div>
                  </a>
                </li>
              </ul>
              <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
              <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Report panel usage
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Some information about this general settings option
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Allow mail redirect
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Other sets of options are available
                  </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Expose author name in posts
                    <input type="checkbox" class="pull-right" checked>
                  </label>

                  <p>
                    Allow the user to show his name in blog posts
                  </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Show me as online
                    <input type="checkbox" class="pull-right" checked>
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Turn off notifications
                    <input type="checkbox" class="pull-right">
                  </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                  <label class="control-sidebar-subheading">
                    Delete chat history
                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                  </label>
                </div>
                <!-- /.form-group -->
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
        </aside>
        <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->
 <!--Modal Detail Siswa-->
 <?php foreach ($data->result_array() as $i) :
  $id=$i['siswa_id'];
  $nis=$i['siswa_nis'];
  $nisn=$i['siswa_nisn'];
  $nama=$i['siswa_nama'];
  $agama=$i['siswa_agama'];
  $notelp=$i['siswa_no_telp'];
  $kewarganegaraan=$i['siswa_kewarganegaraan'];
  $alamat=$i['siswa_alamat'];
  $jenkel=$i['siswa_jenkel'];
  $photo=$i['siswa_photo'];
  $email=$i['siswa_email'];
  $dokumen=$i['siswa_dokumen'];
  $namaayah=$i['ayah_nama'];
  $nikayah=$i['ayah_nik'];
  $ttlayah=$i['ayah_ttl'];
  $pendidikanayah=$i['ayah_pendidikan'];
  $pekerjaanayah=$i['ayah_pekerjaan'];
  $penghasilanayah=$i['ayah_penghasilan'];
  $dokumenayah=$i['ayah_dokumen'];
  $namaibu=$i['ibu_nama'];
  $nikibu=$i['ibu_nik'];
  $ttlibu=$i['ibu_ttl'];
  $pekerjaanibu=$i['ibu_pekerjaan'];
  $pendidikanibu=$i['ibu_pendidikan'];
  $penghasilanibu=$i['ibu_penghasilan'];
  $dokumenibu=$i['ibu_dokumen'];
  $namawali=$i['wali_nama'];
  $nikwali=$i['wali_nik'];
  $ttlwali=$i['wali_ttl'];
  $pendidikanwali=$i['wali_pendidikan'];
  $pekerjaanwali=$i['wali_pekerjaan'];
  $penghasilanwali=$i['wali_penghasilan'];
  ?>
  
  <div class="modal fade" id="ModalDetail<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel">Detail Siswa</h4>
        </div>
        <form class="form-horizontal" action="<?php echo base_url().'admin/siswa/update_siswa'?>" method="post" enctype="multipart/form-data">
          <div class="modal-body" style=" max-height: calc(100vh - 200px);
          overflow-y: auto;">
          <h4>Siswa</h4>
          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
            <div class="col-sm-7">
              <?php if(empty($photo)):?>
                <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/user_blank.png';?>"></td>
                <?php else:?>
                  <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/'.$photo;?>"></td>
                <?php endif;?>
              </div>
            </div>  

            <div class="form-group" style="pointer-events: none;">
              <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
              <div class="col-sm-7">
                <input type="label" value="<?php echo $nama;?>" class="form-control"  placeholder="Nama" required>
              </div>
            </div>
            <div class="form-group" style="pointer-events: none;">
              <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
              <div class="col-sm-7">
                <?php if($jenkel=='L'):?>
                 <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                  <label for="inlineRadio1"> Laki-Laki </label>
                </div>
                <div class="radio radio-info radio-inline">
                  <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                  <label for="inlineRadio2"> Perempuan </label>
                </div>
                <?php else:?>
                  <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="L" name="xjenkel">
                    <label for="inlineRadio1"> Laki-Laki </label>
                  </div>
                  <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="P" name="xjenkel" checked>
                    <label for="inlineRadio2"> Perempuan </label>
                  </div>
                <?php endif;?>
              </div>
            </div>
            <div class="form-group" style="pointer-events: none;">
              <label class="col-sm-4 control-label">Kelas</label>
              <div class="col-sm-7">
                <h5>Alumni</h5>
                  </select>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">NIS</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $nis;?>" class="form-control"  placeholder="NIS" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label  class="col-sm-4 control-label">NISN</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $nisn;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label  class="col-sm-4 control-label">Agama</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $agama;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>

              <div class="form-group" style="pointer-events: none;">
                <label for="inputUserName" class="col-sm-4 control-label">Kewarganegaraan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $kewarganegaraan;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Alamat</label>
                <div class="col-sm-7">
                  <textarea class="form-control" rows="3"  ><?php echo $alamat;?></textarea>
                </div>
              </div>

              <div class="form-group" style="pointer-events: none;">
                <label for="inputUserName" class="col-sm-4 control-label">email</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $email;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <!-- TEMPAT DOKUMEN -->
              <h4>Orang Tua</h4>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Nama Ayah</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $namaayah;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">NIK</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $nikayah;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Tempat Tanggal Lahir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $ttlayah;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pendidikanayah;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pekerjaan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pekerjaanayah;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Penghasilan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pekerjaanayah;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <!-- DOKUMEN -->
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Nama Ibu</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $namaibu;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">NIK</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $nikibu;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Tempat Tanggal Lahir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $ttlibu;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pendidikanibu;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pekerjaan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pekerjaanibu;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Penghasilan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $penghasilanibu;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <h4>Wali</h4>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Nama Wali</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $namawali;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">NIK</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $nikwali;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Tempat Tanggal Lahir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $ttlwali;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pendidikanwali;?>" class="form-control" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Pekerjaan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $pekerjaanwali;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
              <div class="form-group" style="pointer-events: none;">
                <label class="col-sm-4 control-label">Penghasilan</label>
                <div class="col-sm-7">
                  <input type="label" value="<?php echo $penghasilanwali;?>" class="form-control"  placeholder="NISN" required>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="background-color: white;">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach;?>
<!--Modal Detail Album-->
  <!--Modal movetosoftdeleted Album-->
  <?php foreach ($data->result_array() as $i) :
    $id=$i['siswa_id'];
    $nis=$i['siswa_nis'];
    $nisn=$i['siswa_nisn'];
    $nama=$i['siswa_nama'];
    $jenkel=$i['siswa_jenkel'];
    $kelas_id=$i['siswa_kelas_id'];
    $photo=$i['siswa_photo'];
    ?>

    <div class="modal fade" id="ModalPDkeluar<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
            <h4 class="modal-title" id="myModalLabel">Keluarkan Siswa</h4>
          </div>
          <form class="form-horizontal" action="<?php echo base_url().'admin/siswa/update_siswa_keluar'?>" method="post" enctype="multipart/form-data">
            <div class="modal-body">       
              <input type="hidden" name="kode" value="<?php echo $id;?>"/> 
              <input type="hidden" value="<?php echo $photo;?>" name="gambar">
              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">NIP</label>
                <div class="col-sm-7">
                  <input type="text" name="xnis" value="<?php echo $nis;?>" class="form-control" id="inputUserName" placeholder="NIP" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
                <div class="col-sm-7">
                  <input type="text" name="xnama" value="<?php echo $nama;?>" class="form-control" id="inputUserName" placeholder="Nama" required>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Jenis Kelamin</label>
                <div class="col-sm-7">
                  <?php if($jenkel=='L'):?>
                   <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="L" name="xjenkel" checked>
                    <label for="inlineRadio1"> Laki-Laki </label>
                  </div>
                  <div class="radio radio-info radio-inline">
                    <input type="radio" id="inlineRadio1" value="P" name="xjenkel">
                    <label for="inlineRadio2"> Perempuan </label>
                  </div>
                  <?php else:?>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="L" name="xjenkel">
                      <label for="inlineRadio1"> Laki-Laki </label>
                    </div>
                    <div class="radio radio-info radio-inline">
                      <input type="radio" id="inlineRadio1" value="P" name="xjenkel" checked>
                      <label for="inlineRadio2"> Perempuan </label>
                    </div>
                  <?php endif;?>
                </div>
              </div>

              <div class="form-group">
                <label for="inputUserName" class="col-sm-4 control-label">Kelas</label>
                <div class="col-sm-7">
                  <select name="xkelas" class="form-control" required>
                    <option value="">-Pilih-</option>
                    <?php
                    foreach ($kelas->result_array() as $k) {
                      $id_kelas=$k['kelas_id'];
                      $nm_kelas=$k['kelas_nama'];

                      ?>
                      <?php if($id_kelas==$kelas_id):?>
                        <option value="<?php echo $id_kelas;?>" selected><?php echo $nm_kelas;?></option>
                        <?php else:?>
                          <option value="<?php echo $id_kelas;?>"><?php echo $nm_kelas;?></option>
                        <?php endif;?>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                  <div class="col-sm-7">
                    <?php if(empty($photo)):?>
                      <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/user_blank.png';?>"></td>
                      <?php else:?>
                        <td><img width="40" height="40" class="img-circle" src="<?php echo base_url().'assets/images/'.$photo;?>"></td>
                      <?php endif;?>
                    </div>
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
                  <button type="submit" class="btn btn-primary btn-flat" id="simpan">Ya</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach;?>
      <!-- end to move to soft deleted -->


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
      <!-- page script -->
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
              text: "Siswa Berhasil disimpan ke database.",
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
            <?php elseif($this->session->flashdata('msg')=='success-hapus'):?>
              <script type="text/javascript">
                $.toast({
                  heading: 'Success',
                  text: "Siswa Berhasil dihapus.",
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
