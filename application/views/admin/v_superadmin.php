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
        <div class="box">
          <h4 class="col-md-4"><b>MENU SUPER ADMIN</b></h4>
        </div>
        <div class="col-md-12" >
          <form action="<?= site_url('login/list_data')?>" method="post" class="form-horizontal">
            <div class="col-md-6">
              <div class="form-group col-md-6">
                <select name="data" class="form-control">
                  <option selected="true" disabled="true">-- Pilih Jenis Data--</option>
                  <option value="1">Admin</option>
                  <option value="3">Pengajar</option>
                </select>
              </div>
              <button type="submit" class="btn btn-default" style="margin-left: 10px"><i class="fa fa-fw fa-search"></i> Search</button>
            </div>
          </form>
          <a style="float: right;" class="btn btn-primary btn-flat" style="" id="trigeradd"><span class="fa fa-plus"></span> Tambah User</a>
          <!-- <a style="float: right; margin-right: 20px;" class="btn btn-primary btn-flat" id="trigeraddpengajar"><span class="fa fa-plus"></span> Tambah Pengajar</a> -->
        </div>
        <table id="table" class="table table-sm table-striped table-hover table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th style="width: 15px">No</th>
              <th>Nama</th>
              <th>username</th>
              <th>tipe</th>
              <th style="width: 100px">aksi</th>
            </tr>
          </thead>
          <tbody >
            <?php $no = 1; foreach ($list as $li) {
              $id=$li['pengguna_id'];
              ?>
              <tr>

                <td><?= $no++ ?></td>
                <td><?= $li['pengguna_nama'] ?></td>
                <td><?= $li['pengguna_username'] ?></td>
                <td><?= $cetak = ($li['pengguna_level']==1) ? 'Admin' : 'Pengajar' ;  ?></td>
                <td>
                  <a style="margin-bottom: 5px;" class="btn btn-success btn-flat"  data-toggle="modal" data-target="#ModalEdit<?php echo $id;?>"><span class="fa fa-pencil"></span> Edit Data</a><br>
                  <?php if ($li['pengguna_level']==3) {
                   ?>
                   <a style="margin-bottom: 5px;" class="btn btn-primary btn-flat"  data-toggle="modal" data-target="#ModalPengajar<?= $li['id_pengajar']?>"><span class="fa fa-cog"></span> Hak Pengajar</a><br>
                   <a style="margin-bottom: 5px;" href="<?= site_url('login/list_hak/').$li['id_pengajar']?>" class="btn btn-info btn-flat"  data-toggle="modal"><span class="fa fa-eye"></span> Lihat Daftar</a><br>
                 <?php } ?>
                 <a class="btn btn-success btn-danger"  data-toggle="modal" data-target="#ModalDelete<?php echo $id;?>"><span class="fa fa-trash"></span> Hapus Data</a></td>
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
            <label for="inputUserName" class="col-sm-4 control-label">Tipe User</label>
            <div class="col-sm-7">
              <select name="xtype" id="category" class="form-control" required>
                <option selected disabled>--Pilih--</option>
                <option value="1">Admin</option>
                <option value="3">Pengajar</option>
              </select>
            </div>
          </div>

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

<!-- /.login-box -->

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

<!-- <?php $data = $this->db->get_where('tbl_pengguna',['pengguna_level'=>1])->result_array();  ?> -->
<?php foreach ($list as $value) { $id = $value['pengguna_id'];?>
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
          <input name="xhak" type="hidden" value="<?= $value['pengguna_level']  ?>">
          <?php if ($value['pengguna_level']==3) {?>
            <input name="xipdeng" type="hidden" value="<?= $value['id_pengajar']  ?>">
          <?php } ?>
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

<?php $data = $this->db->get('tbl_pengajar')->result_array();  ?>
<?php foreach ($data as $value) { $id = $value['id_pengajar'];?>
<div class="modal fade" id="ModalPengajar<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
        <h4 class="modal-title" id="myModalLabel" style="text-align: center;">Hak Akses Untuk <?= $value['nm_pengajar'] ?></h4>
      </div>
      <form class="form-horizontal" action="<?php echo base_url().'login/save_pengajar'?>" method="post" enctype="multipart/form-data">

        <div class="modal-body">
          <input name="xid" type="hidden" value="<?= $value['id_pengajar']  ?>">
          <div class="form-group">
            <label  class="col-sm-4 control-label">Kelas</label>
            <div class="col-sm-7">
              <select name="xkelas" id="category" class="form-control" required>
                <option selected disabled>--Pilih--</option>
                <?php $kelas = $this->db->get_where('tbl_kelas',['kelas_id <' => '19'])->result_array();
                foreach ($kelas as $kel) {
                 echo "<option value=".$kel['kelas_id'].">".$kel['kelas_nama']."</option>";
               } ?>
             </select>
           </div>
         </div>

         <div class="form-group">
          <label  class="col-sm-4 control-label">Untuk Pelajaran</label>
          <div class="col-sm-7">
            <select name="xmapel" id="category" class="form-control" required>
              <option selected disabled>--Pilih--</option>
              <?php $mapel = $this->db->get('tbl_mapel')->result_array();
              foreach ($mapel as $map) {
               echo "<option value=".$map['kd_mapel'].">".$map['nm_mapel']."</option>";
             } ?>
           </select>
         </div>
       </div>

     </div>

     <div class="modal-footer" style="text-align: center;">
      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batalkan</button>
      <button type="submit" class="btn btn-success btn-flat" id="simpan">Ya</button>
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
