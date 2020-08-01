<!-- Modal -->
<div class="modal fade" id="modal_schedule" tabindex="-1" role="dialog" aria-labelledby="modal_scheduleLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nama Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div><!-- /.modal-header -->
            <div class="modal-body">
                <div class="modal-heading">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="text-muted">Course Code</p>
                            <p id="kd_mapel">ISYS6310</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="text-muted">Class</p>
                            <p id="kelas">THBA</p>
                        </div>
                        <div class="col-sm-4">
                            <p class="text-muted">Instrutor</p>
                            <p id="pengajar">Ari Syarifudin</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" class="text-muted"><i class="fas fa-fw fa-book fa-lg"></i></a>
                            <a href="#" class="text-muted"><i class="fas fa-fw fa-comments fa-lg"></i></a>
                        </div>
                    </div>
                </div><!-- /.modal-heading -->
                <hr>
                <p style="font-weight: bold;">F2F Course Schedule</p>
                <div class="row">
                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-1">
                                    <p class="round">VC</p>
                                </div>
                                <div class="col-sm-5">
                                    <p><?= date('d M Y'); ?></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="text-right"><?= date('H:i'); ?> &minus; <?= date('H:i'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-1">
                                    <p class="round active">VC</p>
                                </div>
                                <div class="col-sm-5">
                                    <p><?= date('d M Y'); ?></p>
                                </div>
                                <div class="col-sm-4">
                                    <p class="text-right"><?= date('H:i'); ?> &minus; <?= date('H:i'); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div><!-- F2F Course -->
                <hr>
                <p style="font-weight: bold;">Online Course Schedule</p>
                <div class="row">
                    <div class="col-sm-6">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <div class="row">
                                <div class="col-sm-1">
                                    <p class="round"><?= $i ?></p>
                                </div>
                                <div class="col-sm">
                                    <p><?= date('d M Y'); ?> &minus; <?= date('d M Y'); ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-sm-6">
                        <?php for ($j = 6; $j <= 10; $j++) { ?>
                            <div class="row">
                                <div class="col-sm-1">
                                    <p class="round"><?= $j ?></p>
                                </div>
                                <div class="col-sm">
                                    <p><?= date('d M Y'); ?> &minus; <?= date('d M Y'); ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div><!-- Onsite Course -->
                <hr>
                <p style="font-weight: bold;">Legends</p>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-1">
                                <p class="round active">OS</p>
                            </div>
                            <div class="col-sm">
                                <p>Onsite Class</p>
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