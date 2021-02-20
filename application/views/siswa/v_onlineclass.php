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
      <!-- Kelas Online -->
      <div class="row">
        <div class="offset-1 col-sm-10 media-nav">
          <div class="card card-primary card-outline">
            <div class="card-body">
              <div class="row">
                <?php foreach ($oc as $online) {
                  ?>
                  <div class="col-sm-4">
                    <div class="card" style="height: 13em">
                      <?php if ($online['aktifkan'] == 1) {
                        ?>
                        <!--<base href="<?= $online['link_oc']  ?>" />-->
                        <a href="<?php echo prep_url($online["link_oc"]); ?>" target="_blank">
                          <div class="card-header bg-primary">
                            <i class="fas fa-fw fa-video mr-1 blink_me" style="color: #f72121"></i> Sedang Berlangsung
                          </div>
                        </a>
                      <?php } else{ ?>
                        <div class="card-header bg-light">
                          <i class="fas fa-fw fa-video mr-1"></i> Belum Dimulai
                        </div>
                      <?php } ?>

                      <div class="card-body">
                          <p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> <?= $online['nm_mapel']  ?></p>
                          <p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= $online['tgl_oc'] ?></p>
                          <p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> <?= $online['time_start'] ?> - <?= $online['time_end'] ?></p>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- End Of Kelas Online -->
    </div><!-- /.container-fluid -->
  </div><!-- /.content -->

  <?php $this->load->view('siswa/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>
