<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
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
	}

	public function index()
	{
		ob_start('ob_gzhandler');

		$akses = $this->session->userdata('akses');

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_forum');
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_forum');
		}
	}

	public function diskusi($id)
	{
		$akses = $this->session->userdata('akses');

		$data['forum'] = $this->m_forum->get_forum($id);
		$data['materi'] = $this->m_forum->get_materi($id);
		// $data['komen'] = $this->m_forum->get_komen($id);

		if ($akses == 2) {
			$this->load->view('siswa/layout/v_header');
			$this->load->view('siswa/layout/v_navbar');
			$this->load->view('siswa/v_forum', $data);
		} else {
			$this->load->view('pengajar/layout/v_header');
			$this->load->view('pengajar/layout/v_navbar');
			$this->load->view('pengajar/v_forum', $data);
		}
	}

	public function get_siswa($nis)
	{
		if ($nis != 'NULL') {
			$data = $this->m_forum->get_siswa($nis);
			echo json_encode($data);
			exit;
		}
	}

	function data_id()
	{

		$query = $this->db->select('id')->from('tbl_komentar')->get()->result_array();
		echo json_encode($query);
		exit();
		
	}
	function datafr_id()
	{

		$query = $this->db->select('id')->from('tbl_materi')->get()->result_array();
		echo json_encode($query);
		exit();
		
	}

	public function add_forum()
	{
		$akses = $this->session->userdata('akses');

		if ($akses == 3) {
			$kd_mapel = $this->input->post('kd_mapel');

			$data = array(
				'id_forum' => $kd_mapel,
				'judul_materi' => $this->input->post('judul_materi'),
				'jns_materi' => $this->input->post('tipe_forum'),
				'isi_materi' => $this->input->post('isi_materi')
			);

			$cek = $this->db->get_where('tbl_materi', ['id_forum' => $kd_mapel]);
			if ($cek->num_rows() > 0) {
				$count = $cek->num_rows() + 1;

				$data['pertemuan'] = $count;

				$this->db->insert('tbl_materi', $data);
			} else {
				$data['pertemuan'] = 1;
				$this->db->insert('tbl_forum', ['fr_id_pelajaran' => $kd_mapel]);

				$this->db->insert('tbl_materi', $data);
			}

			$this->diskusi($kd_mapel);
		}
	}

	public function test($id){
		echo "test disini";
		// $this->db->select('field1, field2');
		$test = $this->db->get_where('tbl_base64', ['id'=>$id])->row_array();

		// echo '<img src="data:image;base64,'.$test['text'].'" />';
		// echo "string";
		exit();
	}

	public function submit_main()
	{
		$komen = $this->input->post('komentar');
		$id = $this->input->post('id');

		

		if(!empty($_FILES['gambar']['name'])){

			$config['upload_path'] = './assets/test/'; 
			$config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
     $config['max_size'] = '1024'; // max_size in kb
     $config['file_name'] = $_FILES['gambar']['name'];
     $this->load->library('upload',$config); 

     // File upload
     if($this->upload->do_upload('gambar')){
       // Get data about the file
     	$uploadData = $this->upload->data();
     	
     	$img = file_get_contents( 
     		'./assets/test/'.$uploadData['file_name']); 

// Encode the image string data into base64 
     	// $data = base64_encode($img); 
     	
     	$base_64 = base64_encode($img);
     	$this->db->insert('tbl_base64', ['text'=>$base_64]);
     	unlink('./assets/test/'.$uploadData['file_name']);
     	// $baseendoce = base64_decode($base_64);

     	// $data = file_get_contents($base_64);

     	// fclose( $ifp ); 
     	// echo '<img src="data:image/webp;base64,'.$base_64.'" />';

     	exit();
     }
     

 }



 var_dump($img);
 exit();
 if (!empty($komen)) {
 	$data = array(
 		'id_forum' => $this->input->post('id_forum'),
 		'pertemuan' => $this->input->post('pertemuan'),
 		'reply_to' => 0,
 		'user_komen' => $this->input->post('user_komen'),
 		'isi_komen' => $this->input->post('komentar')
 	);

 	$this->db->insert('tbl_komentar', $data);

 	$this->session->set_flashdata('page', $data['pertemuan']);
 	$this->session->set_flashdata('mention', $id);

 	redirect(site_url('forum/' . $data['id_forum']));
 }
}


// test


    public function load($filename) {

        $image_info = getimagesize($filename);
        $this->_image_type = $image_info[2];
        if( $this->_image_type == IMAGETYPE_JPEG ) {

            $this->_image = imagecreatefromjpeg($filename);
        } elseif( $this->_image_type == IMAGETYPE_GIF ) {

            $this->_image = imagecreatefromgif($filename);
        } elseif( $this->_image_type == IMAGETYPE_PNG ) {

            $this->_image = imagecreatefrompng($filename);
        }
    }

    public function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->_image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {

            imagegif($this->_image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {

            imagepng($this->_image,$filename);
        }
        if( $permissions != null) {

            chmod($filename,$permissions);
        }
    }

    public function output($image_type=IMAGETYPE_JPEG) {

        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->_image);
        } elseif( $image_type == IMAGETYPE_GIF ) {

            imagegif($this->_image);
        } elseif( $image_type == IMAGETYPE_PNG ) {

            imagepng($this->_image);
        }
    }

    public function getWidth() {

        return imagesx($this->_image);
    }

    public function getHeight() {

        return imagesy($this->_image);
    }

    public function resizeToHeight($height) {

        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width,$height);
    }

    public function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width,$height);
    }

    public function scale($scale) {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width,$height);
    }

    public function resize($width,$height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->_image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->_image = $new_image;
    }

    public function getImageType()
    {
        return $this->_image_type;
    }


    

    public function getHeader() {

        if( $this->_image_type == IMAGETYPE_JPEG ) {
            return 'image/jpeg';
        } elseif( $this->_image_type == IMAGETYPE_GIF ) {
            return 'image/gif';
        } elseif( $this->_image_type == IMAGETYPE_PNG ) {
            return 'image/png';
        }
    }


    /** 
     *  Free's up memory
     */
    public function destroy()
    {
        imagedestroy($this->_image);
    }

// end test

public function Submit_main_image()
{
	var_dump($_FILES);
	exit();
	if(!empty($_FILES['file']['name'])){

     // Set preference
		$config['upload_path'] = './assets/test/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
     $config['max_size'] = '1024'; // max_size in kb
     $config['file_name'] = $_FILES['file']['name'];

     //Load upload library
     $this->load->library('upload',$config); 

     // File upload
     if($this->upload->do_upload('file')){
       // Get data about the file
     	$uploadData = $this->upload->data();
     }
 }
}

public function submit_komen()
{
	$komen = $this->input->post('komentar');
	$id = $this->input->post('id');

	if (!empty($komen)) {
		$data = array(
			'id_forum' => $this->input->post('id_forum'),
			'pertemuan' => $this->input->post('pertemuan'),
			'reply_to' => $this->input->post('reply_to'),
			'mention' => $this->input->post('mention'),
			'user_komen' => $this->input->post('user_komen'),
			'isi_komen' => $this->input->post('komentar')
		);

		$this->db->insert('tbl_komentar', $data);

		$this->session->set_flashdata('page', $data['pertemuan']);
		$this->session->set_flashdata('mention', $id);

		redirect(site_url('forum/' . $data['id_forum']));
	}
}
}
