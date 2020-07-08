<style>
	/*  Bhoechie tab */
	div.bhoechie-tab-container {
		background-color: #ffffff;
		padding: 0;
		border: 1px solid #ddd;

	}

	div.bhoechie-tab-menu {
		padding-right: 0;
		padding-left: 0;
		padding-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group {
		margin-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a {
		margin-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a .glyphicon,
	div.bhoechie-tab-menu div.list-group>a .fa {
		color: #428bca;
	}

	div.bhoechie-tab-menu div.list-group>a {
		border-right: 1px solid #ddd;
		border-left: 0;
		border-top: 0;
	}

	div.bhoechie-tab-menu div.list-group>a:last-child {
		border-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a.active,
	div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
	div.bhoechie-tab-menu div.list-group>a.active .fa {
		background-color: #428bca;
		background-image: #428bca;
		color: #ffffff;
		border-bottom: 0;
		border-right: 1px solid #428bca;
	}

	div.bhoechie-tab-menu div.list-group>a.active:after {
		content: '';
		position: absolute;
		left: 100%;
		top: 50%;
		margin-top: -13px;
		border-left: 0;
		border-bottom: 13px solid transparent;
		border-top: 13px solid transparent;
		border-left: 10px solid #428bca;
	}

	div.bhoechie-tab-content {
		background-color: #ffffff;
		padding-left: 20px;
		padding-top: 10px;
	}

	div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
		display: none;
	}

	.idp-group-item {
		min-height: 150px;
	}

	a.nav-link {
		cursor: default;
	}

	span>i {
		cursor: pointer;
	}
</style>

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
			<div class="row">
				<div class="offset-1 col-sm-10">
					<div class="card card-outline">
						<div class="card-primary card-body row bhoechie-tab-container">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
								<div class="list-group nav flex-column nav-pills">
									<a class="nav-link  list-group-item active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
										<span>MINGGU PERTAMA <br><small>04-Mar-2020</small><br></span>
										<span>Overview Part 1 (Theory)</span>
										<span>
											<i class="fa fa-fw fa-comments col-lg-2"></i>
											<i class="fa fa-fw fa-tasks col-lg-2"></i>
											<i class="fa fa-fw fa-play-circle col-lg-2"></i>
										</span>
									</a>
									<a class="nav-link  list-group-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<span>MINGGU KEDUA <br><small>04-Mar-2020</small><br>
										</span><span>Overview Part 2 (Theory)</span>
										<span>
											<i class="fa fa-fw fa-comments col-lg-2"></i>
											<i class="fa fa-fw fa-tasks col-lg-2"></i>
											<i class="fa fa-fw fa-play-circle col-lg-2"></i>
										</span>
									</a>

								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
								<div class="bhoechie-tab-content tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
									<!-- POSTINGAN GURU -->
									<div class="card-header"><label>MINGGU PERTAMA (Forum)</label></div>
									<div class="card-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque at, ullam excepturi eligendi necessitatibus assumenda ad dolores quasi ducimus! Sequi, nemo ut quia aperiam magni quam id quod autem pariatur.
										</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum eum corrupti quae perspiciatis quod modi aperiam fugit autem deleniti vitae. Voluptatem deserunt dolorem, consequuntur commodi rerum vitae. Veniam, possimus, eos.</p>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste debitis cupiditate error? Pariatur, totam at ipsam sapiente aspernatur suscipit eaque vel vero. Facere maiores doloremque iure, dolorem, possimus totam esse!</p>
										<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
									</div>


									<div class="card-header"></div>
									<!-- SESI KOMENTAR -->
									<div class="card-body">
										<!-- KOMENTAR ORANG PERTAMA -->
										<div class="row">
											<div class="col-md-2">
												<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
												<p class="text-secondary text-center">15 Minutes Ago</p>
											</div>
											<div class="col-md-10">
												<p>
													<a class="float-left" href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a>
													<span class="float-right"><i class="text-warning fa fa-star"></i></span>
													<span class="float-right"><i class="text-warning fa fa-star"></i></span>
													<span class="float-right"><i class="text-warning fa fa-star"></i></span>
													<span class="float-right"><i class="text-warning fa fa-star"></i></span>

												</p>
												<div class="clearfix"></div>
												<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
												<p>
													<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
													<a type="button" data-toggle="collapse" data-target="#komentpertama" aria-expanded="false" aria-controls="collapseExample" class="float-right btn btn-outline-warning ml-2"> <i class="fa fa-comment"></i> Komentar</a>
												</p>
											</div>
										</div>
										<!-- SUB KOMENTAR ORANG PERTAMA -->

										<div class="collapse" id="komentpertama">
											<div class="card card-inner">
												<div class="card-body">
													<div class="row">
														<div class="col-md-2">
															<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
															<p class="text-secondary text-center">15 Minutes Ago</p>
														</div>
														<div class="col-md-10">
															<p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a></p>
															<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
															<p>
																<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
															</p>
														</div>
													</div>
												</div>
											</div>

											<div class="card card-inner">
												<div class="card-body">
													<div class="row">
														<div class="col-md-2">
															<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
															<p class="text-secondary text-center">15 Minutes Ago</p>
														</div>
														<div class="col-md-10">
															<p><a href="https://maniruzzaman-akash.blogspot.com/p/contact.html"><strong>Maniruzzaman Akash</strong></a></p>
															<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
															<p>
																<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
															</p>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- KOMENTAR ORANG KEDUA -->
										<div class="row">
											<div class="card-header d-flex" style="padding-right: 0;padding-left: 0;">
												<div class="col-md-1">
													<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
												</div>
												<div class="col-md" style="line-height: 1;">
													<strong class="float-left">Maniruzzaman Akash<br><small class="text-secondary">15 Minutes Ago</small></strong>
													<small class="float-right" style="padding-top: 12px;">
														<i class="text-warning fa fa-star"></i>
														<i class="text-warning fa fa-star"></i>
														<i class="text-warning fa fa-star"></i>
														<i class="text-warning fa fa-star"></i>
													</small>
													<div class="clearfix"></div>
												</div>
											</div>
											<div class="card-body">
												<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
												<p>
													<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
													<a type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="float-right btn btn-outline-warning  ml-2">
														<i class="fa fa-comment">
														</i> Komentar</a>
												</p>
											</div>
										</div>
										<!-- SUB KOMENTAR ORANG KEDUA -->

										<div class="collapse" id="collapseExample">
											<div class="card card-inner col-lg-11 ml-5 ">
												<div class="card-header d-flex">
													<div class="col-md-1">
														<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
													</div>
													<div class="col-md" style="line-height: 1;">
														<strong class="float-left">Maniruzzaman Akash<br><small class="text-secondary">15 Minutes Ago</small></strong>
													</div>
												</div>
												<div class="card-body">
													<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
													<p>
														<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
													</p>
												</div>
											</div>
										</div>

									</div>
								</div>

								<div class="bhoechie-tab-content tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
									<div class="card-header"><label>MINGGU KEDUA</label></div>
									<div class="card-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque at, ullam excepturi eligendi necessitatibus assumenda ad dolores quasi ducimus! Sequi, nemo ut quia aperiam magni quam id quod autem pariatur.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.container -->

	</div><!-- /.content-wrapper -->

	<?php $this->load->view('siswa/v_schedule') ?>
</div>

<?php $this->load->view('siswa/layout/v_js'); ?>

<script>
	$('#myTab.nav-link').on('click', function(e) {
		e.preventDefault()
		$(this).tab('show')
	})
</script>
