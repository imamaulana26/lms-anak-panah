<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('masuk') != TRUE) {
			$url = base_url('login');
			redirect($url);
		};
		$this->load->library('upload');
		$this->load->helper('tanggal_helper');
	}


	function index()
	{
		$this->load->view('admin/v_pegawai');
	}

	function simpan_pegawai()
	{

		$nip = strip_tags($this->input->post('xnip'));

		if ((file_exists('./assets/filepegawai/' . $nip)) && (is_dir('./assets/filesiswa/' . $nip))) {
			echo "<script>alert('NIP Sudah Ada!'); window.history.back();</script>";
		} else {
			for ($i = 0; $i <= 1; $i++) {
				if ($_FILES['file' . $i]['error'] > 0) {
					// header("location:javascript://history.go(-1)");
					echo "<script>alert('Size not allowed!'); window.history.back();</script>";
					return;
				}
			}

			mkdir('./assets/filepegawai/' . $nip);

			$data = array(
				'pegawai_nip' => strip_tags($this->input->post('xnip')),
				'pegawai_nama' => strip_tags($this->input->post('xnama')),
				'pegawai_bagian' => strip_tags($this->input->post('xbagian')),
				'lokasi_dinas' => strip_tags($this->input->post('xsatelit')),
				'pegawai_jenkel' => strip_tags($this->input->post('xjenkel')),
				'pegawai_tmp_lahir' => strip_tags($this->input->post('xtmp_lahir')),
				'pegawai_tgl_lahir' => $this->input->post('tgl_lahir')
			);

			$config = array(
				'upload_path' => './assets/filepegawai/' . $nip,
				'allowed_types' => 'jpg|jpeg|png|pdf'
				// 'max_size' => '2000'
			);

			$this->upload->initialize($config);

			for ($i = 0; $i <= 1; $i++) {
				if ($_FILES['file' . $i]['name']) {
					$this->upload->do_upload('file' . $i);
					$dt_upload = $this->upload->data();

					if ($dt_upload['is_image'] === true) {
						$config['image_library'] = 'gd2';
						$config['source_image'] = './assets/filepegawai/' . $nip . '/' . $dt_upload['file_name'];
						$config['create_thumb'] = false;
						$config['maintain_ratio'] = false;
						$config['quality'] = '60%';
						$config['width'] = 230;
						$config['height'] = 250;
						$config['new_image'] = './assets/filepegawai/' . $nip . '/' . $dt_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						$data['pegawai_photo'] = $dt_upload['file_name'];
					} else {
						$data['pegawai_file'] = $dt_upload['file_name'];
					}
				} else {
					echo "Gagal upload dokumen";
					return;
				}
			}
			// exit();
			$this->db->insert('tbl_pegawai', $data);
			echo $this->session->set_flashdata('msg', 'success');
			redirect('pegawai');
			// return $this->index();
		}
	}

	// $config['upload_path'] = './assets/pegawai/'; //path folder
	//          $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf'; //type yang dapat diakses bisa anda sesuaikan
	//          $config['encrypt_name'] = TRUE; //nama yang terupload nantinya
	//          $this->upload->initialize($config);

	//          $data = array(
	//          	'pegawai_nip'=>strip_tags($this->input->post('xnip')),
	//          	'pegawai_nama'=>strip_tags($this->input->post('xnama')),
	//          	'pegawai_jenkel'=>strip_tags($this->input->post('xjenkel')),
	//          	'pegawai_tmp_lahir'=>strip_tags($this->input->post('xtmp_lahir')),
	//          	'pegawai_tgl_input'=>strip_tags($this->input->post('tgl_lahir')),
	//          );

	//          if(!empty($_FILES['filefoto']['name']))
	//          {
	//          	if ($this->upload->do_upload('filefoto'))
	//          	{


	//          		$gbr = $this->upload->data();

	//                      //Compress Image
	//          		$config['image_library']='gd2';
	//          		$config['source_image']='./assets/pegawai/'.$gbr['file_name'];
	//          		$config['create_thumb']= FALSE;
	//          		$config['maintain_ratio']= FALSE;
	//          		$config['quality']= '60%';
	//          		$config['width']= 300;
	//          		$config['height']= 300;
	//          		$config['new_image']= './assets/pegawai/'.$gbr['file_name'];
	//          		$this->load->library('image_lib', $config);
	//          		$this->image_lib->resize();


	//          		$photo=$gbr['file_name'];
	//          		$nip=strip_tags($this->input->post('xnip'));
	//          		$nama=strip_tags($this->input->post('xnama'));
	//          		$jenkel=strip_tags($this->input->post('xjenkel'));
	//          		$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
	//          		$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
	//          		$mapel=strip_tags($this->input->post('xmapel'));

	//          		if ($this->upload->do_upload('xfile')) {

	//          			$gbr = $this->upload->data();
	//          			$file=$gbr['file_name'];
	//          			$this->m_guru->simpan_guru($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$photo,$file);
	//          			echo $this->session->set_flashdata('msg','success');
	//          			redirect('pegawai');
	//          		}


	//          	}
	//          	else{
	//          		echo $this->session->set_flashdata('msg','warning');
	//          		redirect('pegawai');
	//          	}


	//          }else if($this->upload->do_upload('xfile')){
	//          	$gbr = $this->upload->data();
	//          	$file=$gbr['file_name'];

	//          	$nip=strip_tags($this->input->post('xnip'));
	//          	$nama=strip_tags($this->input->post('xnama'));
	//          	$jenkel=strip_tags($this->input->post('xjenkel'));
	//          	$tmp_lahir=strip_tags($this->input->post('xtmp_lahir'));
	//          	$tgl_lahir=strip_tags($this->input->post('xtgl_lahir'));
	//          	$mapel=strip_tags($this->input->post('xmapel'));


	//          	$this->m_guru->simpan_guru_tanpa_img($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$file);
	//          	echo $this->session->set_flashdata('msg','success');
	//          	redirect('admin/guru');
	//          }

	// }

	function update_pegawai()
	{
		// var_dump($_FILES);
		// exit();
		$nip = strip_tags($this->input->post('xnip'));

		$dt_pegawai = array(
			'pegawai_nip' => strip_tags($this->input->post('xnip')),
			'pegawai_nama' => strip_tags($this->input->post('xnama')),
			'pegawai_bagian' => strip_tags($this->input->post('xbagian')),
			'lokasi_dinas' => strip_tags($this->input->post('xsatelit')),
			'pegawai_jenkel' => strip_tags($this->input->post('xjenkel')),
			'pegawai_tmp_lahir' => strip_tags($this->input->post('xtmp_lahir')),
			'pegawai_tgl_lahir' => $this->input->post('tgl_lahir')
		);

		$config = array(
			'upload_path' => './assets/filepegawai/' . $nip,
			'allowed_types' => 'jpg|jpeg|png|pdf'
			// 'max_size' => '2000'
		);

		$this->upload->initialize($config);
		$getsql = $this->db->get_where('tbl_pegawai', ['pegawai_nip' => $nip])->row_array();
		$dt_ptlama = $getsql["pegawai_photo"];
		$dt_flama = $getsql["pegawai_file"];

		// var_dump($dt_ptlama);
		// exit();

		for ($i = 0; $i <= 1; $i++) {
			if ($_FILES['file' . $i]['name']) {
				if ($_FILES['file' . $i]['error'] > 0) {
					$this->session->set_flashdata('msg', 'info');
					// header("location:javascript://history.go(-1)");
					echo "<script>alert('Size not allowed!'); window.history.back();</script>";
					return;
				} else {
					// $path='./assets/filesiswa/'.$nis.'/'.$dt_ptlama;
					// exit();

					$this->upload->do_upload('file' . $i);
					$dt_upload = $this->upload->data();

					if ($dt_upload['is_image'] === true) {
						$config['image_library'] = 'gd2';
						$config['source_image'] = './assets/filepegawai/' . $nip . '/' . $dt_upload['file_name'];
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$config['quality'] = '60%';
						$config['width'] = 230;
						$config['height'] = 250;
						$config['new_image'] = './assets/filepegawai/' . $nip . '/' . $dt_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						unlink('./assets/filepegawai/' . $nip . '/' . $dt_ptlama);
						// exit();
						$dt_pegawai['pegawai_photo'] = $dt_upload['file_name'];
					} else {
						unlink('./assets/filepegawai/' . $nip . '/' . $dt_flama);
						$dt_pegawai['pegawai_file'] = $dt_upload['file_name'];
					}
				}
			}
		}
		// var_dump($dt_pegawai['pegawai_file']);
		// exit();
		$this->db->update('tbl_pegawai', $dt_pegawai, ['pegawai_nip' => $nip]);
		// 		echo "<script>alert('Pegawai Berhasil di Update!');</script>";
		// 		redirect('pegawai');

		echo "<script type='text/javascript'>alert('Pegawai Berhasil di update');window.location.replace('/pegawai');</script>";
	}


	function delete_pegawai()
	{
		$this->db->delete('tbl_pegawai', ['pegawai_nip' => $this->input->post('xnip')]);
		rmdir(base_url('assets/filepegawai') . '/' . $this->input->post('xnip'));
		$this->load->helper("file");
		$dir = 'assets/filepegawai/' . $this->input->post('xnip');
		foreach (glob($dir . '/*') as $file) {
			if (is_dir($file)) delete_files($file);
			else unlink($file);
		}
		rmdir($dir);
		echo $this->session->set_flashdata('msg', 'success-hapus');
		redirect('pegawai');
	}
}
