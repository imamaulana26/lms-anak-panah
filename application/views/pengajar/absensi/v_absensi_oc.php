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

            <!-- Next Agenda -->
            <div class="row">
                <div class="offset-1 col-sm-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Absensi Kelas Online</h5>
                        </div>
                        <div class="card-body ">
                            <div class="box">
                                <div class="row">
                                    <div class="box-body">
                                        <div class="col-xs-12" style="width: 100%;">
                                            <div class="box-body">
                                                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 15px">No</th>
                                                            <th>Tanggal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($dt_tgl !== NULL) {
                                                            $no = 1;
                                                            foreach ($dt_tgl as $li) {
                                                            }  ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $li['tgl'] ?></td>
                                                                <td>
                                                                    <a href="<?= base_url('absensi/list_siswa_oc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Absensi</button></a>
                                                                    <a href="<?= base_url('absensi/hapus_tgl_oc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-danger" data-toggle="modal">Hapus</button></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view('pengajar/layout/v_js'); ?>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>