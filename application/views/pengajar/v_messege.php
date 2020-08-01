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

			<!-- Tagihan -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="fas fa-fw fa-inbox fa-lg"></i> Inbox</h5>
						</div>
						<div class="card-body">
							<!-- <div class="row">
                                <table id="example1" class="table table-striped table-hover" style="font-size:12px;">
                                    <thead>
                                        <tr>
                                            <th width="10px">#</th>
                                            <th width="10%">Tanggal</th>
                                            <th>Pesan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$no = 1;
										foreach ($inbox->result_array() as $i) :
											$arr = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
											$exp = explode(' ', $i['inbox_tanggal']);
											$tgl = explode('-', $exp[0]);
											$bln = substr($tgl[1], -1) > 0 ? $arr[substr($tgl[1], -1)] : $arr[$tgl[1]];
										?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $tgl[2] . ' ' . $bln . ' ' . $tgl[0] . '<br>' . $exp[1] ?></td>
                                                <td><?= '<b>From : ' . $i['inbox_nama'] . '</b><br>' . $i['inbox_pesan'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div> -->

							<table class="table table-bordered table-hover" id="example1">
								<thead>
									<tr>
										<th style="width: 50px;">#</th>
										<th style="display: none;">id</th>
										<th style="display: none;">from</th>
										<th style="display: none;">msg</th>
										<th style="display: none;">time</th>
										<th>Pesan</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($inbox->result_array() as $ibox) :
										$diff = date_diff(date_create($ibox['inbox_tanggal']), date_create(date('Y-m-d H:i:s')));
										if ($diff->y > 0) {
											$date = date_format(date_create($ibox['inbox_tanggal']), 'd/m/y');
										} elseif ($diff->m > 1 || $diff->d > 1) {
											$date = date_format(date_create($ibox['inbox_tanggal']), 'd M');
										} else {
											$date = date_format(date_create($ibox['inbox_tanggal']), 'H:i');
										}

										$exp = explode(' ', $ibox['inbox_pesan']);
										$msg = '';
										for ($i = 0; $i < count($exp); $i++) {
											if ($i >= 10) break;
											else $msg .= $exp[$i] . ' ';
										}
									?>
										<tr style="cursor: pointer">
											<td><?= $no++ ?></td>
											<td style="display: none;"><?= $ibox['inbox_id'] ?></td>
											<td style="display: none;"><?= $ibox['inbox_nama'] ?></td>
											<td style="display: none;"><?= $ibox['inbox_pesan'] ?></td>
											<td style="display: none;"><?= date_format(date_create($ibox['inbox_tanggal']), 'd M Y H:i:s') ?></td>
											<td id="read<?= $ibox['inbox_id'] ?>" style="font-weight: <?= $ibox['inbox_status'] == 1 ? 'bold' : 'normal' ?>;">From : <?= $ibox['inbox_nama'] ?><br><?= $msg . '...' ?><span style="position: relative; float: right; top: -1.5em;"><?= $date ?></span></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="modal fade" id="modal_mail" tabindex="-1" role="dialog" aria-labelledby="modal_scheduleLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Read Mail</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div><!-- /.modal-header -->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<p class="from"></p>
					</div>
					<div class="col-sm-6">
						<p class="text-right time"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<div class="card">
							<div class="card-body msg">
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.modal-body -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<?php $this->load->view('pengajar/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

<!-- script here -->
<script>
	var table = $("#example1").DataTable({
		'ordering': false
	});
	$('#example1 tbody').on('click', 'tr', function() {
		var id = table.row(this).data()[1];
		var from = table.row(this).data()[2];
		var msg = table.row(this).data()[3];
		var time = table.row(this).data()[4];

		$.ajax({
			url: "<?= site_url('inbox/updateStatus/') ?>" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				$('#modal_mail').modal('show');
				$('#read' + id).css('font-weight', 'normal');
				$('.from').text('From : ' + from);
				$('.time').text(time);
				$('.msg').text(msg);

				$('.badge-danger').text(data.mail);
			}
		});
	});
</script>
