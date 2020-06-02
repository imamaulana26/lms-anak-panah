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
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SEKOLAH ANAK PANAH | Dashboard</title>
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

            <li class="active">
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

            <li>
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
          <p>Dashboard Siswa</p>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">

              <div class="box">
                <?php
                $id_admin=$this->session->userdata('idadmin');
                
                $c = $this->db->select('*')->from('tbl_pengguna a')->join('tbl_siswa b', 'a.pengguna_username = b.siswa_nis', 'inner')->join('tbl_kelas c', 'b.siswa_kelas_id = c.kelas_id', 'inner')->join('tbl_orangtua d', 'b.siswa_nis = d.siswa_nis', 'inner')->join('tbl_agama e', 'b.siswa_agama_id = e.agama_id', 'inner')->where(['a.pengguna_id' => $id_admin])->get()->row_array();

                $user = $this->session->set_userdata(['user' => $c['siswa_nis']]);

                ?>
                <div class="box-header">
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12"> 
                        <div class="col-md-6">
                          <h3>Informasi Tagihan</h3>
                          <table class="table table-bordered table-stripped table-hover">
                            <thead>
                              <tr>
                                <th class="text-center" style="width: 10px">No</th>
                                <th>Jenis Tagihan</th>
                                <th>Tgl. Jatuh Tempo</th>
                                <th>Nominal</th>
                                <th>Sisa Angsuran</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $sql = "select * from tbl_pembayaran a inner join tbl_tagihan b on b.id_tagihan = a.jns_tagihan where a.sts_pembayaran = '1' and a.nis_siswa = '".$c['siswa_nis']."'";
                              $data = $this->db->query($sql)->result_array();

                              $no = 1;
                              foreach ($data as $val) {
                                echo "<tr>";
                                echo "<td class='text-center' style='width: 10px'>".$no++."</td>";
                                echo "<td><a href=".site_url('keuangan_siswa').">".$val['jns_tagihan']."</a></td>";
                                echo "<td>".date('d F Y', strtotime($val['tgl_jatuh_tempo']))."</td>";
                                echo "<td>Rp. ".number_format($val['nom_tagihan'], 0, '.', ',')."</td>";
                                echo "<td>Rp. ".number_format($val['sisa_angsur'], 0, '.', ',')."</td>";
                                echo "</tr>";
                              } ?>
                            </tbody>
                          </table>
                        </div>
                        <?php $pengumuman = $this->db->get_where('tbl_pengumuman',['aktifkan'=>1])->row_array();; ?>
                        <?php $disp = $this->db->get('tbl_pengumuman')->row_array(); 
                        $display = ($disp['aktifkan']=='1') ? '' : 'none' ;

                        ?>
                        <div class="col-md-4" style="display: <?= $display ?>">
                          <h3 class="text-center" style="color: red"><p>PENGUMUMAN</p></h3>
                          <table style="border-style: dashed;border-color: red; border-width: 5px;">
                            <tr>
                              <td style="padding: 10px 10px 5px 10px">
                                <h4><?= $pengumuman['pengumuman_deskripsi']  ?></h4>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <form action="#"></form>
                      </div>
                      <div class="col-md-12">
                        <h3>Index Prestasi</h3>
                        <form action="<?= site_url('dashboard') ?>" method="post" class="form-horizontal">
                          <div class="col-sm-6">
                            <div class="form-group col-md-6">
                              <select name="xta" class="form-control">
                                <option selected disabled>--Pilih--</option>
                                <?php
                                $ta = $this->db->select('ta')->from('tbl_nilai')->group_by('ta')->order_by('ta', 'desc')->get()->result_array();

                                foreach ($ta as $st) {
                                 echo "<option value=".$st['ta'].">".$st['ta']."</option>";
                               } ?>
                             </select>
                           </div>
                           <button type="submit" class="btn btn-default" style="margin-left: 10px"><i class="fa fa-fw fa-search"></i> Search</button>

                         </div>
                       </form>
                       

                       <div class="col-md-12">
                         <div id="chartContainer" style="height: 300px; width: 100%;"></div><br>
                         
                         <?php
                         $sql = "select b.nm_mapel as label, a.nilai as y from tbl_nilai a left join tbl_mapel b on a.kd_mapel = b.kd_mapel where a.nis_siswa = '".$c['siswa_nis']."' and a.ta = '".$tahun['ta']."'";
                         $where_1 = "and a.semester = '1'";
                         $where_2 = "and a.semester = '2'";

                         $sms_1 = $this->db->query($sql." ".$where_1)->result_array();
                         $sms_2 = $this->db->query($sql." ".$where_2)->result_array(); 
                         ?>
                       </div>
                     </div>
                   </div>
                 </div> 
               </div>
             </div>


             <!-- /.box-header -->
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
    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
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
        text: "<?= 'Index Prestasi '.$tahun['ta'] ?>"
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
