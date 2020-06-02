<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kisikisi extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
			$url=base_url('login');
			redirect($url);
		};
		$this->load->model('m_pengunjung');
	}


	function index(){
		if($this->session->userdata('akses')=='1'){
			$this->load->view('admin/v_kisikisi');
		}else{
			$this->load->view('admin/v_kisikisi_siswa');
		}

	}

	function setting_kelas($id){
		$result = $this->db->get_where('tbl_kelas',['kelas_id'=>$id])->result_array();
		echo json_encode($result);
		exit;
	}
		function hapus_kisikisi($id){
		$result = $this->db->delete('tbl_kisikisi',['kisikisi_id'=>$id]);
		echo json_encode($result);
		exit;
	}

	function save_kisikisi(){
		$data = array(
			'kisikisi_ub'=> $this->input->post('ub'),
			'kisikisi_deskripsi'=>$this->input->post('deskripsi'),
			'kisikisi_mapel'=>$this->input->post('mapel'),
			'kisikisi_kelas_id'=>$this->input->post('kelas'),
			'kisikisi_semester'=>$this->input->post('semester')
		);

		$where = array(
			'kisikisi_ub'=> $this->input->post('ub'),
			'kisikisi_mapel'=>$this->input->post('mapel'),
			'kisikisi_kelas_id'=>$this->input->post('kelas'),
			'kisikisi_semester'=>$this->input->post('semester')
		);

		// $konfirmasi = $this->db->select('*')->from('tbl_kisikisi')->get()->result_array();
		// foreach ($konfirmasi as $val) {
		// 	if (($val['kisikisi_ub'] == $data['kisikisi_ub']) && ($val['kisikisi_mapel'] == $data['kisikisi_mapel']) && ($val['kisikisi_kelas_id'] == $data['kisikisi_kelas_id']) && ($val['kisikisi_semester'] == $data['kisikisi_semester'])) {
		// 		echo "<script>alert('Data sudah ada')</script>";
		// 		redirect('kisikisi');
		// 	} else {
		// 		$this->db->insert('tbl_kisikisi', $data);
		// 	}
		// }

		$confirm = $this->db->get_where('tbl_kisikisi', $where);
		if($confirm->num_rows() > 0){
			$this->db->update('tbl_kisikisi', $data,$where);
			echo "<script type='text/javascript'>alert('Kisi-Kisi Berhasil Diupdtae');window.location.replace('./kisikisi');</script>";
// 			redirect('kisikisi','refresh');
		} else {
			$this->db->insert('tbl_kisikisi', $data);
			echo "<script type='text/javascript'>alert('Kisi-Kisi Berhasil Ditambahkan');window.location.replace('./kisikisi');</script>";
// 			redirect('kisikisi','refresh');
		}

		// $this->db->insert('tbl_kisikisi', $data);
		// var_dump($konfirmasi);
		// exit();
	}
}