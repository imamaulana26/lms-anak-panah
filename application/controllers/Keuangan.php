<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->model('m_siswa');
		$this->load->model('m_pengguna');
		$this->load->model('m_keuangan');
		$this->load->model('m_kelas');
		$this->load->library('upload');
	}


	function index()
	{
		$this->load->view('admin/v_keuangan');
	}

	public function list_siswa()
	{
		$list = $this->m_keuangan->get_datatables();
		$data = array();
		$no = 1;

		foreach ($list as $li) {
			$row = array();
			$row[] = $no++;
			$row[] = $li['siswa_nis'];
			$row[] = $li['siswa_nama'];
			$row[] = $li['kelas_nama'];
			$row[] = $li['siswa_email'];
			$row[] = $li['siswa_no_telp'];
			$aksi = '<a href="javascript:void(0)" class="label label-success" onclick="edit_keuangan(' . "'" . $li['siswa_nis'] . "'" . ')">Edit Keuangan</a><br>';

			if ($li['status'] > 0) {
				$aksi .= '<a href="javascript:void(0)" id="test" class="label label-info" onclick="edit_pembayaran(' . "'" . $li['siswa_nis'] . "'" . ')">Lihat Tagihan</a>';
			}

			$row[] = $aksi;

			$data[] = $row;
		}

		$output = array(
			'draw' => intval($_POST['draw']),
			'recordsTotal' => $this->m_keuangan->get_all_data(),
			'recordsFiltered' => $this->m_keuangan->count_filtered(),
			'data' => $data
		);
		echo json_encode($output);
		exit;
	}

	public function edit_pembayaran($id)
	{
		$qry = "select c.siswa_nama, a.*, b.* from tbl_pembayaran a ";
		$qry .= "left join tbl_tagihan b on a.jns_tagihan = b.id_tagihan ";
		$qry .= "left join tbl_siswa c on c.siswa_nis = a.nis_siswa ";
		$qry .= "where c.siswa_nis = '" . $id . "' and b.sts_tagihan = 0 and a.sts_pembayaran = 1";

		$data = $this->db->query($qry)->result_array();

		echo json_encode($data);
		exit();
	}

	public function add_kategori()
	{

		$this->load->view('admin/v_add_kategori');
	}

	public function tambah_kategori_submit()
	{
		echo "test";
		exit();
	}

	public function edit_keuangan_submit()
	{
		$tagihan = $this->db->get_where('tbl_tagihan', ['id_tagihan' => $this->input->post('jns_tagihan')])->row_array();

		$data = array(
			'nis_siswa' => strip_tags($this->input->post('xnis')),
			'jns_tagihan' => strip_tags($this->input->post('jns_tagihan')),
			'sisa_angsur' => $tagihan['nom_tagihan'],
			'tgl_jatuh_tempo' => strip_tags($this->input->post('tgl_tempo')),
		);

		$insert = $this->db->insert('tbl_pembayaran', $data);
		if ($insert) {
			echo "<script>alert('Tagihan berhasil ditambahkan!');";
			echo "window.location.href = '" . base_url('keuangan') . "';</script>";
		}
	}

	function edit_keuangan($nis)
	{
		$result = $this->db->get_where('tbl_siswa', ['siswa_nis' => $nis])->result_array();
		echo json_encode($result);
		exit;
	}

	// function edit_pembayaran($nis){
	// 	$result = $this->db->get_where('tbl_siswa',['siswa_nis'=>$nis])->result_array();
	// 	echo json_encode($result);
	// 	exit;
	// }

	public function edit_pembayaran_submit()
	{

		$id = $this->input->post('id');
		$bayar = $this->input->post('bayar');
		$nominal = $this->input->post('nom_bayar');
		$tanggalbayar = $this->input->post('tgl_bayar');

		// $tagihan = $this->db->get_where('tbl_tagihan', ['id_tagihan' => $bayar])->row_array();
		$sisa_angsur = $this->db->get_where('tbl_pembayaran', ['nis_siswa' => $id, 'jns_tagihan' => $bayar])->row_array();

		if (!is_numeric($nominal)) {
			echo json_encode(['alert' => 'Nominal tidak valid, harus berupa angka!']);
			clearstatcache();
			exit();
		} else if ($nominal == 0) {
			echo json_encode(['alert' => 'Nominal belum terisi!']);
			clearstatcache();
			exit();
		} else if ($nominal > $sisa_angsur['sisa_angsur']) {
			echo json_encode(['alert' => 'Nominal tidak boleh melebihi sisa angsuran!']);
			clearstatcache();
			exit();
		} else if (empty($tanggalbayar)) {
			echo json_encode(['alert' => 'Isi Tanggal Pembayaran!']);
			clearstatcache();
			exit();
		}

		// if($sisa_angsur['sisa_angsur'] == 0){
		// 	$sisa = $tagihan['nom_tagihan'] - $nominal;
		// } else {
		// 	$sisa = $sisa_angsur['sisa_angsur'] - $nominal;
		// }

		$data = array(
			'jml_pembayaran' => $nominal,
			// 'jns_pembayaran' => $this->input->post('jns_bayar'),
			'sisa_angsur' => $sisa_angsur['sisa_angsur'] - $nominal,
			'tgl_pembayaran' => $tanggalbayar,
			// 'sts_pembayaran' => $status,
			// 'ket_pembayaran' => $ket
		);

		if ($data['sisa_angsur'] != 0) {
			$data['ket_pembayaran'] = "BELUM LUNAS";
			$data['sts_pembayaran'] = 1;
		} else {
			$data['ket_pembayaran'] = "LUNAS";
			$data['sts_pembayaran'] = 0;
		}
		// var_dump($data); exit();

		$keuangan = array(
			'kd_tagihan' => $bayar,
			'nom_pembayaran' => $nominal,
			'tgl_pembayaran' => $tanggalbayar,
			'nis_siswa' => $id,
			'kd_transaksi' => substr(uniqid(), -3) . '' . date('ymdis'),
			'status' => $data['ket_pembayaran']
		);

		// var_dump(['id' => $id, 'bayar' => $bayar, 'nominal' => $nominal]); exit();

		$this->db->update('tbl_pembayaran', $data, ['nis_siswa' => $id, 'jns_tagihan' => $bayar]);
		$this->db->insert('tbl_keuangan', $keuangan);

		echo json_encode(['respone' => 'Pembayaran berhasil']);
		exit();
	}


	function nominal($id)
	{
		$data = $this->db->get_where('tbl_tagihan', ['id_tagihan' => $id])->row_array();
		echo json_encode($data);
		exit;
	}



	function hapus_siswa()
	{
		$kode = $this->input->post('kode');
		$gambar = $this->input->post('gambar');
		$path = './assets/images/' . $gambar;
		unlink($path);
		$this->m_siswa->hapus_siswa($kode);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('admin/siswa_keluar');
	}
}
