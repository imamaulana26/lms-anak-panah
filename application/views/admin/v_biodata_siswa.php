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
if ($c['pengguna_level']==1) {
  $url=base_url().'dashboard';
  header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  exit();
          // die();
};

$arr = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SEKOLAH ANAK PANAH | Biodata Siswa</title>
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
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Menu Utama</li>
        <?php if ($c['pengguna_level']==1): ?>

          <li class="active">
            <a href="<?php echo base_url().'dashboard-admin'?>">
              <i class="fa fa-home"></i> <span>Dashboard</span>
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
              <li><a href="<?php echo base_url().'datalembaga'?>"><i class="fa fa-clone"></i> Data Lembaga</a></li>
              <li><a href="<?php echo base_url().'yayasan'?>"><i class="fa fa-building-o"></i> Yayasan</a></li>
              <li><a href="<?php echo base_url().'periodik'?>"><i class="fa fa-picture-o"></i> Periodik</a></li>
              <li><a href="<?php echo base_url().'bantuan'?>"><i class="fa fa-money"></i> Bantuan</a></li>
              <li><a href="<?php echo base_url().'layanan'?>"><i class="fa fa-picture-o"></i> Layanan</a></li>
            </ul>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-users"></i> <span>Sarana Prasarana</span>
              <span class="pull-right-container">
                <small class="p pull-right"></small>
              </span>
            </a>
          </li>

          <li>
            <li class="treeview" >
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Pendidik/Tendik (PTK)</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'guru'?>"><i class="fa fa-clone"></i> PTK</a></li>
                <li><a href="<?php echo base_url().'galeri'?>"><i class="fa fa-picture-o"></i> PTK Keluar</a></li>
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
                <li><a href="<?php echo base_url().'siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
                <li><a href="<?php echo base_url().'siswa_keluar'?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
              </ul>
            </li>
          </li>

          <li>
            <a href="<?php echo base_url().'rombel'?>">
              <i class="fa fa-calendar"></i> <span>Rombongan Belajar</span>
              <span class="pull-right-container">
                <small class="p pull-right"></small>
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
              <li><a href="<?php echo base_url().'guru'?>"><i class="fa fa-clone"></i> Raport Sebelumnya</a></li>
              <li><a href="<?php echo base_url().'evaluasi'?>"><i class="fa fa-picture-o"></i> Evaluasi</a></li>
            </ul>
          </li>

          <li>
            <a href="<?php echo base_url().'alumni'?>">
              <i class="fa fa-volume-up"></i> <span>Alumni</span>
              <span class="pull-right-container">
                <small class="p pull-right"></small>
              </span>
            </a>
          </li>

          <li >
            <a href="<?php echo base_url().'instrumen'?>">
              <i class="fa fa-envelope"></i> <span>Instrumen</span>
              <span class="pull-right-container">
                <small class="p pull-right bg-green"></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url().'keuangan'?>">
              <i class="fa fa-envelope"></i> <span>Keuangan</span>
              <span class="pull-right-container">
                <small class="p pull-right bg-green"></small>
              </span>
            </a>
          </li>


          <?php else: ?>
            <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li class="active">
              <a href="<?php echo base_url().'biodata'?>">
                <i class="fa fa-newspaper-o"></i> <span>Biodata</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan_siswa'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>


            <li>
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-file-text"></i> <span>Kisi - Kisi</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'evaluasi'?>">
                <i class="fa fa-files-o"></i> <span>Evaluasi</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'inbox'?>">
                <i class="fa fa-envelope-o"></i> <span>Inbox</span>
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
          <p>Biodata Siswa</p>
        </h1>
        <!-- <a href="#" class="btn btn-success" style="display: inline-flex; margin-bottom: 10px" ><i class="fa fa-fw fa-pencil"></i> Edit</a> -->
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Biodata</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <?php
              $id_admin=$this->session->userdata('idadmin');

              $c = $this->db->select('*')->from('tbl_pengguna a')->join('tbl_siswa b', 'a.pengguna_username = b.siswa_nis', 'inner')->join('tbl_kelas c', 'b.siswa_kelas_id = c.kelas_id', 'inner')->join('tbl_orangtua d', 'b.siswa_nis = d.siswa_nis', 'inner')->join('tbl_agama e', 'b.siswa_agama_id = e.agama_id', 'inner')->where(['a.pengguna_id' => $id_admin])->get()->row_array();

              $user = $this->session->set_userdata(['user' => $c['siswa_nis']]);

              ?>
              <div class="box-header">
                <div class="box-body">
                  <div class="col-md-12">
                    <div class="col-md-2">
                      <!--                         <h3>Kiri</h3> -->
                      <div class="col-md-12">
                        <?php if (empty($c['siswa_photo'])) {
                          $foto=base_url('assets/images/default_photo.jpg');
                        } 
                        else{
                         $foto=base_url('assets/filesiswa').'/'.$c['siswa_nis'].'/'.$c['siswa_photo'];
                       }
                       ?>
                       <img src="<?= $foto ?>" width="100px" height="100px">
                     </div>
                     <div class="col-md-12" style="margin-top: 20px">
                      <?php $status = ($c['soft_deleted']==0) ? 'Aktif' : "Tidak Aktif" ; ?>
                      <p>Status : <?= $status  ?></p>
                    </div>
                  </div>


                  <div class="col-md-10">
                   <!--  <h3>Kanan</h3> -->
                   <p class="col-md-4">NIS</p>
                   <div class="col-md-8">
                    <p ><?= $c['siswa_nis']  ?></p>
                  </div>

                  <p class="col-md-4">NISN</p>
                  <div class="col-md-8">
                    <p ><?= $c['siswa_nisn']  ?></p>
                  </div>

                  <p class="col-md-4">Nama</p>
                  <div class="col-md-8">
                    <p ><?= $c['siswa_nama']  ?></p>
                  </div> 

                  <p class="col-md-4">Jenis Kelamin</p>
                  <div class="col-md-8">
                    <p ><?= ($c['siswa_nis']=='L') ? 'Perempuan' : 'Laki-Laki' ;  ?></p>
                  </div>

                  <p class="col-md-4">Kelas</p>
                  <div class="col-md-8">
                    <p ><?=substr($c['kelas_nama'],6,10);
                    ?>     
                  </p>
                </div>

                <p class="col-md-4">Tempat Tanggal Lahir</p>
                <div class="col-md-8" >
                  <p ><?= $c['siswa_tempat'].', '.tgl_indo($c['siswa_tgl_lahir'])?></p>
                </div>

                <p class="col-md-4">Agama</p>
                <div class="col-md-8">
                  <p ><?= $c['agama_nama']  ?></p>
                </div>

                <p class="col-md-4">Kewarganegaraan</p>
                <div class="col-md-8">
                  <p ><?= $c['siswa_kewarganegaraan']  ?></p>
                </div>

                <p class="col-md-4">Alamat</p>
                <div class="col-md-8">
                  <p ><?= $c['siswa_alamat']  ?></p>
                </div>

                <p class="col-md-4">No.Telpon</p>
                <div class="col-md-8">
                  <p ><?php if (empty($c['siswa_no_telp'])) { echo "-";
                }else{echo $c['siswa_no_telp'];} ?></p>
              </div>

              <p class="col-md-4">Sekolah Sebelumnya</p>
              <div class="col-md-8">
                <p ><?= $c['sekolah_asal']  ?></p>
              </div>

            </div>

          </div> 
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">Ayah</a></li>
            <li><a data-toggle="tab" href="#menu1">Ibu</a></li>
            <li><a data-toggle="tab" href="#menu2">Wali</a></li>
          </ul>
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="tab-content">
                <div id="home" class="tab-pane fade in active col-md-12">
                  <!-- AYAH -->

                  <p class="col-md-3">NIK</p>
                  <div class="col-md-8">
                    <p ><?php if (empty($c['ayah_nik'])) { echo "-";
                  }else{echo $c['ayah_nik'];} ?></p>
                </div>

                <p class="col-md-3">Nama</p>
                <div class="col-md-8">
                  <p ><?php if (empty($c['ayah_nama'])) { echo "-";
                }else{echo $c['ayah_nama'];} ?></p>
              </div>

              <p class="col-md-3">Tempat Tanggal Lahir</p>
              <div class="col-md-8">
                <p >
                  <?php $tanggalayah = ($c['ayah_tanggal']!='0000-00-00') ? tgl_indo($c['ayah_tanggal']) : '-' ; $tempatayah = (!empty($c['ayah_tempat'])) ? $c['ayah_tempat'] : '-' ;?>
                  <?php echo $tempatayah.",".$tanggalayah; ?>
                </p>
              </div>

              <p class="col-md-3">Pendidikan Terakhir</p>
              <div class="col-md-8">
                <p ><?php if (empty($c['ayah_pendidikan'])) { echo "-";
              }else{echo strtoupper($c['ayah_pendidikan']);} ?></p>
            </div>

            <p class="col-md-3">Pekerjaan</p>
            <div class="col-md-8">
              <p ><?php if (empty($c['ayah_pekerjaan'])) { echo "-";
            }else{echo $c['ayah_pekerjaan'];} ?></p>
          </div>

          <p class="col-md-3">Penghasilan</p>
          <div class="col-md-8">
            <p >
              <?php if (empty($c['ayah_penghasilan'])) { echo "-";
            }else{echo "Rp. ".number_format($c['ayah_penghasilan']);} ?></p>
          </div>

          <p class="col-md-3">No telpon</p>
          <div class="col-md-8">
            <p ><?php if (empty($c['no_telp_ayah'])) { echo "-";
          }else{echo $c['no_telp_ayah'];} ?></p>
        </div>

        <p class="col-md-3">Email</p>
        <div class="col-md-8">
          <p ><?php if (empty($c['email_ayah'])) { echo "-";
        }else{echo $c['email_ayah'];} ?></p>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade col-md-12">
      <!-- IBU -->

      <p class="col-md-3">NIK</p>
      <div class="col-md-8">
        <p ><?php if (empty($c['ibu_nik'])) { echo "-";
      }else{echo $c['ibu_nik'];} ?></p>
    </div>

    <p class="col-md-3">Nama</p>
    <div class="col-md-8">
      <p ><?php if (empty($c['ibu_nama'])) { echo "-";
    }else{echo $c['ibu_nama'];} ?></p>
  </div>

  <p class="col-md-3">Tempat Tanggal Lahir</p>
  <div class="col-md-8">
    <p >
      <?php $tanggalibu = ($c['ibu_tanggal']!='0000-00-00') ? tgl_indo($c['ibu_tanggal']) : '-' ; $tempatibu = (!empty($c['ibu_tempat'])) ? $c['ibu_tempat'] : '-' ;?>
      <?php echo $tempatibu.",".$tanggalibu; ?>
    </p>
  </div>

  <p class="col-md-3">Pendidikan Terakhir</p>
  <div class="col-md-8">
    <p ><?php if (empty($c['ibu_pendidikan'])) { echo "-";
  }else{echo strtoupper($c['ibu_pendidikan']);} ?></p>
