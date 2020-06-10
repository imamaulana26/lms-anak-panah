<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan_siswa extends CI_Controller
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
		// $this->db->order_by('tgl_pembayaran','desc');
		// $data['keuangan'] = $this->db->select('*')->from('tbl_keuangan a')->join('tbl_tagihan b', 'a.kd_tagihan = b.id_tagihan', 'right')->where(['a.nis_siswa' => $this->session->userdata('pengguna_username')])->order_by('a.tgl_pembayaran','desc')->get()->result_array();
		$sql = "select a.tgl_pembayaran, a.kd_transaksi, b.jns_tagihan, b.nom_tagihan, sum(a.nom_pembayaran) as bayar, a.status from tbl_keuangan a inner join tbl_tagihan b on a.kd_tagihan = b.id_tagihan ";
		$sql .= "where a.nis_siswa = '".$this->session->userdata('user')."' ";
		$sql .= "group by b.jns_tagihan";
		$data['keuangan'] = $this->db->query($sql)->result_array();
		// var_dump($data);
		// exit();
		$this->load->view('siswa/layout/v_header');
		$this->load->view('siswa/layout/v_navbar');
		$this->load->view('siswa/v_keuangan',$data);
		$this->load->view('siswa/layout/v_footer');
	}
}
