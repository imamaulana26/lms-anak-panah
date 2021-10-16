<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tugas extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_forum', 'm_forum');
		$this->load->helper('text');

		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->library('pagination');
	}

	public function index()
	{
		ob_start('ob_gzhandler');

		$akses = $this->session->userdata('akses');

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_tugas');
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_tugas');
		}
	}

	private function validasi_tugas()
	{
		$data = array();
		$data['inputerror'] = array();
		$data['error'] = array();
		$data['status'] = true;

		if ($this->input->post('judul_materi') == '') {
			$data['inputerror'][] = 'judul_materi';
			$data['error'][] = 'Judul tugas harus diisi';
			$data['status'] = false;
		}

		// if ($this->input->post('isi_materi') == '') {
		// 	$data['inputerror'][] = 'isi_materi';
		// 	$data['error'][] = 'Isi tugas harus diisi';
		// 	$data['status'] = false;
		// } else if (!preg_match('/^[a-zA-Z0-9,. ]+$/', strtoupper($this->input->post('isi_materi')))) {
		// 	$data['inputerror'][] = 'isi_materi';
		// 	$data['error'][] = 'Isi tugas tidak valid';
		// 	$data['status'] = false;
		// }

		if ($data['status'] === false) {
			echo json_encode($data);
			exit();
		}
	}

	public function tugas($id)
	{
		$akses = $this->session->userdata('akses');

		$data['forum'] = $this->m_forum->get_forum($id);
		$data['tugas'] = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $id])->result_array();

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_tugas', $data);
			$this->load->view('siswa/layout/v_footer');
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_tugas', $data);
		}
	}
	// public function tugas_sg($id, $ke)
	// {


	// 	$dt_tottgs = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $id, 'pertemuan' => $ke])->num_rows();


	// 	//setup pagination
	// 	$config['base_url'] = base_url('tugas/tugas_sg/') . $id . "/" . $ke;
	// 	$config['total_rows'] = $dt_tottgs;
	// 	$config['per_page'] = 5;
	// 	$config['num_links'] = 3;
	// 	//styling
	// 	$config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
	// 	$config['full_tag_close'] = '</ul></nav>';

	// 	$config['first_link'] = 'First';
	// 	$config['first_tag_open'] = ' <li class="page-item">';
	// 	$config['first_tag_close'] = '</li>';

	// 	$config['last_link'] = 'Last';
	// 	$config['last_tag_open'] = ' <li class="page-item">';
	// 	$config['last_tag_close'] = '</li>';

	// 	$config['next_link'] = '&raquo';
	// 	$config['next_tag_open'] = ' <li class="page-item">';
	// 	$config['next_tag_close'] = '</li>';

	// 	$config['prev_link'] = '&laquo';
	// 	$config['prev_tag_open'] = ' <li class="page-item">';
	// 	$config['prev_tag_close'] = '</li>';

	// 	$config['cur_tag_open'] = ' <li class="page-item active"> <a class="page-link" href="#">';
	// 	$config['cur_tag_close'] = '</a></li>';

	// 	$config['num_tag_open'] = ' <li class="page-item">';
	// 	$config['num_tag_close'] = '</li>';

	// 	$config['attributes'] = array('class' => 'page-link');

	// 	// inisialisasi
	// 	$this->pagination->initialize($config);

	// 	//load db
	// 	$data['dt_komen'] = $this->db->select('user_komen,siswa_nama,isi_komen,lampiran,id')->from('tbl_komen_tugas a')->join('tbl_siswa b', 'a.user_komen = b.siswa_nis')->where(['a.id_forum' => $id, 'a.pertemuan' => $ke])->order_by('a.id', 'desc')->limit($config['per_page'], $this->uri->segment(5))->get()->result_array();
	// 	//end
	// 	// var_dump($dt_tottgs);
	// 	// die;
	// 	// $data['tugas'] = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $id])->result_array();
	// 	$data['tugas'] = $this->db->select('judul_materi,nm_mapel,jns_materi,isi_materi,d.kelas_nama')->from('tbl_materi_tugas a')->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran')->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel')->join('tbl_kelas d', 'b.id_kelas = d.kelas_id')->where(['a.id_forum' => $id, 'a.pertemuan' => $ke])->get()->row_array();
	// 	$data['total'] = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $id])->num_rows();


	// 	$this->load->view('pengajar/layout/v_header');
	// 	$this->load->view('pengajar/layout/v_navbar');
	// 	$this->load->view('pengajar/superguru/v_tugas', $data);
	// }

	public function tugas_sg($id, $ke)
	{
		$data['tugas'] = $this->db->select('a.judul_materi, c.nm_mapel, a.jns_materi, a.isi_materi, d.kelas_nama, a.createDate, a.endDate')->from('tbl_materi_tugas a')
			->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel')
			->join('tbl_kelas d', 'b.id_kelas = d.kelas_id')
			->where(['a.id_forum' => $id, 'a.pertemuan' => $ke])->get()->row_array();

		$data['total'] = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $id])->num_rows();

		$data['komen_bn'] = $this->db->select('distinct(count(a.user_komen)) as jml')->from('tbl_komen_tugas a')
			->join('tbl_nilai_onclass b', 'a.user_komen = b.user_siswa and a.id_forum = b.id_pelajaran and a.pertemuan = b.pertemuan_ke', 'left')
			->where(['a.id_forum' => $id, 'a.pertemuan' => $ke, 'b.nilai' => null])
			->get()->row_array();

		$data['komen_sn'] = $this->db->select('distinct(count(a.user_komen)) as jml')->from('tbl_komen_tugas a')
			->join('tbl_nilai_onclass b', 'a.user_komen = b.user_siswa and a.id_forum = b.id_pelajaran and a.pertemuan = b.pertemuan_ke', 'left')
			->where(['a.id_forum' => $id, 'a.pertemuan' => $ke, 'b.nilai !=' => null])
			->get()->row_array();

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_tugas', $data);
	}

	public function sk_detail($id_mapel, $pertemuan, $id_reply)
	{
		$data['main_komen'] = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $id_mapel, 'pertemuan' => $pertemuan, 'id' => $id_reply])->row_array();
		$data['sk_detail'] = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $id_mapel, 'pertemuan' => $pertemuan, 'reply_to' => $id_reply])->result_array();
		
		$this->load->view('pengajar/v_sk_detail', $data);
	}

	function fetch() //belum dinilai
	{
		$output = '';

		$data = $this->db->select('a.user_komen, c.siswa_nama, a.isi_komen, a.lampiran, a.id, a.createDate')->from('tbl_komen_tugas a')
			->join('tbl_nilai_onclass b', 'a.user_komen = b.user_siswa and a.id_forum = b.id_pelajaran and a.pertemuan = b.pertemuan_ke', 'left')
			->join('tbl_siswa c', 'a.user_komen = c.siswa_nis')
			->where(['a.id_forum' => $this->input->post('id_tugas'), 'a.pertemuan' => $this->input->post('pertemuan'), 'b.nilai' => null])
			->order_by('a.id', 'desc')->limit($this->input->post('limit'), $this->input->post('start'))->get();

		if ($data->num_rows() > 0) {
			foreach ($data->result_array() as $val) {
				$check = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $this->input->post('id_tugas'), 'pertemuan' => $this->input->post('pertemuan'), 'reply_to' => $val['id']])->num_rows();

				$sql = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $val['user_komen'], 'id_pelajaran' => $this->input->post('id_tugas'), 'pertemuan_ke' => $this->input->post('pertemuan')]);
				$result = $sql->row_array();

				$nilai = $sql->num_rows() > 0 ? '(' . $result['nilai'] . ' point)' : '';

				$lampiran = '';
				if (!empty($val['lampiran'])) :
					$lampiran .= '<p><b>Lampiran</b></p>';
					if (is_array(unserialize($val['lampiran']))) :
						foreach (unserialize($val['lampiran']) as $att) :
							$lampiran .= '<a href="' . $att . '" data-toggle="lightbox" data-gallery="gallery-' . $val['id'] . '">
											<img src="' . $att . '" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
										</a>';
						endforeach;
					else :
						$lampiran .= '<a href="' . unserialize($val['lampiran']) . '" data-toggle="lightbox" data-gallery="gallery-' . $val['id'] . '">
										<img src="' . unserialize($val['lampiran']) . '" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
									</a>';
					endif;
				endif;

				$output .= '<div class="card-header bordered mt-3 d-flex">
									<div class="col-md-1">
										<img class="media-img-width" src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" style="width: 100%;" />
									</div>
									<div class="col-md">
										<strong class="float-left">' . $val['siswa_nama'] . ' ' . $nilai . '</strong>
										<small class="float-right text-secondary">
											<div class="dropdown mx-1">
												<a href="#" class="btn btn-link btn-xs" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fa fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="javascript:void(0)" onclick="nilai(\'' . $val['id'] . '\')" style="font-size: 12px; color: #007bff;">
														<i class="fa fa-fw fa-check-square"></i> Nilai
													</a>
													<a class="dropdown-item" href="#" style="font-size: 12px; color: #1e7e34;">
														<i class="fa fa-fw fa-pencil-alt"></i> Sunting
													</a>
													<a class="dropdown-item" href="javascript:void(0)" onclick="hapus_komen(\'' . $val['id'] . '\')" style="font-size: 12px; color: #dc3545;">
														<i class="fa fa-fw fa-times"></i> Hapus
													</a>
												</div>
											</div>
										</small>
										<small class="float-right text-secondary">' . date('d M y', strtotime($val['createDate'])) . '</small>
										<div class="clearfix"></div>
									</div>
								</div>
						
								<div class="card-body bordered pb-0">
									<p>
										' . $val['isi_komen'] . '
									</p>

									' . $lampiran . '
									
									<div>
										<a class="float-right btn btn-sm" onclick="balas_komen(\'' . $val['id'] . '\')">
											<i class="fa fa-fw fa-reply"></i> Balas
										</a>
										<a href="' . site_url('tugas/sk_detail/' . $this->input->post('id_tugas') . '/' . $this->input->post('pertemuan') . '/' . $val['id']) . '" target="_blank">
											<i class="fa fa-fw fa-comments"></i> Komentar (' . $check . ')
										</a>
									</div>
								</div>';
			}
		}
		echo $output;
	}

	function fetch_sn() //sudah dinilai
	{
		$output = '';

		$data = $this->db->select('a.user_komen, c.siswa_nama, a.isi_komen, a.lampiran, a.id, a.createDate')->from('tbl_komen_tugas a')
			->join('tbl_nilai_onclass b', 'a.user_komen = b.user_siswa and a.id_forum = b.id_pelajaran and a.pertemuan = b.pertemuan_ke', 'left')
			->join('tbl_siswa c', 'a.user_komen = c.siswa_nis')
			->where(['a.id_forum' => $this->input->post('id_tugas'), 'a.pertemuan' => $this->input->post('pertemuan'), 'b.nilai !=' => null])
			->order_by('a.id', 'desc')->limit($this->input->post('limit'), $this->input->post('start'))->get();

		if ($data->num_rows() > 0) {
			foreach ($data->result_array() as $val) {
				$check = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $this->input->post('id_tugas'), 'pertemuan' => $this->input->post('pertemuan'), 'reply_to' => $val['id']])->num_rows();

				$sql = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $val['user_komen'], 'id_pelajaran' => $this->input->post('id_tugas'), 'pertemuan_ke' => $this->input->post('pertemuan')]);
				$result = $sql->row_array();

				$nilai = $sql->num_rows() > 0 ? '(' . $result['nilai'] . ' point)' : '';

				$lampiran = '';
				if (!empty($val['lampiran'])) :
					$lampiran .= '<p><b>Lampiran</b></p>';
					if (is_array(unserialize($val['lampiran']))) :
						foreach (unserialize($val['lampiran']) as $att) :
							$lampiran .= '<a href="' . $att . '" data-toggle="lightbox" data-gallery="gallery-' . $val['id'] . '">
											<img src="' . $att . '" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
										</a>';
						endforeach;
					else :
						$lampiran .= '<a href="' . unserialize($val['lampiran']) . '" data-toggle="lightbox" data-gallery="gallery-' . $val['id'] . '">
										<img src="' . unserialize($val['lampiran']) . '" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
									</a>';
					endif;
				endif;

				$output .= '<div id="komen_sn" class="card-header bordered mt-3 d-flex">
									<div class="col-md-1">
										<img class="media-img-width" src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" style="width: 100%;" />
									</div>
									<div class="col-md">
										<strong class="float-left">' . $val['siswa_nama'] . ' ' . $nilai . '</strong>
										<small class="float-right text-secondary">
											<div class="dropdown mx-1">
												<a href="#" class="btn btn-link btn-xs" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<i class="fa fa-ellipsis-v"></i>
												</a>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="javascript:void(0)" onclick="nilai(\'' . $val['id'] . '\')" style="font-size: 12px; color: #007bff;">
														<i class="fa fa-fw fa-check-square"></i> Nilai
													</a>
													<a class="dropdown-item" href="#" style="font-size: 12px; color: #1e7e34;">
														<i class="fa fa-fw fa-pencil-alt"></i> Sunting
													</a>
													<a class="dropdown-item" href="javascript:void(0)" onclick="hapus_komen(\'' . $val['id'] . '\')" style="font-size: 12px; color: #dc3545;">
														<i class="fa fa-fw fa-times"></i> Hapus
													</a>
												</div>
											</div>
										</small>
										<small class="float-right text-secondary">' . date('d M y', strtotime($val['createDate'])) . '</small>
										<div class="clearfix"></div>
									</div>
								</div>
						
								<div id="komen_sn" class="card-body bordered pb-0">
									<p>
										' . $val['isi_komen'] . '
									</p>

									' . $lampiran . '
									
									<div>
										<a class="float-right btn btn-sm" onclick="balas_komen(\'' . $val['id'] . '\')">
											<i class="fa fa-fw fa-reply"></i> Balas
										</a>
										<a href="' . site_url('tugas/sk_detail/' . $this->input->post('id_tugas') . '/' . $this->input->post('pertemuan') . '/' . $val['id']) . '" target="_blank">
											<i class="fa fa-fw fa-comments"></i> Komentar (' . $check . ')
										</a>
									</div>
								</div>';
			}
		}
		echo $output;
	}

	public function get_siswa($nis)
	{
		if ($nis != 'NULL') {
			$data = $this->m_forum->get_siswa($nis);
			echo json_encode($data);
			exit;
		}
	}

	function data_id($id)
	{
		if ($_SESSION['akses'] == 3) {
			$qry = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $id])->result_array();
		} else {
			$qry = $this->db->get_where('tbl_komen_tugas', ['id_forum' => $id, 'user_komen' => $_SESSION['username']])->result_array();
		}
		echo json_encode($qry);
		exit();
	}

	function datafr_id($id)
	{
		$qry = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $id])->result_array();
		echo json_encode($qry);
		exit();
	}

	public function tambah_tugas($id)
	{
		$this->db->select('*')->from('tbl_pelajaran a')
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'inner')
			->where(['a.id_pelajaran' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_tambah_tugas', $data);
	}

	public function edit_tugas($id)
	{
		$this->db->select('*')->from('tbl_materi_tugas a')
			->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->where(['a.id' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/v_edit_tugas', $data);
	}

	public function delete_tugas($id)
	{
		$this->db->delete('tbl_materi_tugas', ['id' => $id]);
		echo json_encode(['status' => true]);
		exit;
	}

	public function save_tugas()
	{
		$this->validasi_tugas();
		$cond = !empty($this->session->userdata('lampiran')) ? serialize($this->session->userdata('lampiran')) : NULL;
		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			$kd_mapel = $this->input->post('kd_mapel');

			$data = array(
				'id_forum' => $kd_mapel,
				'judul_materi' => $this->input->post('judul_materi'),
				'jns_materi' => $this->input->post('tipe_forum'),
				'isi_materi' => $this->input->post('isi_materi'),
				'lampiran' => $cond
			);

			$cek = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $kd_mapel]);
			if ($cek->num_rows() > 0) {
				$count = $cek->num_rows() + 1;

				$data['pertemuan'] = $count;

				$this->db->insert('tbl_materi_tugas', $data);
			} else {
				$data['pertemuan'] = 1;
				$this->db->insert('tbl_forum', ['fr_id_pelajaran' => $kd_mapel]);

				$this->db->insert('tbl_materi_tugas', $data);
			}
			$this->session->set_flashdata('msg', 'success');
			// $this->diskusi($kd_mapel);
			$this->session->unset_userdata('lampiran');
			echo json_encode(['status' => true, 'id' => $data['id_forum']]);
			exit;
		}
	}

	public function update_tugas()
	{
		$this->validasi_tugas();

		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			if ($this->session->userdata('lampiran') != null) {
				$data = array(
					'judul_materi' => $this->input->post('judul_materi'),
					'jns_materi' => $this->input->post('tipe_forum'),
					'isi_materi' => $this->input->post('isi_materi'),
					'lampiran' => serialize($this->session->userdata('lampiran'))
				);
			} else {
				$data = array(
					'judul_materi' => $this->input->post('judul_materi'),
					'jns_materi' => $this->input->post('tipe_forum'),
					'isi_materi' => $this->input->post('isi_materi')
				);
			}

			$this->db->update('tbl_materi_tugas', $data, ['id' => $this->input->post('id_fm')]);
			$this->session->unset_userdata('lampiran');
			$this->session->set_flashdata('msg', 'success');
			// $this->diskusi($kd_mapel);
			echo json_encode(['status' => true, 'id' => $this->input->post('kd_mapel')]);
			exit;
		}
	}

	public function upd_status($id)
	{
		$msg = '';
		$cek = $this->db->get_where('tbl_materi_tugas', ['id' => $id])->row_array();
		if ($cek['status'] == 0) {
			$this->db->update('tbl_materi_tugas', ['status' => 1], ['id' => $id]);
			$msg = 'di non-aktifkan';
		} else {
			$this->db->update('tbl_materi_tugas', ['status' => 0], ['id' => $id]);
			$msg = 'di aktifkan';
		}
		echo json_encode(['msg' => 'Tugas berhasil ' . $msg . '!']);
		exit;
	}

	public function upload()
	{
		$status = false;
		$lampiran = array();

		$count = count($_FILES['lampiran']['name']);
		for ($i = 0; $i < $count; $i++) {
			if (!empty($_FILES['lampiran']['name'][$i])) {
				$file_name = $_FILES['lampiran']['name'][$i];
				$file_type = $_FILES['lampiran']['type'][$i];
				$file_tmp_name = $_FILES['lampiran']['tmp_name'][$i];

				move_uploaded_file($file_tmp_name, './assets/files/' . $file_name);
				$img = 'data:' . $file_type . ';base64,' . base64_encode(file_get_contents('./assets/files/' . $file_name));
				$lampiran[] = $img;

				unlink('./assets/files/' . $file_name);

				$this->session->set_userdata(['lampiran' => $lampiran]);

				$status = true;
			} else {
				$status = false;
			}
		}

		if ($status == true) {
			echo json_encode(['status' => true, 'title' => 'Sukses', 'icon' => 'success', 'msg' => 'Gambar berhasil di upload', 'lampiran' => $lampiran]);
			exit;
		} else {
			echo json_encode(['status' => false, 'title' => 'Opps!', 'icon' => 'warning', 'msg' => 'Tidak ada file untuk di upload!']);
			exit;
		}
	}

	public function get_komen($key)
	{

		$data['komen'] = $this->db->select('b.siswa_nis, b.siswa_nama, c.kelas_nama, e.id_pelajaran, f.nm_mapel, a.pertemuan, a.isi_komen, a.lampiran, d.judul_materi, d.jns_materi')
			->from('tbl_komen_tugas a')
			->join('tbl_siswa b', 'a.user_komen = b.siswa_nis', 'inner')
			->join('tbl_kelas c', 'b.siswa_kelas_id = c.kelas_id', 'left')
			->join('tbl_materi_tugas d', 'a.id_forum = d.id_forum and a.pertemuan = d.pertemuan', 'inner')
			->join('tbl_pelajaran e', 'e.id_pelajaran = a.id_forum', 'inner')
			->join('tbl_mapel f', 'e.kd_mapel = f.kd_mapel', 'inner')
			->where(['a.id' => $key])->get()->row_array();

		$data['nilai'] = $this->db->get_where(
			'tbl_nilai_onclass',
			[
				'user_siswa' => $data['komen']['siswa_nis'],
				'id_pelajaran' => $data['komen']['id_pelajaran'],
				'pertemuan_ke' => $data['komen']['pertemuan'],
				'tipe' => 'Tugas'
			]
		)->row_array();

		echo json_encode($data);
		exit;
	}

	//tambahan baru
	function attendent_nilai($key, $mgg)
	{

		$where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
		$mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();


		$sql = $this->db->distinct()->select('siswa_nama,siswa_nis,kelas_nama')->from('tbl_siswa a')->join('tbl_komen_tugas b', 'a.siswa_nis=b.user_komen', 'inner')->join('tbl_kelas c', 'a.siswa_kelas_id=c.kelas_id', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->get()->result_array();

		$data['nm_mapel'] = $mapel['nm_mapel'];
		$data['dt_siswa'] = $sql;

		$this->load->view('pengajar/layout/v_header');
		$this->load->view('pengajar/layout/v_navbar');
		$this->load->view('pengajar/nilai/v_nilai_tgs', $data);
	}
	//end of tambahan baru

	public function submit_nilai()
	{
		$nilai = $this->input->post('nilai_siswa');
		$where = array(
			'user_siswa' => $this->input->post('nis_siswa'),
			'id_pelajaran' => $this->input->post('tugas_id'),
			'pertemuan_ke' => $this->input->post('tugas_ke'),
			'tipe' => 'Tugas'
		);
		$cek = $this->db->get_where('tbl_nilai_onclass', $where)->num_rows();

		$data = array(
			'user_siswa' => $this->input->post('nis_siswa'),
			'id_pelajaran' => $this->input->post('tugas_id'),
			'pertemuan_ke' => $this->input->post('tugas_ke'),
			'nilai' => $this->input->post('nilai_siswa'),
			'komen' => $this->input->post('komen_tugas'),
			'lampiran' => $this->input->post('lamp_tugas'),
			'tipe' => 'Tugas'
		);

		if ($nilai < 10 || $nilai > 100) {
			$msg = array(
				'status' => false,
				'text' => 'Input nilai invalid!'
			);
			$this->session->set_flashdata('msg', $msg);
		} else {
			if ($cek > 0) {
				$data['updateDate'] = date('Y-m-d');
				$this->db->update('tbl_nilai_onclass', $data, $where);
			} else {
				$data['createDate'] = date('Y-m-d');
				$this->db->insert('tbl_nilai_onclass', $data);
			}

			$msg = array(
				'status' => true,
				'text' => 'Nilai berhasil tersimpan'
			);

			$this->session->set_flashdata('msg', $msg);
		}

		redirect(site_url('course'));
		// redirect(site_url('tugas/attendent_nilai/' . $data['id_pelajaran'] . '/' . $this->input->post('idk')));
	}


	public function submit_main()
	{
		$komen = $this->input->post('komentar');
		// $id = $this->input->post('id');

		if (!empty($komen)) {
			if (!empty($_FILES['gambar']['name'])) {
				$config = array(
					'upload_path' => './assets/files',
					'allowed_types' => 'png|jpg|jpeg',
					'encrypt_name' => true
				);

				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('gambar')) {
					$file = array('upload_data' => $this->upload->data());

					$image = $file['upload_data']['file_name'];

					$data = array(
						'id_forum' => $this->input->post('id_forum'),
						'pertemuan' => $this->input->post('pertemuan'),
						'reply_to' => 0,
						'user_komen' => $this->input->post('user_komen'),
						'isi_komen' => $komen,
						'lampiran' => serialize('data:' . $file['upload_data']['file_type'] . ';base64,' . base64_encode(file_get_contents($config['upload_path'] . '/' . $image)))
					);
					unlink($config['upload_path'] . '/' . $image);
				}
			} else {
				$data = array(
					'id_forum' => $this->input->post('id_forum'),
					'pertemuan' => $this->input->post('pertemuan'),
					'reply_to' => 0,
					'user_komen' => $this->input->post('user_komen'),
					'isi_komen' => $komen
				);
			}


			$this->db->insert('tbl_komen_tugas', $data);

			$cek_log = $this->db->get_where('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
			if ($cek_log->num_rows() > 0) {
				$log = $cek_log->row_array();
				$exp = explode('::', $log['log_tugas']);

				if ($log['log_tugas'] != '') {
					if (in_array($data['pertemuan'], $exp)) {
						$isi_log = $log['log_tugas'];
					} else {
						$isi_log = $log['log_tugas'] . '::' . $data['pertemuan'];
					}
					$this->db->update('tbl_log_forum', ['log_tugas' => $isi_log], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				} else {
					$this->db->update('tbl_log_forum', ['log_tugas' => $data['pertemuan']], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				}
			} else {
				$this->db->insert('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum'], 'log_tugas' => $data['pertemuan']]);
			}

			$this->session->set_flashdata('page', $data['pertemuan']);
			// $this->session->set_flashdata('mention', ($id - 1));
			$this->session->set_flashdata('msg', 'success');
			redirect(site_url('tugas/tugas_sg/' . $data['id_forum'] . '/' . $data['pertemuan']));
		}
	}

	public function submit_komen()
	{
		$komen = $this->input->post('komentar');
		// $id = $this->input->post('id');

		if (!empty($komen)) {
			if (!empty($_FILES['gambar']['name'])) {
				$config = array(
					'upload_path' => './assets/files',
					'allowed_types' => 'png|jpg|jpeg',
					'encrypt_name' => true
				);

				$this->load->library('upload', $config);

				// File upload
				if ($this->upload->do_upload('gambar')) {
					$file = array('upload_data' => $this->upload->data());

					$image = $file['upload_data']['file_name'];

					$data = array(
						'id_forum' => $this->input->post('id_forum'),
						'id_reply' => $this->input->post('id_reply'),
						'pertemuan' => $this->input->post('pertemuan'),
						'reply_to' => $this->input->post('reply_to'),
						'mention' => $this->input->post('mention'),
						'user_komen' => $this->input->post('user_komen'),
						'isi_komen' => $this->input->post('komentar'),
						'lampiran' => serialize('data:' . $file['upload_data']['file_type'] . ';base64,' . base64_encode(file_get_contents($config['upload_path'] . '/' . $image)))
					);
					unlink($config['upload_path'] . '/' . $image);
				}
			} else {
				$data = array(
					'id_forum' => $this->input->post('id_forum'),
					'id_reply' => $this->input->post('id_reply'),
					'pertemuan' => $this->input->post('pertemuan'),
					'reply_to' => $this->input->post('reply_to'),
					'mention' => $this->input->post('mention'),
					'user_komen' => $this->input->post('user_komen'),
					'isi_komen' => $this->input->post('komentar')
				);
			}

			$this->db->insert('tbl_komen_tugas', $data);

			$cek_log = $this->db->get_where('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
			if ($cek_log->num_rows() > 0) {
				$log = $cek_log->row_array();
				$exp = explode('::', $log['log_tugas']);

				if ($log['log_tugas'] != '') {
					if (in_array($data['pertemuan'], $exp)) {
						$isi_log = $log['log_tugas'];
					} else {
						$isi_log = $log['log_tugas'] . '::' . $data['pertemuan'];
					}
					$this->db->update('tbl_log_forum', ['log_tugas' => $isi_log], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				} else {
					$this->db->update('tbl_log_forum', ['log_tugas' => $data['pertemuan']], ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum']]);
				}
			} else {
				$this->db->insert('tbl_log_forum', ['nisn_siswa' => $data['user_komen'], 'id_forum' => $data['id_forum'], 'log_tugas' => $data['pertemuan']]);
			}

			$this->session->set_flashdata('page', $data['pertemuan']);
			$this->session->set_flashdata('mention', $data['reply_to']);
			$this->session->set_flashdata('msg', 'success');
			redirect(site_url('tugas/tugas_sg/' . $data['id_forum'] . '/' . $data['pertemuan']));
		}
	}

	public function delete_komen($id)
	{
		$data = $this->db->get_where('tbl_komen_tugas', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komen_tugas', ['id' => $id]);
		$this->db->delete('tbl_komen_tugas', ['reply_to' => $id]);

		echo json_encode([
			'msg' => 'Komentar berhasil dihapus!'
		]);
		exit;
	}

	public function delete_subkomen($id)
	{
		$data = $this->db->get_where('tbl_komen_tugas', ['id' => $id])->row_array();

		$this->session->set_flashdata('page', $data['pertemuan']);

		$this->db->delete('tbl_komen_tugas', ['id' => $id]);

		echo json_encode([
			'msg' => 'Komentar berhasil dihapus!'
		]);
		exit;
	}

	public function edit_komen($id)
	{
		$this->db->select('*')->from('tbl_komen_tugas a')
			->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran', 'left')
			->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
			->where(['a.id' => $id]);
		$res = $this->db->get()->row_array();

		$data = array(
			'title' => 'Tugas',
			'data' => $res
		);

		$this->load->view('pengajar/layout/v_header');
		if ($this->session->userdata('akses') == 3) {
			$this->load->view('pengajar/layout/v_navbar');
		} else {
			$this->load->view('siswa/layout/v_navbar');
		}
		$this->load->view('pengajar/v_edit_komen', $data);
	}

	public function update_komen()
	{
		if ($this->session->userdata('lampiran') != null) {
			$data = array(
				'isi_komen' => $this->input->post('isi_materi'),
				'lampiran' => serialize($this->session->userdata('lampiran'))
			);
		} else {
			$data = array(
				'isi_komen' => $this->input->post('isi_materi')
			);
		}

		$this->db->update('tbl_komen_tugas', $data, ['id' => $this->input->post('id_fm')]);
		$this->session->unset_userdata('lampiran');

		echo json_encode(['status' => true, 'id' => $this->input->post('kd_mapel')]);
		exit;
	}
}
