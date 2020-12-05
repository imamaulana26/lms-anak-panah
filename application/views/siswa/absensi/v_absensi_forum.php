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
            <div class="offset-1 col-sm-10">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6">
                        <a href="<?= site_url('detail_absensi/absensi_forum/') . $this->uri->segment(3) ?>" class="btn btn-success">Forum</a>
                        <a href="<?= site_url('detail_absensi/absensi_tugas/') . $this->uri->segment(3) ?>" class="btn btn-outline-success">Tugas</a>
                        <a href="<?= site_url('detail_absensi/absensi_oc/') . $this->uri->segment(3) ?>" class="btn btn-outline-success">Kelas Online</a>
                        <a href="<?= site_url('detail_absensi/absensi_kc/') . $this->uri->segment(3) ?>" class="btn btn-outline-success">Kelas Komunitas</a>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($mapel as $dtmapel) {
                    ?>
                        <div class="col-sm-6">
                            <div class="card mapel">
                                <div class="card-header bg-primary ">
                                    <?= $dtmapel['nm_mapel'] ?>
                                </div>
                                <div class="card-body" style="padding-top: 0;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Forum</th>
                                                <th>Materi</th>
                                                <th>Absensi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dataforum = $this->db->get_where('tbl_materi_forum', ['id_forum' => $dtmapel['id_pelajaran']])->result_array();
                                            if (!empty($dataforum)) {
                                                foreach ($dataforum as $dtforum) {
                                            ?>
                                                    <tr>
                                                        <td><?= $dtforum['pertemuan'] ?></td>
                                                        <td><?= $dtforum['judul_materi'] ?></td>
                                                        <td>
                                                            <?php
                                                            foreach ($dtforumsiswa as $dtfrsiswa) {

                                                                if ($dtfrsiswa['idf'] === $dtmapel['id_pelajaran']) {
                                                                    foreach ($dtfrsiswa['data'] as $dtsiswa) {
                                                                        $check = array_search($dtforum['pertemuan'], array_column($dtfrsiswa['data'], 'frk'));
                                                                        if ($dtsiswa['frk'] === $dtforum['pertemuan']) {

                                                            ?>
                                                                            <?= $dtsiswa['abs'] ?>
                                                            <?php
                                                                            break;
                                                                        }
                                                                    }
                                                                    break;
                                                                } else {
                                                                }
                                                            }
                                                            if ($check === false) {
                                                                echo 'Belum Di Absen';
                                                            } ?>
                                                        </td>
                                                        <td><a href="<?= site_url('forum/') . $dtmapel['id_pelajaran'] ?>"><span class="btn btn-outline-success">Kerjakan</span></a></td>
                                                    </tr>

                                            <?php }
                                            } else {
                                                echo '<tr><td colspan="4">Belum ada data</td><tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div><!-- /.container-fluid -->
        </div><!-- /.content -->
    </div>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>