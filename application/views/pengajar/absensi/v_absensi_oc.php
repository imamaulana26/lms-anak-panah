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
                                                        if (!empty($dt_tgl)) {
                                                            $no = 1;
                                                            foreach ($dt_tgl as $li) {
                                                        ?>
                                                                <tr>
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $li['tgl'] ?></td>
                                                                    <td>
                                                                        <a href="<?= base_url('absensi/list_siswa_oc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Absensi</button></a>
                                                                        <a onclick="confirmation(event)" href="<?= base_url('absensi/hapus_tgl_oc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
                                                                        <!-- <a href="delete.php?id=22" class="confirmation">Link</a> -->
                                                                    </td>
                                                                </tr>
                                                        <?php }
                                                        } else {
                                                            echo '<tr><td colspan="3">Belum ada data</td><tr>';
                                                        } ?>
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

    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
            console.log(urlToRedirect); // verify if this is the right URL
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Menghapus Tanggal Ini Berarti Menghapus Semua Data Absensi Yang Ada Di Tanggal Ini",
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjutkan'
            }).then((result) => {
                if (result.value) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>