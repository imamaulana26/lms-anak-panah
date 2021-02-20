<!-- Modal -->
<div class="modal fade" id="modal_schedule" tabindex="-1" role="dialog" aria-labelledby="modal_scheduleLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Jadwal Pelajaran <?= $kelas['kelas_nama'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- /.modal-header -->
            <div class="modal-body">
                <div class="row">
                    <!-- <?php var_dump(unserialize($kelas['kls_jadwal'])); ?> -->
                    <?php $jadwal = unserialize($kelas['kls_jadwal']);
                    foreach ($jadwal as $key => $value) {

                    ?>
                        <!-- <?php var_dump($value); ?> -->
                        <div class="col-sm-4">
                            <p style="font-weight: bold;"><?= $value['hari'] ?></p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <?php foreach ($value['data'] as $dt_jadwal) {
                                    ?>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="round active"><?= $dt_jadwal['tipe'] ?></p>
                                            </div>
                                            <div class="col-sm-9">
                                                <?= $dt_jadwal['mapel'] ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div><!-- Senin -->
                        </div>
                    <?php } ?>

                    <!-- <div class="col-sm-4">
                        <p style="font-weight: bold;">Selasa</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">VC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Fisika</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">KC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Kimia</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <p style="font-weight: bold;">Rabu</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">VC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Biologi</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">KC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Kewarganegaraan</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4">
                        <p style="font-weight: bold;">Kamis</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">VC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Fisika</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">KC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Bahasa Inggris</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <p style="font-weight: bold;">Jumat</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">VC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Agama</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="round active">KC</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5>Kimia</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div><!-- Baris bawah -->
                <hr>

                <p style="font-weight: bold;">Keterangan</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <p class="round active">KC</p>
                            </div>
                            <div class="col-sm">
                                <p>Komunitas Class</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <p class="round active">VC</p>
                            </div>
                            <div class="col-sm">
                                <p>Video Conference</p>
                            </div>
                        </div>
                    </div>
                </div><!-- Legends -->
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->