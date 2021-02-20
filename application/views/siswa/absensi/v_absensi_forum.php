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
                        <a href="<?= site_url('detail_absensi/absensi_forum/') . $this->session->userdata('username') ?>" class="btn btn-success">Forum</a>
                        <a href="<?= site_url('detail_absensi/absensi_tugas/') . $this->session->userdata('username') ?>" class="btn btn-outline-success">Tugas</a>
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
                                                    $checkforum = $this->db->get_where('tbl_komen_forum', ['id_forum' => $dtforum['id_forum'], 'pertemuan' => $dtforum['pertemuan']])->row_array();
                                            ?>
                                                    <tr>
                                                        <td><?= $dtforum['pertemuan'] ?></td>
                                                        <td><?= $dtforum['judul_materi'] ?></td>

                                                        <?php
                                                        if (!empty($dtforumsiswa)) { //kondisi murid lama
                                                            if (!empty($checkforum)) {
                                                                $checkidp = array_search($dtmapel['id_pelajaran'], array_column($dtforumsiswa, 'idf'));
                                                                if (($key1 = array_search($dtmapel['id_pelajaran'], array_column($dtforumsiswa, 'idf'))) !== false) {
                                                                    // var_dump($dtforumsiswa[$key]['data']);
                                                                    if (($key2 = array_search($dtforum['pertemuan'], array_column($dtforumsiswa[$key1]['data'], 'frk'))) !== false) {
                                                                        // var_dump($dtforumsiswa[$key2]['data']);
                                                                        // var_dump($key2);
                                                                        echo '<td>' . $dtforumsiswa[$key1]['data'][$key2]['abs'] . '</td><td><a href=' . site_url() . "forum/" . $dtmapel['id_pelajaran'] . '><span class="btn btn-outline-success">Cek Jawaban</span></a></td>';
                                                                    } else {
                                                                        echo '<td> Belum Diabsen </td><td><a href=' . site_url() . "forum/" . $dtmapel['id_pelajaran'] . '><span class="btn btn-outline-success">Cek Jawaban</span></a></td>';
                                                                    }
                                                                } else {
                                                                    echo '<td> Belum Diabsen </td><td><a href=' . site_url() . "forum/" . $dtmapel['id_pelajaran'] . '><span class="btn btn-outline-success">Cek Jawaban</span></a></td>';
                                                                }
                                                            } else {
                                                                echo '<td> Belum Mengerjakan </td><td><a href=' . site_url() . "forum/". $dtmapel['id_pelajaran'] .'><span class="btn btn-outline-success">Kerjakan</span></a></td>';
                                                                // var_dump($dtforumsiswa[0]['data'][0]['abs']);
                                                            }
                                                        } else { //kondisi murid baru
                                                            echo '<td>Belum Mengerjakan</td><td><a href=' . site_url() . "forum/" . $dtmapel['id_pelajaran'] . '><span class="btn btn-outline-success">Kerjakan</span></a></td>';
                                                        }
                                                        ?>
                                                    </tr>

                                            <?php
                                                }
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