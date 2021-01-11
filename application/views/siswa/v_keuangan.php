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
        <div class="offset-1 col-sm-10">
          <!-- Index Prestasi -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0"><i class="fas fa-fw fa-file-invoice-dollar fa-lg"></i>History Keuangan</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <table id="example1" class="table table-striped table-hover">
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
                    $sisa = 0;
                    foreach ($keuangan as $dt) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $dt['tgl_pembayaran'] ?></td>
                        <td><?= $dt['kd_transaksi'] ?></td>
                        <td><?= $dt['jns_tagihan']; ?></td>
                        <td>Rp. <?= number_format($dt['nom_tagihan']); ?></td>
                        <td>Rp. <?= number_format($dt['bayar']); ?></td>
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

<?php $this->load->view('siswa/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>

<!-- script here -->
<script>
  $("#example1").DataTable();
</script>