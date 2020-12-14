<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detail_absensi extends CI_Controller
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
        if ($this->uri->segment(3) !== $this->session->userdata('username')) {
            $url = base_url('course');
            redirect($url);
        }
    }

    function absensi_forum($nis)
    {
        $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $nis])->row_array();
        if (empty($dataserialize)) {
            $this->db->insert('tbl_abs_model', ['siswa_nis' => $nis]);
            echo "<script>location.reload();</script>";
        }
        $dataunser = unserialize($dataserialize['fr_abs']);
        $data['dtforumsiswa'] = $dataunser;
        // $dataforum = $this->db->get_where('tbl_materi_forum')->result_array();
        // $dataunser = unserialize($dataserialize['fr_abs']);
        // $data['dtforum'] = $dataforum;
        // var_dump($dataserialize); die;
        $data['nama'] = $this->db->select('siswa_nama,siswa_kelas_id')->from('tbl_siswa')->where(['siswa_nis' => $nis])->get()->row_array();
        $kelas = $data['nama']['siswa_kelas_id'];
        // var_dump($dataserialize); die;
        $data['mapel'] = $this->db->select('nm_mapel,id_pelajaran')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel=b.kd_mapel', 'inner')->where(['id_kelas' => $kelas])->get()->result_array();
        $this->load->view('siswa/layout/v_header');
        $this->load->view('siswa/layout/v_navbar');
        $this->load->view('siswa/absensi/v_absensi_forum', $data);
        $this->load->view('siswa/layout/v_footer');
    }
    function absensi_tugas($nis)
    {
        $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $nis])->row_array();
        if ($dataserialize['tgs_abs']!==null ) {
            $dataunser = unserialize($dataserialize['tgs_abs']);
            $data['dttgssiswa'] = $dataunser;
        }
        $data['nama'] = $this->db->select('siswa_nama,siswa_kelas_id')->from('tbl_siswa')->where(['siswa_nis' => $nis])->get()->row_array();
        $kelas = $data['nama']['siswa_kelas_id'];
        $data['mapel'] = $this->db->select('nm_mapel,id_pelajaran')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel=b.kd_mapel', 'inner')->where(['id_kelas' => $kelas])->get()->result_array();

    //    dummy a:2:{i:0;a:2:{s:4:"idtg";s:2:"44";s:4:"data";a:1:{i:0;a:2:{s:3:"tgk";s:1:"1";s:3:"abs";s:11:"Tidak Hadir";}}}i:1;a:2:{s:4:"idtg";s:2:"45";s:4:"data";a:1:{i:0;a:2:{s:3:"tgk";s:1:"1";s:3:"abs";s:11:"Tidak Hadir";}}}}
        // var_dump($dataserialize);
        // die;
        $this->load->view('siswa/layout/v_header');
        $this->load->view('siswa/layout/v_navbar');
        $this->load->view('siswa/absensi/v_absensi_tugas', $data);
        $this->load->view('siswa/layout/v_footer');
    }

    function absensi_oc($nis)
    {
        // $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $nis])->row_array();
        // $dataunser = unserialize($dataserialize['tgs_abs']);
        // $data['dttgssiswa'] = $dataunser;
        // var_dump($dataunser[0]); die;
        $data['nama'] = $this->db->select('siswa_nama,siswa_kelas_id')->from('tbl_siswa')->where(['siswa_nis' => $nis])->get()->row_array();
        $kelas = $data['nama']['siswa_kelas_id'];
        $data['mapel'] = $this->db->select('nm_mapel,id_pelajaran')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel=b.kd_mapel', 'inner')->where(['id_kelas' => $kelas])->get()->result_array();
        $this->load->view('siswa/layout/v_header');
        $this->load->view('siswa/layout/v_navbar');
        $this->load->view('siswa/absensi/v_absensi_oc', $data);
        $this->load->view('siswa/layout/v_footer');
    }

    function absensi_kc($nis)
    {
        // $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $nis])->row_array();
        // $dataunser = unserialize($dataserialize['tgs_abs']);
        // $data['dttgssiswa'] = $dataunser;
        // var_dump($dataunser[0]); die;
        $data['nama'] = $this->db->select('siswa_nama,siswa_kelas_id')->from('tbl_siswa')->where(['siswa_nis' => $nis])->get()->row_array();
        $kelas = $data['nama']['siswa_kelas_id'];
        $data['mapel'] = $this->db->select('nm_mapel,id_pelajaran')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel=b.kd_mapel', 'inner')->where(['id_kelas' => $kelas])->get()->result_array();
        $this->load->view('siswa/layout/v_header');
        $this->load->view('siswa/layout/v_navbar');
        $this->load->view('siswa/absensi/v_absensi_kc', $data);
        $this->load->view('siswa/layout/v_footer');
    }
   
}
