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
                            <h5 class="card-title m-0">Absensi Kelas Komunitas <?= $nm_mapel ?></h5>
                            <a href="#"><button type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#modal_kelaskomunitas"><i class="fas fa-calendar-plus"></i> Tambah Tanggal</button></a>
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
                                                            <th>Jam Mulai</th>
                                                            <th>Jam Selesai</th>
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
                                                                    <td><?= $li['start'] ?></td>
                                                                    <td><?= $li['end'] ?></td>
                                                                    <td>
                                                                        <a href="<?= base_url('absensi/list_siswa_kc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-primary">Absensi</button></a>
                                                                        <a href="<?= base_url('absensi/hapus_tgl_kc/') . $this->uri->segment(3) . '/' . $li['tgl'] ?>"><button type="button" class="btn btn-danger">Hapus</button></a>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                        } else { ?>
                                                            <tr>
                                                                <td colspan="5" style="text-align: center;">Belum ada data</td>
                                                            </tr>
                                                        <?php }
                                                        ?>

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

    <div class="modal fade" id="modal_kelaskomunitas" tabindex="-1" role="dialog" aria-labelledby="modal_scheduleLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"><?= $nm_mapel ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="<?= base_url('absensi/add_jadwal_kc') ?>" method="post" id="fm_oc">
                        <input type="hidden" name="id" value="<?= $this->uri->segment(3) ?>">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"> Absensi Kelas Komunitas </label>
                            <div class="col-sm-8" style="align-content: center; display: grid;">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="tgl_lahirsiswa" id="xtgl_lahir" placeholder="yyyy-mm-dd" required>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"> Dimulai Jam </label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker1" data-placement="left" data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                        <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="start_on" id="start_on">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label"> Selesai Jam </label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker2" data-placement="left" data-align="top" data-autoclose="true">
                                    <div class="input-group-addon">
                                        <span class="input-group-text" style="height: 100%; border-radius: 0.25rem 0 0 0.25rem;"><i class="fa fa-fw fa-clock"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="end_on" id="end_on">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm">
                                <button class="btn btn-primary" type="submit" value="Submit" style="float: right;">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>

    <?php $this->load->view('pengajar/layout/v_js'); ?>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>