</div>

<p class="col-md-3">Pekerjaan</p>
<div class="col-md-8">
  <p ><?php if (empty($c['ibu_pekerjaan'])) { echo "-";
}else{echo $c['ibu_pekerjaan'];} ?></p>
</div>

<p class="col-md-3">Penghasilan</p>
<div class="col-md-8">
  <p >
    <?php if (empty($c['ibu_penghasilan'])) { echo "-";
  }else{echo "Rp. ".number_format($c['ibu_penghasilan']);} ?></p>
</div>

<p class="col-md-3">No telpon</p>
<div class="col-md-8">
  <p ><?php if (empty($c['no_telp_ibu'])) { echo "-";
}else{echo $c['no_telp_ibu'];} ?></p>
</div>

<p class="col-md-3">Email</p>
<div class="col-md-8">
  <p ><?php if (empty($c['email_ibu'])) { echo "-";
}else{echo $c['email_ibu'];} ?></p>
</div>
</div>
<div id="menu2" class="tab-pane fade col-md-12">
  <!-- WALI -->

  <p class="col-md-3">NIK</p>
  <div class="col-md-8">
    <p ><?php if (empty($c['wali_nik'])) { echo "-";
  }else{echo $c['wali_nik'];} ?></p>
</div>

<p class="col-md-3">Nama</p>
<div class="col-md-8">
  <p ><?php if (empty($c['wali_nama'])) { echo "-";
}else{echo $c['wali_nama'];} ?></p>
</div>

