<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
        // $data['jadwal']= $this->db->get('tbl_jadwal')->result_array();
        // $this->load->view('admin/v_jadwal', $data);

        //  {
        //                 title: 'All Day Event',
        //                 start: new Date(2020, 11, 01),
        //                 end: new Date(2020, 11, 04 + 1), // +1 untuk penyimpanan database
        //                 backgroundColor: '#f56954', //red
        //                 borderColor: '#f56954', //red
        //                 allDay: true
        //             }

        $data = $this->db->get('tbl_jadwal')->result_array();

        $str = '';
        foreach ($data as $key => $val) {
            $allDay = $val['jdwl_allday'] == 1 ? 'true' : 'false';

            $str .= '{';
            $str .= 'title: \'' . $val['jdwl_title'] . '\',';
            // $str .= 'start: new Date(' . str_replace('-', ',', str_replace(':', ',', str_replace(' ', ',', $val['jdwl_start']))) . '),';
            // $str .= 'end: new Date(' . str_replace('-', ',', str_replace(':', ',', str_replace(' ', ',', $val['jdwl_end']))) . '),';
            // start: new Date(y, m, d + 1, 19, 0),
            // $str .= 'start: new Date(' . str_replace('-', ',',$val['jdwl_start']) . '),';
            $str .= 'start: new Date(' . str_replace('-', ',', $val['jdwl_start']) . ',' . str_replace(':', ',', $val['jdwl_jam_start']) . '),';
            $str .= 'end: new Date(' . str_replace('-', ',', $val['jdwl_end']) . ',' . str_replace(':', ',', $val['jdwl_jam_end']) . '),';
            $str .= 'backgroundColor: \'' . $val['jdwl_color'] . '\',';
            $str .= 'borderColor: \'' . $val['jdwl_color'] . '\',';
            $str .= 'allDay: ' . $allDay;
            $str .= '},';
        }

        // $allDay = $data[0]['jdwl_allday'] == 1 ? 'true' : 'false';

        // $str .= '{';
        // $str .= 'title: \'' . $data[0]['jdwl_title'] . '\',';
        // $str .= 'start: new Date(' . str_replace('-', ',', str_replace(':', ',', str_replace(' ', ',', $data[0]['jdwl_start']))) . '),';
        // $str .= 'end: new Date(' . str_replace('-', ',', str_replace(':', ',', str_replace(' ', ',', $data[0]['jdwl_end']))) . '),';
        // $str .= 'backgroundColor: \'' . $data[0]['jdwl_color'] . '\',';
        // $str .= 'borderColor: \'' . $data[0]['jdwl_color'] . '\',';
        // $str .= 'allDay: ' . $allDay;
        // $str .= '},';

        $result['str'] = substr($str, 0, -1);

        if ($this->session->userdata('akses') == 1) {
            $this->load->view('admin/v_jadwal', $result);
        } elseif ($this->session->userdata('akses') == 2) {
            $this->load->view('siswa/layout/v_header');
            $this->load->view('siswa/layout/v_navbar');
            $this->load->view('siswa/v_jadwal', $result);
            $this->load->view('siswa/layout/v_footer');
        }
    }

    function hapus_jadwal()
    {

        $data = $this->db->delete('tbl_jadwal', ['jdwl_title' => $this->input->post('title'), 'jdwl_start' => $this->input->post('tanggal')]);
        echo json_encode($data);
        exit;
    }
    function add_jadwal()
    {
        $jadwalstart = date('Y-m-d', strtotime('-1 month', strtotime($this->input->post('jdl_start'))));
        $format = mktime(0, 0, 0, date('m', strtotime($this->input->post('jdl_end'))) - 1, date('d', strtotime($this->input->post('jdl_end'))) + 1, date('Y', strtotime($this->input->post('jdl_end')))); // Untuk Manipulasi bulan dan tanggal
        $jadwalend = date('Y-m-d', $format);

        if ($this->input->post('oneday') == 1) {
            $data = array(
                'jdwl_title' => $this->input->post('judul_event'),
                'jdwl_start' => $jadwalstart,
                'jdwl_jam_start' => date("H:i:s"),
                'jdwl_end' => $jadwalend,
                'jdwl_jam_end' => date("H:i:s"),
                'jdwl_allday' => $this->input->post('oneday'),
                'jdwl_color' => $this->input->post('warna'),
            );
        } else {
            if ($this->input->post('start_on') == '' || $this->input->post('end_on') == '') {
                $this->session->set_flashdata('msg', 'error');
                redirect(site_url('jadwal'));
            }
            $data = array(
                'jdwl_title' => $this->input->post('judul_event'),
                'jdwl_start' => $jadwalstart,
                'jdwl_jam_start' => $this->input->post('start_on'),
                'jdwl_end' => date('Y-m-d', strtotime('-1 month', strtotime($this->input->post('jdl_end')))),
                'jdwl_jam_end' => $this->input->post('end_on'),
                'jdwl_allday' => $this->input->post('oneday'),
                'jdwl_color' => $this->input->post('warna')
            );
        }
        $this->db->insert('tbl_jadwal', $data);
        $this->session->set_flashdata('msg', 'success');
        redirect(site_url('jadwal'));
        // $date = date_create($this->input->post('jdl_start'));
        // date_format($date, 'Y-m-d H:i:s');
        // echo date_format($date, 'Y-m-d H:i:s');
        // echo 'tanggal sebelumnya';
        // echo $this->input->post('jdl_end');
        // echo '<br>';

        // echo $jadwalend;
        // die;
    }
    function jadwal_kelas($id)
    {
        $data['jadwal'] = $this->db->get_where('tbl_kelas', ['kelas_id <' => ' 16'])->result_array();
        $data['mapel'] = $this->db->select('b.nm_mapel')->from('tbl_pelajaran a')->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')->where(['a.id_kelas' => $id])->get()->result_array();
        $dt_mapel = $this->db->select('kls_jadwal')->from('tbl_kelas')->where(['kelas_id' => $id])->get()->row_array();
        $data['dt_mapel'] = unserialize($dt_mapel['kls_jadwal']);
        // $data['jadwal'] = $this->db->get_where('tbl_kelas', ['kelas_id <' => ' 16'])->result_array();
        $this->load->view('admin/v_jadwal_kelas', $data);
    }

    function add_jadwal_kelas()
    {

        // foreach ($this->input->post('hari') as $key => $value) {

        // }
        // var_dump($this->input->post('hari'));
        $data = $this->input->post('data');
        // var_dump($this->input->post());
        $datadummy = array();
        foreach ($data as $key) {
            // echo $key;
            $datadummy[] = explode(":", $key);
        }
        foreach ($datadummy as $key2) {
           $data1[]= $key2[0];
            

        //    $mapel[] = $key2[1];
        // echo $key2[0];
        }
        
        var_dump($datadummy);

        $testabsnsi = array(
            array(
                'hari' => $this->input->post('hari'),
                'data' => array(
                    array(
                        'mapel' => $this->input->post('mapel'),
                        'tipe' => $this->input->post('tipe')
                    )
                )
            )
        );
        
        die;
    }
}
