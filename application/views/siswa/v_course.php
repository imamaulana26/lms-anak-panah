<!-- fullcalendar css -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.css' ?>">
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
			<div class="offset-1 col-sm-10">
				<div class="row">
					<?php foreach ($course->result_array() as $val) :
						$n_forum = $this->db->get_where('tbl_materi_forum', ['id_forum' => $val['id_pelajaran']])->num_rows();
						$n_tugas = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $val['id_pelajaran']])->num_rows(); ?>
						<div class="col-sm-4">
							<div class="card mapel">
								<div class="card-img-caption">
									<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
									<strong class="card-text"><?= strtoupper($val['nm_mapel']) ?></strong>
									<!-- <p>OS1 - 1721 - ISYS6304 - THBA</p> -->
								</div>
								<div class="card-body">
									<a href="<?= site_url('forum/') . $val['id_pelajaran'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $n_forum ?> forum posting</a>
									<div class="dropdown-divider"></div>
									<a href="<?= site_url('tugas/') . $val['id_pelajaran'] ?>"><i class="fas fa-fw fa-tasks pr-1"></i> <?= $n_tugas ?> Assigment to do</a>
									<div class="dropdown-divider"></div>
									<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->

	<?php $this->load->view('siswa/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->
<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/moment/moment.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-daygrid/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-timegrid/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-interaction/main.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/fullcalendar-bootstrap/main.min.js' ?>"></script>

<!-- Bootstrap -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
<!-- jQuery UI -->
<script src="<?php echo base_url() . 'assets/fullcalendarpackage/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- END OF FULL CALENDAR PACKAGES -->
<?php $this->load->view('siswa/layout/v_js'); ?>
<script>
	$(function() {

		/* initialize the external events
		 -----------------------------------------------------------------*/
		function ini_events(ele) {
			ele.each(function() {

				// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
				// it doesn't need to have a start or end
				var eventObject = {
					title: $.trim($(this).text()) // use the element's text as the event title
				}

				// store the Event Object in the DOM element so we can get to it later
				$(this).data('eventObject', eventObject)


				// make the event draggable using jQuery UI
				$(this).draggable({
					zIndex: 1070,
					revert: true, // will cause the event to go back to its
					revertDuration: 0 //  original position after the drag


				})


			})
		}

		// SENGAJA DI COMMENT, INIT UNTUK SYNC LIST AGENDA KE CALENDAR
		ini_events($('#external-events div.external-event'))

		/* initialize the calendar
		 -----------------------------------------------------------------*/
		//Date for the calendar events (dummy data)
		var date = new Date()
		var d = date.getDate(),
			m = date.getMonth(),
			y = date.getFullYear()

		var Calendar = FullCalendar.Calendar;
		var Draggable = FullCalendarInteraction.Draggable;

		var containerEl = document.getElementById('external-events');
		var checkbox = document.getElementById('drop-remove');
		var calendarEl = document.getElementById('calendar');

		var calendar = new Calendar(calendarEl, {

			plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			'themeSystem': 'bootstrap',
			//Random default events
			events: [
				<?= $str ?>

			],
			eventTimeFormat: {
				hour: '2-digit', //2-digit, numeric
				minute: '2-digit', //2-digit, numeric
				meridiem: false, //lowercase, short, narrow, false (display of AM/PM)
				hour12: false //true, false
			},

			// CONFIG UNTUK AGENDA DAPAT DIGESER PADA CALENDAR
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			// END OF CONFIG UNTUK AGENDA DAPAT DIGESER PADA CALENDAR

			eventClick: function(event, element1) {

				event.title = event.event.title;
				event.date = event.event._instance.range.start.getFullYear() + '-' + event.event._instance.range.start.getMonth() + '-' + event.event._instance.range.start.getDate();

				// event.id = event.event.Id;
				// event.date = info.date;
				// removeEvents.(this);
				// console.log(event.event.title);
				// console.log(event.event._instance.range.start.getDate());
				// console.log(event.event._instance.range.start.getMonth());
				// console.log(event.event._instance.range.start);
				// console.log(event.date);
				// console.log(event.event.defId);
				// alert(" judulnya " + event.title);
				Swal.fire({
					icon: 'info',
					title: 'Detail',
					text: event.title
				});

			}


		});

		calendar.render();
		// $('#calendar').fullCalendar()

	})
</script>
<!-- FULL CALENDAR PACKAGES -->