<p class="col-md-3">Tempat Tanggal Lahir</p>
<div class="col-md-8">
  <p >
    <?php $tanggalwali = ($c['wali_tanggal']!='0000-00-00') ? tgl_indo($c['wali_tanggal']) : '-' ; $tempatwali = (!empty($c['wali_tempat'])) ? $c['wali_tempat'] : '-' ;?>
    <?php echo $tempatwali.",".$tanggalwali; ?>
  </p>
</div>

<p class="col-md-3">Pendidikan Terakhir</p>
<div class="col-md-8">
  <p ><?php if (empty($c['wali_pendidikan'])) { echo "-";
}else{echo strtoupper($c['wali_pendidikan']);} ?></p>
</div>

<p class="col-md-3">Pekerjaan</p>
<div class="col-md-8">
  <p ><?php if (empty($c['wali_pekerjaan'])) { echo "-";
}else{echo $c['wali_pekerjaan'];} ?></p>
</div>

<p class="col-md-3">Penghasilan</p>
<div class="col-md-8">
  <p >
    <?php if (empty($c['wali_penghasilan'])) { echo "-";
  }else{echo "Rp. ".number_format($c['wali_penghasilan']);} ?></p>
</div>

<p class="col-md-3">Alamat</p>
<div class="col-md-8">
  <p ><?php if (empty($c['wali_alamat'])) { echo "-";
}else{echo $c['wali_alamat'];} ?></p>
</div>

