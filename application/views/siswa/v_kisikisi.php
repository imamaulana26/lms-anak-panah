<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <!-- Announcement -->
      <?php $notif = $this->db->get('tbl_pengumuman')->row_array();
      if ($notif['aktifkan'] > 0) { ?>
        <div class="row">
          <div class="offset-1 col-sm-10">
            <div class="alert alert-info" role="alert">
              <h4 class="alert-heading">Announcement!</h4>
              <p><?= $notif['pengumuman_deskripsi'] ?></p>
              <hr>
              <p class="mb-0">&copy; Anak Panah Cyber Scholl.</p>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Tagihan -->
      <div class="row">
        <div class="offset-1 col-sm-10 media-nav">
          <!-- Index Prestasi -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0"><i class="fas fa-fw fa-clipboard-list fa-lg"></i> Kisi-Kisi</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Sms</th>
                      <th>Ulangan Bulanan</th>
                      <th>Kisi-Kisi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    $sisa = 0;
                    foreach ($kisikisi as $dt) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?=  $dt['nm_mapel'] ?></td>
                        <td><?=  $dt['kisikisi_semester'] ?></td>
                        <td>UB <?=  $dt['kisikisi_ub'] ?></td>
                        <td><?=  $dt['kisikisi_deskripsi'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.col -->
  </div><!-- /.row -->

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>

<!-- script here -->
<script>
 $("#example1").DataTable({
    "scrollX": true,
    pagingType: $(window).width() < 574 ? "simple" : "simple_numbers"
  });
</script>