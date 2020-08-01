<?php
$layout = array('header', 'navbar');
foreach ($layout as $layout) {
	$this->load->view('pengajar/layout/' . $layout);
}
?>
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

	iframe {
		width: 100%;
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
										<span><br><i class="fa fa-comments col-lg-2"></i><i class="fa fa-tasks col-lg-2"></i><i class="fa fa-youtube col-lg-2"></i></span>

									</a>
									<a class="nav-link  list-group-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
										<span>MINGGU KEDUA <br><small>04-Mar-2020</small><br>
										</span><span>Overview Part 2 (Theory)</span>
										<span><br><i class="fa fa-comments col-lg-2"></i><i class="fa fa-tasks col-lg-2"></i><i class="fa fa-youtube col-lg-2"></i></span>
									</a>

								</div>
							</div>

							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
								<div class="bhoechie-tab-content tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
									<!-- POSTINGAN GURU -->
									<div class="card-header"><label>MINGGU PERTAMA (Live Streaming)</label></div>
									<div class="card-body">
										<!-- lokasi embed -->
										<iframe width="560" height="315" src="https://www.youtube.com/embed/9HNNI8D-UCY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
			<!-- /.container -->

		</div><!-- /.content-wrapper -->

		<?php $this->load->view('pengajar/v_schedule') ?>

		<?php
		$layout = array('footer', 'js');
		foreach ($layout as $layout) {
			$this->load->view('pengajar/layout/' . $layout);
		}
		?>

		<script>
			$('#myTab a').on('click', function(e) {
				e.preventDefault()
				$(this).tab('show')
			})
		</script>
