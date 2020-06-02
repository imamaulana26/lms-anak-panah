<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
	}


	function index()
	{
		$this->load->view('admin/v_mapel');
	}


	function save_mapel()
	{
		$kelas = $this->input->post('kelasId');
		$mapel = $this->input->post('mapelId');

		$data = array(
			'id_kelas' => $kelas,
			'kd_mapel' => $mapel
		);

		$list = $this->db->get_where('tbl_pelajaran', $data);
		if ($list->num_rows() > 0) {
			$this->db->delete('tbl_pelajaran', $data);
		} else {
			$this->db->insert('tbl_pelajaran', $data);
		}

		$this->session->set_flashdata('info', 'Data has been changed!');
	}


	function setting_mapel($id)
	{
		$this->load->helper('my_helper');

		$data['kelas'] = $this->db->get_where('tbl_kelas', ['kelas_id' => $id])->row_array();
		$data['mapel'] = $this->db->get_where('tbl_mapel', ['status_mapel' => 1])->result_array();

		$this->load->view('admin/v_setting_mapel', $data);
	}
}
