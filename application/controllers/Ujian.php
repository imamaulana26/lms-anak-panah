<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujian extends CI_Controller
{
	private $url = 'http://localhost/lms-rest-server/api/ujian';

	public function http_request($url, $param = null)
	{
		// persiapan curl
		$ch = curl_init();

		// set url
		curl_setopt($ch, CURLOPT_URL, $url . $param);

		// return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);

		curl_close($ch);

		return json_decode($output, true);
	}

	// public function index()
	// {
	// 	$param = '?kelas=' . $_SESSION['kelas'];
	// 	$page = 'siswa/v_ujian';

	// 	$data['respon'] = $this->http_request($this->url, $param);

	// 	$this->load->view('siswa/layout/v_header');
	// 	$this->load->view('siswa/layout/v_navbar');
	// 	$this->load->view($page, $data);
	// 	$this->load->view('siswa/layout/v_footer');
	// }


	public function detail_soal($id)
	{
		var_dump($_SESSION); die;
		
		$param = '/detail_soal?id_soal=' . $id;
		$page = 'siswa/v_detail_soal';

		$respon_api = $this->http_request($this->url, $param);

		$data['respon'] = $this->db->select('*')->from('tbl_pelajaran a')
			->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
			->join('tbl_pengajar c', 'a.kd_pengajar = c.id_pengajar', 'left')
			->where(['a.id_pelajaran' => $respon_api['data']['modul_pelajaran']])->get()->row_array();

		var_dump($data);
		die;

		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view($page, $data);
		$this->load->view('siswa/layout/v_footer');
	}
}
