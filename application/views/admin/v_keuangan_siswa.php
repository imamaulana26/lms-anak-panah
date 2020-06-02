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
  <title>SEKOLAH ANAK PANAH | Keuangan Siswa</title>
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
                  <li><a href="<?php echo base_url().'guru_keluar'?>"><i class="fa fa-picture-o"></i> PTK Keluar</a></li>
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

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>E-Raport</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li  class="active"><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-clone"></i> Mapel</a></li>
                <li><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-picture-o"></i> Nilai Raport</a></li>
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
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-envelope"></i> <span>kisi-Kisi</span>
                <span class="pull-right-container">
                  <small class="p pull-right bg-green"></small>
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

              <li>
                <a href="<?php echo base_url().'biodata'?>">
                  <i class="fa fa-newspaper-o"></i> <span>Biodata</span>
                  <span class="pull-right-container">
                    <small class="p pull-right"></small>
                  </span>
                </a>
              </li>

              <li class="active">
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
           History Keuangan
         </h1>
         <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Keuangan</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="table" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tgl. Pembayaran</th>
                        <th>Kode Pembayaran</th>
                        <th>Jenis Tagihan</th>
                         <th>Jumlah Tagihan</th>
                        <th>Pembayaran Diterima</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;
                      $this->db->order_by('tgl_pembayaran','desc');
                      $dt_uang = $this->db->select('*')->from('tbl_keuangan a')->join('tbl_tagihan b', 'a.kd_tagihan = b.id_tagihan', 'right')->where(['a.nis_siswa' => $this->session->userdata('user')])->get()->result_array();

                      // $sql = "select a.tgl_pembayaran, a.kd_transaksi, b.jns_tagihan, b.nom_tagihan, sum(a.nom_pembayaran) as bayar, a.status from tbl_keuangan a inner join tbl_tagihan b on a.kd_tagihan = b.id_tagihan ";
                      // $sql .= "where a.nis_siswa = '".$this->session->userdata('user')."' ";
                      // $sql .= "group by b.jns_tagihan";

                      // $dt_uang = $this->db->query($sql)->result_array();

                      $sisa = 0;
                      foreach ($dt_uang as $dt) { ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $dt['tgl_pembayaran'] ?></td>
                          <td><?= $dt['kd_transaksi'] ?></td>
                          <td><?= $dt['jns_tagihan']; ?></td>
                          <td>Rp. <?= number_format($dt['nom_tagihan']); ?></td>
                          <td>Rp. <?= number_format($dt['nom_pembayaran']); ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
    </footer>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>

    <script>
      $(document).ready(function(){
        $('#table').DataTable();
      });

    </script>

  </body>
  </html>
