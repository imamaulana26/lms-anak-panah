<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PKBM Anak Panah | Super Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/iCheck/square/blue.css'?>">

  
</head>
<body class="hold-transition login-page">
  <section>

    <div class="box">
     <!-- /.login-logo -->
     <div>
       <div class="box">
        <div class="col-md-12" style="margin-bottom: 20px;margin-top: 20px;">
          <h4 class="col-md-6"><b>LIST HAK PELAJARAN UNTUK (<?=$nama_pengajar['nm_pengajar'] ?>)</b></h4>
         <a href="<?= site_url('login/superadmin')?>" style="float: right;" class="btn btn-primary btn-flat" id="trigeraddpengajar"><span class="fa fa-plus"></span> Kembali</a>
        </div>

        <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 15px">No</th>
              <th>Kelas</th>
              <th>Nama Pelajaran</th>
              <th style="width: 100px">aksi</th>
            </tr>
          </thead>
          <tbody >
            <?php $no = 1; foreach ($list as $li) {
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $li['kelas_nama'] ?></td>
                <td><?= $li['nm_mapel'] ?></td>
                <td><a class="btn btn-success btn-danger"  data-toggle="modal" data-target="#ModalDelete<?= $li['id_pelajaran'] ?>"><span class="fa fa-trash"></span> Hapus Hak</a></td>  
               </tr>
             <?php } ?>
           </tbody>
         </table>
       </div>
     </div>
     <a style="margin-bottom: 20px;margin-left: 20px" class="btn btn-danger btn-flat" href="<?= base_url().'login/logout'  ?>">Logout</a>
   </div>
 </section>
 <!-- /.login-box -->

<!-- /.hapus hak -->
<?php foreach ($list as $value) { $id = $value['id_pelajaran'];?>

<div class="modal fade" id="ModalDelete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" style="text-align: center;" id="myModalLabel">Hapus Hak Mengajar <?=$nama_pengajar['nm_pengajar'] ?> <br>Untuk <?= $value['nm_mapel'] ?> <?= $value['kelas_nama'] ?> </h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'login/hapus_hak'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input name="xid" type="hidden" value="<?= $value['id_pelajaran']  ?>">
          <label><h4>Apakah Anda Yakin??</h4></label>
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
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>

<script>
  $( "#trigeradd" ).click(function() {
    // alert("Test.");
    $('#tambahuser').modal('show');
  });
</script>
<script>
  $(document).ready(function(){
    $('#table').DataTable();
  });
</script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
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
        text: "Admin Berhasil ditambahkan.",
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
      <?php elseif($this->session->flashdata('msg')=='delete'):?>
        <script type="text/javascript">
          $.toast({
            heading: 'Info',
            text: "Admin Berhasil di hapu",
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
