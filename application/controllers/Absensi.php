<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller
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
        $akses = $this->session->userdata('akses');
        if ($akses == 2) {
            $url = base_url('course');
            redirect($url);
        }
    }

    public function attendent($key, $mgg)
    {

        $where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
        $mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();
        $sql =$this->db->distinct()->select('siswa_nama,siswa_nis')->from('tbl_siswa a')->join('tbl_komen_forum b','a.siswa_nis=b.user_komen', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->get()->result_array(); 
		
		$data['nm_mapel'] = $mapel['nm_mapel'];
        $data['dt_siswa'] = $sql;

        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/v_absensi', $data);
    }

    function submit_absensi()
    {
        $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $this->input->post('nis')]);

        $result = array();
        $new_abs = array();
        $status = true;
        $sts_new = true;
        $search = true;

        if ($dataserialize->num_rows() > 0) {
            $unser = $dataserialize->row_array();
            $dataunser = unserialize($unser['fr_abs']);
            
            foreach ($dataunser as $dtunser) {
                $data1 = array();
                // update absensi
                if ($status === true) {
                    if ($dtunser['idf'] == $this->input->post('idf')) {
                        foreach ($dtunser['data'] as $val) {
                            if ($sts_new === true) {
                                if ($val['frk'] === $this->input->post('idfk')) {
                                    $val['abs'] = $this->input->post('absensi');
                                } else {
                                    // 
                                    //update sub absensi jika minggu ke sama
                                    $data1[] =
                                    array(
                                        'frk' => $this->input->post('idfk'),
                                        'abs' => $this->input->post('absensi')
                                    );
                                    $sts_new = false;
                                }
                            }
                           
                            $data1[] = $val;
                        }
                        // var_dump();
                        $temp = array_unique(array_column($data1, 'frk'));
                        $unique_arr = array_intersect_key($data1, $temp);
                        // var_dump($unique_arr);
                        // var_dump($data1);
                        // print_r(unique_key($data1,'frk'));
                        
                        $dtunser['data'] = $unique_arr;
                        $status = false;
                    } else {
                        $new_abs = array(
                            'idf' => $this->input->post('idf'),
                            'data' => array(
                                array(
                                    'frk' => $this->input->post('idfk'),
                                    'abs' => $this->input->post('absensi')
                                )
                            )
                        );
                    }
                }

                $result[] = $dtunser;
            }
            // 
            // 
            if ($sts_new == true) {
                $result[] = $new_abs;
            }
            $this->db->update('tbl_abs_model', ['fr_abs' => serialize($result)], ['siswa_nis' => $this->input->post('nis')]);
            // echo json_encode($result);
            
            echo "<script>window.history.go(-1);location.reload();</script>";
        } else {
            echo "data tidak adaa";
            $new_abs1 = array(
                array(
                    'idf' => $this->input->post('idf'),
                    'data' => array(
                        array(
                            'frk' => $this->input->post('idfk'),
                            'abs' => 'Hadir'
                        )
                    )
                )
            );
            var_dump($new_abs1);
            $this->db->insert('tbl_abs_model', ['siswa_nis' => $this->input->post('nis'), 'fr_abs' => serialize($new_abs1) ]);
            echo "<script>window.history.go(-1);location.reload();</script>";
        }
    }
}
