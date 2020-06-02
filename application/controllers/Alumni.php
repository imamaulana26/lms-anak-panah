<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alumni extends CI_Controller
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
        $this->load->model('m_kelas');
    }


    function index()
    {
        $x['kelas'] = $this->m_kelas->get_all_kelas();
        $x['data'] = $this->m_siswa->get_all_siswa_alumni();

        $this->load->view('admin/v_alumni', $x);
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
