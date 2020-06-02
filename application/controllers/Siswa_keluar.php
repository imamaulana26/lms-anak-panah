<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_keluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url('login');
            redirect($url);
        };
        $this->load->model('m_siswa_keluar');
        $this->load->model('m_pengguna');
        $this->load->model('m_kelas');
    }


    function index()
    {
        // $x['kelas']=$this->m_kelas->get_all_kelas();
        // $x['data'] = $this->db->get_where('tbl_siswa', ['soft_delete' => '1'])->result_array();
        $this->load->view('admin/v_siswa_keluar');
    }

    public function list_siswa_keluar()
    {
        $list = $this->m_siswa_keluar->get_datatables();
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
            $row[] = $li['satelit_nama'];
            // $aksi = '<center><a href="javascript:void(0)" title="Edit Siswa" onclick="edit_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-edit"></i></a> ';
            // $aksi .= '<a href="javascript:void(0)" title="Keluarkan Siswa" onclick="delete_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-trash"></i></a> ';
            // $aksi .= '<br><a href="keuangan"><i class="fa fa-fw fa-dollar"></i></a> ';
            // $aksi .= ' <a href="javascript:void(0)" title="Detail Siswa" onclick="detail_siswa(' . "'" . $li['siswa_nis'] . "'" . ')"><i class="fa fa-fw fa-user"></i></a></center>';

            $aksi = '<a href="javascript:delete_siswa(' . "'" . $li['siswa_nis'] . "'" . ',' . "'" . $li['siswa_nama'] . "'" . ')" class="label label-danger col-md-12"><i class="fa fa-fw fa-trash"></i>Hapus Siswa</a><br>';
            $row[] = $aksi;

            $data[] = $row;
        }

        $output = array(
            'draw' => intval($_POST['draw']),
            'recordsTotal' => $this->m_siswa_keluar->get_all_data(),
            'recordsFiltered' => $this->m_siswa_keluar->count_filtered(),
            'data' => $data
        );
        echo json_encode($output);
        exit;
    }


    function delete_siswa($id)
    {
        // var_dump($id); exit();
        $this->db->delete('tbl_siswa', ['siswa_nis' => $id]);
        $this->db->delete('tbl_orangtua', ['siswa_nis' => $id]);
        $this->db->delete('tbl_nilai', ['nis_siswa' => $id]);
        $this->db->delete('tbl_nilai_indv', ['nis_siswa' => $id]);
        $this->db->delete('tbl_absensi', ['nis_siswa' => $id]);
        $this->db->delete('tbl_catmur', ['nis_siswa' => $id]);
        $this->db->delete('tbl_pengguna', ['pengguna_username' => $id]);
        $this->db->delete('tbl_pembayaran', ['nis_siswa' => $id]);
        $this->db->delete('tbl_keuangan', ['nis_siswa' => $id]);
        $this->db->delete('tbl_inbox', ['inbox_kontak' => $id]);
        rmdir(base_url('assets/filesiswa') . '/' . $id);
        $this->load->helper("file");
        $dir = 'assets/filesiswa/' . $id;
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file)) delete_files($file);
            else unlink($file);
        }
        rmdir($dir);
        redirect('siswa_keluar', 'refresh');
    }
}
