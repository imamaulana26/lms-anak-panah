<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PKBM Anak Panah | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
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
        <div class="box">
        <h4 class="col-md-4"><b>MENU SUPER ADMIN</b></h4>
        </div>
        <div class="col-md-12" >
          <a style="float: right;" class="btn btn-primary btn-flat" style="" id="trigeradd"><span class="fa fa-plus"></span>Tambah Admin</a>
        </div>
        <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 15px">No</th>
              <th>Nama</th>
              <th>username admin</th>
              <th>password</th>
              <th>aksi</th>
            </tr>
          </thead>
          <tbody >
            <?php $data = $this->db->get_where('tbl_pengguna',['pengguna_level'=>1])->result_array();  $no=1;?>
            <?php foreach ($data as $value) { $id = $value['pengguna_id'];
            ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $value['pengguna_nama']  ?></td>
              <td><?= $value['pengguna_username']  ?></td>
              <td><a target="_blank" href="https://www.md5online.org/md5-decrypt.html"><?= $value['pengguna_password']  ?></a></td>
              <td>
                <a class="btn btn-success btn-flat"  data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-plus"></span> Edit Admin</a><br>
                <a class="btn btn-success btn-danger"  data-toggle="modal" data-target="#ModalDelete<?php echo $id;?>"><span class="fa fa-plus"></span> Hapus Admin</a></td>
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

<div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'login/add_admin'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" name="xnama" class="form-control"  placeholder="Nama" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Username</label>
            <div class="col-sm-7">
              <input type="text" name="xusername" class="form-control"  placeholder="Username Untuk Login" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">Password</label>
            <div class="col-sm-7">
              <input type="text" name="xpassword" class="form-control" placeholder="Password" required>
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

<!--Modal Hapus Pegawai-->
<?php $data = $this->db->get_where('tbl_pengguna',['pengguna_level'=>1])->result_array();  ?>
<?php foreach ($data as $value) { $id = $value['pengguna_id'];?>
<div class="modal fade" id="ModalEdit<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Admin </h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'login/edit_admin'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="xid" value="<?= $id ?>">

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">nama</label>
            <div class="col-sm-7">
              <input type="text" name="xnama" value="<?= $value['pengguna_nama'] ?>" class="form-control" id="inputUserName"  required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">username</label>
            <div class="col-sm-7">
              <input type="text" name="xusername" value="<?= $value['pengguna_username'] ?>" class="form-control" id="inputUserName" required>
            </div>
          </div>

          <div class="form-group">
            <label for="inputUserName" class="col-sm-4 control-label">New Pasword</label>
            <div class="col-sm-7">
              <input type="text" name="xnewpasword" class="form-control" id="inputUserName" placeholder="masukan pasword baru" required>
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

<?php $data = $this->db->get_where('tbl_pengguna',['pengguna_level'=>1])->result_array();  ?>
<?php foreach ($data as $value) { $id = $value['pengguna_id'];?>

<div class="modal fade" id="ModalDelete<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel">Hapus Admin <?= $value['pengguna_nama'] ?></h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'login/delete_admin'?>" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input name="xid" type="hidden" value="<?= $value['pengguna_id']  ?>">
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
<!-- iCheck -->
<script src="<?php echo base_url().'assets/plugins/iCheck/icheck.min.js'?>"></script>

<script>
  $( "#trigeradd" ).click(function() {
    // alert("Test.");
    $('#tambahuser').modal('show');
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
