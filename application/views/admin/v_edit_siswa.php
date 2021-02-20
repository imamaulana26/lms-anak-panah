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
  <title>SEKOLAH ANAK PANAH | Edit Siswa</title>
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

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Kesiswaan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="<?php echo base_url().'siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
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
          Edit Siswa
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Siswa</li>
          <li class="active">Edit Siswa</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <div class="row">
                  <form class="form-horizontal col-xs-12" action="<?php echo base_url().'siswa/update_siswa'?>" method="post" enctype="multipart/form-data">
                    <div class="col-md-4">
                      <h4>Siswa</h4>

                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Satelit</label>
                        <div class="col-sm-7">
                          <select name="xsatelit" class="form-control">
                            <?php $datasatelit = $this->db->get('tbl_satelit')->result_array();
                            foreach ($datasatelit as $st) {
                              $st['satelit_id'] == $satelit ? $select = 'selected' : $select = '';
                              echo "<option value=".$st['satelit_id']." ".$select.">".$st['satelit_nama']."</option>";
                            } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Nama</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnama" class="form-control" id="inputUserName" placeholder="Nama" value="<?= $nama ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Anak Ke</label>
                        <div class="col-sm-7">
                          <input type="text" name="xanke" class="form-control" id="inputUserName" placeholder="Anak Ke - "  onkeypress="return checknumber()" maxlength="1" value="<?= $anak ?>" >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-sm-4 control-label">NIK Siswa</label>
                        <div class="col-sm-7">
                          <input type="text" name="xniksiswa" class="form-control" id="inputUserName" placeholder="NIK SISWA" onkeypress="return checknumber()" value="<?= $niksiswa ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="col-sm-4 control-label">NIS</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnis" class="form-control" id="inputUserName" placeholder="NIS" onkeypress="return checknumber()" value="<?= $nis ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group">
                        <label  class="col-sm-4 control-label">NISN</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnisn" class="form-control" id="inputUserName" placeholder="NISN" onkeypress="return checknumber()" value="<?= $nisn ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Sekolah Asal</label>
                        <div class="col-sm-7">
                          <input type="text" name="xsekolahasal" class="form-control" placeholder="Sekolah Sebelumnya" value="<?= $sekolah ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">No-Telpon</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnotelpsiswa" class="form-control" placeholder="No-Telpon" value="<?= $no_telp ?>" onkeypress="return checknumber()">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tempat Lahir</label>
                        <div class="col-sm-7">
                          <input type="text" name="xtmpatlahirsiswa" class="form-control" id="inputUserName" placeholder="Tempat Lahir" value="<?= $tmpt_lahir ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                       <label class="col-sm-4 control-label">Tanggal Lahir</label>
                       <div class="col-md-6">
                        <div class="input-group date">
                          <input type="text" class="form-control" name="tgl_lahirsiswa" id="xtgl_lahir" value="<?= $tgl_lahir ?>" placeholder="yyyy-mm-dd">
                          <div class="input-group-addon">
                            <span class="fa fa-fw fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="col-sm-4 control-label">Jenis Kelamin</label>
                      <div class="col-sm-7">
                        <label class="radio radio-info radio-inline">
                          <input type="radio" id="inlineRadio1" value="L" name="xjenkel" <?= $jenkel == 'L' ? 'checked' : '' ?>>Laki-Laki</label>
                          <label class="radio radio-info radio-inline">
                            <input type="radio" id="inlineRadio1" value="P" name="xjenkel" <?= $jenkel == 'P' ? 'checked' : '' ?>>Perempuan</label>
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-4 control-label">Kelas</label>
                          <div class="col-sm-7">
                            <select name="xkelas" class="form-control">
                              <?php $datakelas = $this->db->get_where('tbl_kelas',['kelas_id <' => '19'])->result_array();
                              foreach ($datakelas as $kel) {
                                $kel['kelas_id'] == $kelas ? $select = 'selected' : $select = '';
                                echo "<option value=".$kel['kelas_id']." ".$select.">".$kel['kelas_nama']."</option>";
                              } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Photo</label>
                          <div class="col-sm-7">
                            <img id="img" src="<?= base_url('assets/filesiswa').'/'.$nis.'/'.$foto ?>" width="50px" height="50px">
                            <input name="file0" type="file" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                          </div>
                        </div>

                        <div class="form-group">
                          <label  class="col-sm-4 control-label">Agama</label>
                          <div class="col-sm-7">
                            <select name="xagama" class="form-control">
                              <?php $dataagama = $this->db->get('tbl_agama')->result_array();
                              foreach ($dataagama as $ag) {
                                $ag['agama_id'] == $agama ? $select = 'selected' : $select = '';
                                echo "<option value=".$ag['agama_id']." ".$select.">".$ag['agama_nama']."</option>";
                              } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Kewarganegaraan</label>
                          <div class="col-sm-7">
                            <label class="radio radio-info radio-inline">
                              <input type="radio" id="inlineRadio1" value="WNI" name="xkewarganegaraan" <?= $kwn == 'WNI' ? 'checked' : '' ?>>WNI</label>
                              <label class="radio radio-info radio-inline">
                                <input type="radio" id="inlineRadio1" value="WNA" name="xkewarganegaraan" <?= $kwn == 'WNA' ? 'checked' : '' ?>>WNA</label>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                              <div class="col-sm-7">
                                <textarea cols="20" rows="3" name="xalamat"><?= $alamat ?></textarea>
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                              <div class="col-sm-7">
                                <input type="text" name="xemail" class="form-control" id="inputUserName" placeholder="example@gmail.com" value="<?= $email ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputUserName" class="col-sm-4 control-label">File Siswa</label>
                              <div class="col-sm-7">
                                <input type="file" id="filePDF" name="file1" onchange="preview()">
                                <!-- <input type="button" value="Preview" onclick="preview();"> -->
                                <label>
                                  NB: Berisi dokumen lengkap siswa berupa (KTP Orang Tua, KK, Akte, Raport,Ijazah) ,file harus bertype pdf. Ukuran maksimal 2,7 MB.
                                </label>
                              </div>
                              <div class="col-md-offset-4">
                               <iframe id="viewer" src="<?= base_url('assets/filesiswa').'/'.$nis.'/'.$file ?>" frameborder="0" scrolling="no" width="300" height="200"></iframe>
                             </div>
                           </div>

                         </div>
                         <div class="col-md-4">

                          <h4>Orang Tua(Ayah)</h4>

                          <div class="form-group">
                            <label  class="col-sm-4 control-label">Nama Ayah</label>
                            <div class="col-sm-7">
                              <input type="text" name="xnamaayah" class="form-control" id="inputUserName" placeholder="Nama Ayah" value="<?= $nama_ayah ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label  class="col-sm-4 control-label">NIK</label>
                            <div class="col-sm-7">
                              <input type="text" name="xnikayah" class="form-control" id="inputUserName" placeholder="NIK"  onkeypress="return checknumber()" value="<?= $nik_ayah ?>">
                            </div>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4 control-label">Tempat Lahir</label>
                            <div class="col-sm-7">
                              <input type="text" name="xtmpayah" class="form-control" id="inputUserName" placeholder="Tempat Lahir Ayah" value="<?= $tmpt_lahir_ayah ?>" >
                            </div>
                          </div>

                          <div class="form-group">
                           <label class="col-sm-4 control-label">Tanggal Lahir</label>
                           <div class="col-md-6">
                            <div class="input-group date">
                              <input type="text" class="form-control" name="tgl_lahirayah" id="xtgl_lahir" value="<?= $tgl_lahir_ayah ?>" placeholder="yyyy-mm-dd">
                              <div class="input-group-addon">
                                <span class="fa fa-fw fa-calendar"></span>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                          <div class="col-sm-6">
                            <select name="xptayah" class="form-control" >
                              <?php $pend = array(
                                'sd' => 'SD', 'smp' => 'SMP / Sederajat', 'sma' => 'SMA / Sederajat', 'd1' => 'D1',
                                'd2' => 'D2', 'd3' => 'D3', 'd4' => 'D4', 's1' => 'S1', 's2' => 'S2', 's3' => 'S3'
                              );
                              foreach ($pend as $key => $val) {
                                $key == $pend_ayah ? $select = 'selected' : $select = '';
                                echo "<option value='".$key."' ".$select.">".$val."</option>";
                              } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Pekerjaan</label>
                          <div class="col-sm-7">
                            <input type="text" name="xkayah" class="form-control" id="inputUserName" placeholder="Pekerjaan" value="<?= $kerja_ayah ?>" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-4 control-label">Penghasilan</label>
                          <div class="col-sm-7">
                            <input type="text" name="xpnayah" class="form-control" id="inputUserName" placeholder="Penghasilan Ayah" value="<?= $gaji_ayah ?>" onkeypress="return checknumber()">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">No-Telpon</label>
                          <div class="col-sm-7">
                            <input type=text" name="xnotelpayah" value="<?= $notelp_ayah  ?>" class="form-control" placeholder="No-Telpon"  onkeypress="return checknumber()">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                          <div class="col-sm-7">
                            <input type="text" name="xemailayah" value="<?= $email_ayah  ?>" class="form-control" id="inputUserName" placeholder="example@gmail.com" required>
                          </div>
                        </div>

                        <h4>Orang Tua(Ibu)</h4>

                        <div class="form-group">
                          <label  class="col-sm-4 control-label">Nama Ibu</label>
                          <div class="col-sm-7">
                            <input type="text" name="xnamaibu" class="form-control" id="inputUserName" placeholder="Nama Ibu" value="<?= $nama_ibu ?>" >
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-sm-4 control-label">NIK</label>
                          <div class="col-sm-7">
                            <input type="text" name="xnikibu" class="form-control" id="inputUserName" placeholder="NIK"  onkeypress="return checknumber()" value="<?= $nik_ibu ?>" >
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
                          <div class="col-sm-7">
                            <input type="text" name="xtmpibu" class="form-control" id="inputUserName" value="<?= $tmpt_lahir_ibu ?>" placeholder="Tempat Lahir Ibu" >
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="col-sm-4 control-label">Tanggal Lahir</label>
                         <div class="col-md-6">
                          <div class="input-group date">
                            <input type="text" class="form-control" name="tgl_lahiribu" id="xtgl_lahir" value="<?= $tgl_lahir_ibu ?>" placeholder="yyyy-mm-dd">
                            <div class="input-group-addon">
                              <span class="fa fa-fw fa-calendar"></span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Terakhir</label>
                        <div class="col-sm-7">
                          <select name="xptibu" class="form-control" >
                            <?php $pend = array(
                              'sd' => 'SD', 'smp' => 'SMP / Sederajat', 'sma' => 'SMA / Sederajat', 'd1' => 'D1',
                              'd2' => 'D2', 'd3' => 'D3', 'd4' => 'D4', 's1' => 'S1', 's2' => 'S2', 's3' => 'S3'
                            );
                            foreach ($pend as $key => $val) {
                              $key == $pend_ibu ? $select = 'selected' : $select = '';
                              echo "<option value='".$key."' ".$select.">".$val."</option>";
                            } ?>
                          </select>
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan</label>
                        <div class="col-sm-7">
                          <input type="text" name="xkibu" class="form-control" id="inputUserName" placeholder="Pekerjaan" value="<?= $kerja_ibu ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Penghasilan</label>
                        <div class="col-sm-7">
                          <input type="text" name="xpnibu" class="form-control" id="inputUserName" placeholder="Penghasilan" value="<?= $gaji_ibu ?>" onkeypress="return checknumber()">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">No-Telpon</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnotelpibu" value="<?= $notelp_ibu ?>" class="form-control" placeholder="No-Telpon"  onkeypress="return checknumber()">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-7">
                          <input type="text" name="xemailibu" value="<?= $email_ibu ?>" class="form-control" id="inputUserName" placeholder="example@gmail.com" required>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-4">
                      <h4>Wali</h4>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Nama Wali</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnamawali" class="form-control" id="inputUserName" placeholder="Nama Wali" value="<?= $nama_wali ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">NIK</label>
                        <div class="col-sm-7">
                          <input type="text" name="xnikwali" class="form-control" id="inputUserName" placeholder="NIK"  onkeypress="return checknumber()" value="<?= $nik_wali ?>" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputUserName" class="col-sm-4 control-label">Tempat Lahir</label>
                        <div class="col-sm-7">
                          <input type="text" name="xtmpwali" class="form-control" id="inputUserName" value="<?= $tmpt_lahir_wali ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                       <label class="col-sm-4 control-label">Tanggal Lahir</label>
                       <div class="col-md-6">
                        <div class="input-group date">
                          <input type="text" class="form-control" name="tgl_lahirwali" id="xtgl_lahir" value="<?= $tgl_lahir_wali ?>" placeholder="yyyy-mm-dd">
                          <div class="input-group-addon">
                            <span class="fa fa-fw fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Pendidikan Terakhir</label>
                      <div class="col-sm-7">
                        <select name="xptwali" class="form-control" >
                        if ($pend_wali==null) {
                              echo "<option selected disabled>--Pilih-</option>";
                            }
                          <?php $pend = array(
                            'sd' => 'SD', 'smp' => 'SMP / Sederajat', 'sma' => 'SMA / Sederajat', 'd1' => 'D1',
                            'd2' => 'D2', 'd3' => 'D3', 'd4' => 'D4', 's1' => 'S1', 's2' => 'S2', 's3' => 'S3'
                          );
                          foreach ($pend as $key => $val) {
                            $key == $pend_wali ? $select = 'selected' : $select = '';
                            echo "<option value='".$key."' ".$select.">".$val."</option>";
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Pekerjaan</label>
                      <div class="col-sm-7">
                        <input type="text" name="xkwali" class="form-control" id="inputUserName" placeholder="Pekerjaan" value="<?= $kerja_wali ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Penghasilan</label>
                      <div class="col-sm-7">
                        <input type="text" name="xpnwali" class="form-control" id="inputUserName" placeholder="Penghasilan" value="<?= $gaji_wali ?>" onkeypress="return checknumber()">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">Alamat</label>
                      <div class="col-sm-8">
                        <textarea cols="20" rows="3" name="xwalialamat"><?= $alamat_wali ?></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputUserName" class="col-sm-4 control-label">No-Telpon</label>
                      <div class="col-sm-7">
                        <input type="text" name="xnotelpwali" class="form-control" placeholder="No-Telpon" value="<?= $telp_wali ?>" onkeypress="return checknumber()">
                      </div>
                    </div>

                    <div style="float: right;">
                      <a href="<?= site_url('siswa') ?>"class=" btn btn-default btn-flat" style="padding: 20px 50px 20px 50px"> Back</a>
                      <button type="submit" class=" btn btn-primary btn-flat" id="simpan" style="padding: 20px 50px 20px 50px; margin-left: 10px;">Simpan</button>
                    </div>

                  </div>
                </form>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content -->

  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
  </footer>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->
 <!--Modal movetosoftdeleted Album-->

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
  $(document).ready(function(){
    $("delete_user").click(function(){
      alert("The paragraph was clicked.");
    });
  });

  function checknumber(){
   return event.keyCode >= 48 && event.keyCode <= 57 ;
 }

 function preview() {
  file = document.getElementById("filePDF").files[0];
  file_url = URL.createObjectURL(file);
  $('#viewer').attr('src', file_url);
}

$('.input-group.date').datepicker({
  format: 'yyyy-mm-dd',
  endDate: '0d',
  autoclose: true,
  todayHighlight: true
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var table;

    table = $('#table').DataTable({
      'processing': true,
      'serverSide': true,
      'order': [],
      'ajax': {
        'url': "<?= site_url('rombel/list_rombel') ?>",
        'type': "POST"
      },
      'columnDefs': [{
        'targets': [0, -1],
        'orderable': false
      }]
    });

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