<p class="col-md-3">No.Telp</p>
<div class="col-md-8">
  <p ><?php if (empty($c['wali_notelp'])) { echo "-";
}else{echo $c['wali_notelp'];} ?></p>
</div>

</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
<!-- /.box-header -->
<!-- /.box -->
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
<!-- /.control-sidebar -->
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
<!-- Canvas.js -->
<script src="<?php echo base_url().'assets/plugins/canvasjs/jquery.canvasjs.min.js'?>"></script>
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

<script>
  window.onload = function () {

    var options = {
      animationEnabled: true,
      theme: "light2",
      title:{
        text: "Index Prestasi Siswa"
      },
      axisY: {
        title: "Nilai",
        valueFormatString: "#0"
    // suffix: "K",
    // prefix: "£"
  },
  legend: {
    cursor: "pointer",
    itemclick: toogleDataSeries
  },
  toolTip: {
    shared: true
  },
  data: [{
    type: "column",
    name: "Semester 1",
    markerSize: 5,
    showInLegend: true,
    // xValueFormatString: "MMMM",
    yValueFormatString: "#0",
    dataPoints: <?= json_encode($sms_1, JSON_NUMERIC_CHECK) ?>
  },
  {
    type: "column",
    name: "Semester 2",
    markerSize: 5,
    showInLegend: true,
    yValueFormatString: "#0",
    dataPoints: <?= json_encode($sms_2, JSON_NUMERIC_CHECK) ?>
  }]
};

$("#chartContainer").CanvasJSChart(options);

function toogleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

}
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
