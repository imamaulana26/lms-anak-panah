
<div class="modal fade" id="modal_kelasonline" tabindex="-1" role="dialog" aria-labelledby="modal_scheduleLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="fm_oc">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> Jadwal Kelas Online </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-fw fa-calendar"></i> </span>
                                </div>
                                <input type="date" class="form-control" name="jdl_kelas" id="jdl_kelas">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> Link Kelas Online </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="link_oc" id="link_oc">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> Dimulai Jam </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-fw fa-clock"></i> </span>
                                </div>
                                <input type="time" class="form-control" name="start_on" id="start_on">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"> Selesai Jam </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-fw fa-clock"></i> </span>
                                </div>
                                <input type="time" class="form-control" name="end_on" id="end_on">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label-inline"> Action </label>
                        <div class="col-sm-8">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="opsi_kls" value="1">
                                <label class="form-check-label" for="inlineRadio1">Mulai Kelas</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="opsi_kls" value="0">
                                <label class="form-check-label" for="inlineRadio2">Tutup Kelas</label>
                            </div>

                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm">
                            <span class="btn btn-primary" onclick="submit()" style="float: right;"> Submit </button>
                        </div>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>