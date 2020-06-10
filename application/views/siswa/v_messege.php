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
                            <h5 class="card-title m-0"><i class="fas fa-fw fa-envelope fa-lg"></i> Pesan Masuk</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                   <table id="example1" class="table table-striped table-hover" style="font-size:12px;">
                                      <thead>
                                        <tr>
                                           <th  width="10px">#</th>
                                           <th  width="10%">Tanggal</th>
                                           <th>Pesan</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                      <?php
                                      $no = 1;
                                      foreach ($inbox->result_array() as $i) :
                                        $arr = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                        $exp = explode(' ', $i['inbox_tanggal']);
                                        $tgl = explode('-', $exp[0]);
                                        $bln = substr($tgl[1], -1) > 0 ? $arr[substr($tgl[1], -1)] : $arr[$tgl[1]];
                                        ?>
                                        <tr>
                                          <td><?= $no++ ?></td>
                                          <td><?= $tgl[2].' '.$bln.' '.$tgl[0].'<br>'.$exp[1] ?></td>
                                          <td><?= '<b>From : '.$i['inbox_nama'].'</b><br>'.$i['inbox_pesan'] ?></td>
                                      </tr>
                                  <?php endforeach;?>
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