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
  <title>SEKOLAH ANAK PANAH | Kisi-Kisi</title>
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

            <li class="active">
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
            Pilih Kelas
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Kisi-Kisi</li>
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
                  <table class="table" border="1px">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $kelas = $this->db->get_where('tbl_kelas', ['kelas_id !=' => 16])->result_array();
                      $no = 1;
                      foreach ($kelas as $kls) { $id=$kls['kelas_id']?>
                        <tr>
                          <td width="5%"><?= $no++ ?></td>
                          <td><?= $kls['kelas_nama'] ?></td>
                          <td width="20%" class="text-center">
                            <a class="btn btn-success" onclick="setting_kisikisi('<?= $id ?>')">Submit</a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <div class="col-md-7" style="font-size: 11px">
              <!-- MAP & BOX PANE -->
              <div class="box">
               <?php $data= $this->db->select('*')->from('tbl_kisikisi a')->join('tbl_mapel b', 'a.kisikisi_mapel = b.kd_mapel', 'inner')->join('tbl_kelas c', 'a.kisikisi_kelas_id = c.kelas_id', 'inner')->order_by('a.kisikisi_id', 'desc')->get()->result_array();?>
               <div class="box-header with-border">
                <table id="example" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Kelas</th>
                      <th>MaPel</th>
                      <th width="5px">Sms</th>
                      <th width="5px">UB</th>
                      <th>Kisi-Kisi</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php   foreach ($data as $dt) { $id=$dt['kisikisi_id']; ?>
                    <tr>
                      <td width="5%"><?=  $dt['kelas_nama'] ?></td>
                      <td><?=  $dt['nm_mapel'] ?></td>
                      <td width="5%"><?=  $dt['kisikisi_semester'] ?></td>
                      <td width="5%"><?=  $dt['kisikisi_ub'] ?></td>
                      <td class="text-justify"><?=  $dt['kisikisi_deskripsi'] ?></td>
                      <td><a class="btn btn-danger" onclick="hapus('<?= $id ?>')"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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
  <div class="modal fade" id="modalsetingkisikisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
          <h4 class="modal-title" id="myModalLabel"><label id="kelas_nm"></label></h4>
        </div>
        <form class="form-horizontal" action="<?= site_url('kisikisi/save_kisikisi') ?>" method="post" enctype="multipart/form-data">
          <div class="modal-body"> 
           <input type="hidden" name="kelas" id="kelas" class="form-control" > 

           <div class="form-group">
            <div class="col-md-12">
              <label class="form-label col-md-3">Mata Pelajaran</label>
              <div class="col-md-6">
                <select name="mapel" class="form-control">
                  <?php $mapel = $this->db->get('tbl_mapel')->result_array();
                  foreach ($mapel as $val) {
                   echo "<option value=".$val['kd_mapel'].">".$val['nm_mapel']."</option>";
                 } ?>
               </select>
             </div>
           </div>
         </div>

         <div class="form-group">
          <div class="col-md-12">
            <label class="form-label col-md-3">Semester</label>
            <div class="col-md-4">
              <label class="radio-inline"><input type="radio" name="semester" value="1" required>1</label>
              <label class="radio-inline" required><input type="radio" name="semester" value="2" >2</label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="form-label col-md-3">UB</label>
            <div class="col-md-2">
              <select name="ub" id="ub" class="form-control">
                <?php for ($i=1; $i <=12 ; $i++) { 
                  echo "<option value=".$i.">".$i."</option>";
                }
                ?>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <label class="form-label col-md-3">Kisi-Kisi</label>
            <div class="col-md-8">
              <textarea name="deskripsi" cols="40" rows="5"></textarea>
            </div>
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
<!-- page script -->
<script>
  $(document).ready(function(){
    $('#example').DataTable();
  });
        // $(function () {
        //   $("#example1").DataTable();
        //   $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false
        //   });
        // });
      </script>
      <script>
        function setting_kisikisi($id){
          $.ajax({
            url: "<?= site_url('kisikisi/setting_kelas') ?>"+'/'+$id,
            type: "post",
            dataType: "json",
            success: function(data){
      // alert("Test.");
      $('#modalsetingkisikisi').modal('show');
      $('#kelas').val(data[0].kelas_id);
      $('#kelas_nm').text('Seting Kisi-Kisi '+data[0].kelas_nama+'');
    }
  });
        }
        function hapus($id){
         if(confirm("Apakah Anda Yakin Ingin Menghapus Kisi-Kisi Ini?")){

          $.ajax({
            url: "<?= site_url('kisikisi/hapus_kisikisi') ?>"+'/'+$id,
            type: "post",
            dataType: "json",
            success: function(data){   
              location.reload(true);  
            }
          });
        }
        else{
          return false;
        }
      }
    </script>
    <script>

      var lineChartData = {
        labels : <?php echo json_encode($bulan);?>,
        datasets : [

        {
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(152,235,239,1)",
          data : <?php echo json_encode($value);?>
        }

        ]

      }

      var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

      var canvas = new Chart(myLine).Line(lineChartData, {
        scaleShowGridLines : true,
        scaleGridLineColor : "rgba(0,0,0,.005)",
        scaleGridLineWidth : 0,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve : true,
        bezierCurveTension : 0.4,
        pointDot : true,
        pointDotRadius : 4,
        pointDotStrokeWidth : 1,
        pointHitDetectionRadius : 2,
        datasetStroke : true,
        tooltipCornerRadius: 2,
        datasetStrokeWidth : 2,
        datasetFill : true,
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        responsive: true
      });

    </script>

  </body>
  </html>
