<!-- BIODATA -->
<div class="card-body">
    <div class="row">
        <div class="col-sm">

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Nama</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['siswa_nama']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>NIS</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['siswa_nis']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>NISN</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['siswa_nisn']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Jenis Kelamin</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= ($siswa['siswa_jenkel'] == 'P') ? 'Perempuan' : 'Laki-Laki';  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Kelas</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= substr($siswa['kelas_nama'], 6, 10);
                            ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>TTL</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['siswa_tempat'] . ', ' . tgl_indo($siswa['siswa_tgl_lahir']) ?></h6>
                </div>
            </div>



            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Agama</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['agama_nama']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Kewarganegaraan</label>
                </div>
                <div class="col-sm-8">
                    <h6><?= $siswa['siswa_kewarganegaraan']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Alamat</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['siswa_alamat']  ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>No.Telpon</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?php if (empty($siswa['siswa_no_telp'])) {
                                echo "-";
                            } else {
                                echo $siswa['siswa_no_telp'];
                            } ?></h6>
                </div>
            </div>

            <div class="col-sm-12" style="display: flex;">
                <div class="col-sm-3">
                    <label>Sekolah Sebelumnya</label>
                </div>
                <div class="col-sm-8">
                    <h6> <?= $siswa['sekolah_asal']  ?></h6>
                </div>
            </div>

            <div class="card-header"></div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="ayah-tab" data-toggle="tab" href="#ayah" role="tab" aria-controls="ayah" aria-selected="true">Ayah</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ibu-tab" data-toggle="tab" href="#ibu" role="tab" aria-controls="ibu" aria-selected="false">Ibu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="wali-tab" data-toggle="tab" href="#wali" role="tab" aria-controls="wali" aria-selected="false">Wali</a>
                </li>
            </ul>
            <div class="tab-content col-sm" id="myTabContent">
                <div class="tab-pane fade show active" id="ayah" role="tabpanel" aria-labelledby="ayah-tab">

                    <div class="col-sm-12" style="display: flex; padding-top: 20px;">
                        <div class="col-sm-3">
                            <label>NIK</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ayah_nik'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ayah_nik'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Nama</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ayah_nama'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ayah_nama'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>TTL</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php $tanggalayah = ($siswa['ayah_tanggal'] != '0000-00-00') ? tgl_indo($siswa['ayah_tanggal']) : '-';
                                    $tempatayah = (!empty($siswa['ayah_tempat'])) ? $siswa['ayah_tempat'] : '-'; ?>
                                <?php echo $tempatayah . "," . $tanggalayah; ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pendidikan Terakhir</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ayah_pendidikan'])) {
                                        echo "-";
                                    } else {
                                        echo strtoupper($siswa['ayah_pendidikan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pekerjaan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ayah_pekerjaan'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ayah_pekerjaan'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Penghasilan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ayah_penghasilan'])) {
                                        echo "-";
                                    } else {
                                        echo "Rp. " . number_format($siswa['ayah_penghasilan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>No Telpon</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['no_telp_ayah'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['no_telp_ayah'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['email_ayah'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['email_ayah'];
                                    } ?></h6>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="ibu" role="tabpanel" aria-labelledby="ibu-tab">


                    <div class="col-sm-12" style="display: flex; padding-top: 20px;">
                        <div class="col-sm-3">
                            <label>NIK</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ibu_nik'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ibu_nik'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Nama</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ibu_nama'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ibu_nama'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>TTL</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php $tanggalibu = ($siswa['ibu_tanggal'] != '0000-00-00') ? tgl_indo($siswa['ibu_tanggal']) : '-';
                                    $tempatibu = (!empty($siswa['ibu_tempat'])) ? $siswa['ibu_tempat'] : '-'; ?>
                                <?php echo $tempatibu . "," . $tanggalibu; ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pendidikan Terakhir</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ibu_pendidikan'])) {
                                        echo "-";
                                    } else {
                                        echo strtoupper($siswa['ibu_pendidikan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pekerjaan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ibu_pekerjaan'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['ibu_pekerjaan'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Penghasilan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['ibu_penghasilan'])) {
                                        echo "-";
                                    } else {
                                        echo "Rp. " . number_format($siswa['ibu_penghasilan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>No Telpon</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['no_telp_ibu'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['no_telp_ibu'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['email_ibu'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['email_ibu'];
                                    } ?></h6>
                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="wali" role="tabpanel" aria-labelledby="wali-tab">


                    <div class="col-sm-12" style="display: flex; padding-top: 20px;">
                        <div class="col-sm-3">
                            <label>NIK</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['wali_nik'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['wali_nik'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Nama</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['wali_nama'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['wali_nama'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>TTL</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php $tanggalwali = ($siswa['wali_tanggal'] != '0000-00-00') ? tgl_indo($siswa['wali_tanggal']) : '-';
                                    $tempatwali = (!empty($siswa['wali_tempat'])) ? $siswa['wali_tempat'] : '-'; ?>
                                <?php echo $tempatwali . "," . $tanggalwali; ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pendidikan Terakhir</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['wali_pendidikan'])) {
                                        echo "-";
                                    } else {
                                        echo strtoupper($siswa['wali_pendidikan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Pekerjaan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['wali_pekerjaan'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['wali_pekerjaan'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Penghasilan</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['wali_penghasilan'])) {
                                        echo "-";
                                    } else {
                                        echo "Rp. " . number_format($siswa['wali_penghasilan']);
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>No Telpon</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['no_telp_wali'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['no_telp_wali'];
                                    } ?></h6>
                        </div>
                    </div>

                    <div class="col-sm-12" style="display: flex;">
                        <div class="col-sm-3">
                            <label>Email</label>
                        </div>
                        <div class="col-sm-8">
                            <h6> <?php if (empty($siswa['email_wali'])) {
                                        echo "-";
                                    } else {
                                        echo $siswa['email_wali'];
                                    } ?></h6>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>

<!-- END OF BIODATA -->
