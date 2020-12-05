<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Offclass extends CI_Controller
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
        $sql1 = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => '43'])->row_array();
        $unser = unserialize($sql1['dt_oc']);

        $data['dt_tgl'] = $unser;


        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/v_absensi_offclass', $data);
    }
    public function attendent_oc($key)
    {
        $sql1 = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => '43'])->row_array();
        // $where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
        // $mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();
        $unser = unserialize($sql1['dt_oc']);


        // $sql = $this->db->distinct()->select('siswa_nama,siswa_nis')->from('tbl_siswa a')->join('tbl_komen_tugas b', 'a.siswa_nis=b.user_komen', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->get()->result_array();
        // $sql = $this->db->get_where('tbl_kelas', ['kelas_id' => $where['id_kelas']])->row_array();

        // $data['nm_mapel'] = $mapel['nm_mapel'];
        $data['dt_tgl'] = $unser;

        // var_dump($unser); die;


        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/v_absensi_oc', $data);
    }
}
