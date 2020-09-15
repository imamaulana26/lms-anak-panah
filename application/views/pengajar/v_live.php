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
			<!-- Kelas Online -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Agenda Kelas Online</h5>
						</div>
						<div class="card-body ">
							<div class="row">
								<?php foreach ($oc as $online) {
									?>
									<div class="col-sm-4">
										<div class="card" style="height: 21%">
											<?php if ($online['aktifkan']==1) {
												?>
												<a href="<?= $online['link_oc']  ?>">
													<div class="card-header bg-primary">
														<i class="fas fa-fw fa-video mr-1 blink_me" style="color: #f72121"></i> Sedang Berlangsung
													</div>
												</a>
											<?php } else{ ?>
												<div class="card-header bg-light">
													<i class="fas fa-fw fa-video mr-1"></i> Belum Dimulai
												</div>
											<?php } ?>
											
											<div class="m-3">
												<p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> <?= $online['nm_mapel']  ?></p>
												<p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= $online['tgl_oc'] ?></p>
												<p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> <?= $online['time_start'] ?> - <?= $online['time_end'] ?></p>
											</div>
										</div>
									</div>
								<?php } ?>
								<!-- <div class="col-sm-4">
									<div class="card" style="height: 21%">
										<div class="card-header bg-light">
											<i class="fas fa-fw fa-video mr-1"></i> Belum Dimulai
										</div>
										<div class="m-3">
											<p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> Bahasa Indonesia (SPOK)</p>
											<p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= date('d M Y'); ?></p>
											<p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> 10:20 - 11:10</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="card" style="height: 21%">
										<div class="card-header bg-light">
											<i class="fas fa-fw fa-video mr-1"></i> Belum Dimulai
										</div>
										<div class="m-3">
											<p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> Bahasa Inggris (Past Tense)</p>
											<p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= date('d M Y'); ?></p>
											<p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> 19:20 - 20:10</p>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<!-- End Of Kelas Online -->
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->

	<?php $this->load->view('pengajar/v_kelasonline'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script type="text/javascript">
	function view(id){
		$.ajax({
			url: '<?= site_url('course/view/') ?>'+id,
			type: 'post',
			dataType: 'json',
			success: function(data){
				$('#modal_kelasonline').modal('show');
				$('.modal-title').text(data.nm_mapel + ' ('+data.kelas_nama+')');

				$('#id').val(id);
				$('#jdl_kelas').val(data.tgl_oc);
				$('#link_oc').val(data.link_oc);
				$('#start_on').val(data.time_start);
				$('#end_on').val(data.time_end);
				$('input:radio[name=opsi_kls][value='+data.aktifkan+']')[0].checked = true;
			}
		});
	}

	function submit(){
		$.ajax({
			url: '<?= site_url('course/update_oc/') ?>',
			type: 'post',
			dataType: 'json',
			data:$('#fm_oc').serialize(),
			beforeSend: function() {
				$('.btn').html('<i class="fa fa-spin fa-spinner"></i> loading');
			},
			success:function(data){
				alert(data.msg);
				location.reload();
			} 	
		})
	}
</script>
