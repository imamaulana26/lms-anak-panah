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
            <div class="offset-1 col-sm-10 media-nav">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-6 media-align-center">
                        <!--<a href="<?= site_url('detail_absensi/absensi_forum/') . $this->session->userdata('username') ?>" class="btn btn-outline-success">Forum</a>-->
                        <a href="<?= site_url('detail_absensi/absensi_tugas/') . $this->session->userdata('username') ?>" class="btn btn-success">Tugas</a>
                        <a href="<?= site_url('detail_absensi/absensi_oc/') . $this->session->userdata('username') ?>" class="btn btn-outline-success">Kelas Online</a>
                        <a href="<?= site_url('detail_absensi/absensi_kc/') . $this->session->userdata('username') ?>" class="btn btn-outline-success">Kelas Komunitas</a>
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
                                        <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tugas</th>
                                                <th>Materi</th>
                                                <th>Absensi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $datatugas = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $dtmapel['id_pelajaran']])->result_array();
                                            if (!empty($datatugas)) {
                                                foreach ($datatugas as $dttugas) {
                                                    $checktugas = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $dttugas['id_forum'], 'pertemuan' => $dttugas['pertemuan']])->row_array();

                                                    // var_dump($dttugas['pertemuan']);
                                                    // var_dump($dttgssiswa);
                                                    // echo $dtmapel['id_pelajaran'];

                                            ?>
                                                    <tr>
                                                        <td><?= $dttugas['pertemuan'] ?></td>
                                                        <td><?= $dttugas['judul_materi'] ?></td>
                                                        <td>
                                                            
                                                            <?php if (!empty($checktugas)) { // kondisi murid sudah ada di tbl
                                                                $checkidp = array_search($dtmapel['id_pelajaran'], array_column($dttgssiswa, 'idtg'));
                                                                if (!empty($dttgssiswa)) {
                                                                    if (($key1 = array_search($dtmapel['id_pelajaran'], array_column($dttgssiswa, 'idtg'))) !== false) {
                                                                        if (($key2 = array_search($dttugas['pertemuan'], array_column($dttgssiswa[$key1]['data'], 'tgk'))) !== false) {
                                                                            echo $dttgssiswa[$key1]['data'][$key2]['abs'];
                                                                        } else {
                                                                            echo 'Belum di absen';
                                                                        }
                                                                    } else {
                                                                        echo 'Belum di absen';
                                                                    }
                                                                } else {
                                                                    echo ' Belum Mengerjakan';
                                                                }
                                                            } else { // kondisi murid belum ada di tbl
                                                                echo 'Tugas belum dikerjakann';
                                                            } ?>
                                                        </td>
                                                        <td><a href="<?= site_url('tugas/') . $dtmapel['id_pelajaran'] ?>"><span class="btn btn-outline-success">Kerjakan</span></a></td>
                                                    </tr>
                                            <?php }
                                                // echo $dttgssiswa[$key1]['data'][$key2]['abs'];
                                            } else {
                                                echo '<tr><td colspan="4">Belum ada data</td><tr>';
                                            } ?>
                                        </tbody>
                                    </table>
                                    </div>
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