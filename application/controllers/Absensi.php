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
        // var_dump($where); die;

        // $row = array();
        // $peserta = array();
        // $sql = $this->db->get_where('tbl_kelas', ['kelas_id' => $where['id_kelas']])->row_array();



        // foreach ($sql as $sql) {
        //     $qry = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => $sql['kelas_id']])->result_array();

        //     $peserta['kelas'] = $sql['kelas_nama'];
        //     $siswa = array();
        //     foreach ($qry as $val) {
        //         array_push(
        //             $siswa,
        //             array(
        //                 'nis' => $val['siswa_nis'],
        //                 'nama' => $val['siswa_nama'],
        //                 'onclass' => $val['oc']
        //             )
        //         );
        //     }
        //     $peserta['siswa'] = $siswa;
        //     $row[] = $peserta;
        // }
        // $data = array(
        // 	array(
        // 		'frk' => '1',
        // 		'siswa' => array(
        // 			array(
        // 				'nis' => 123123,
        // 				'nama' => 'Merik'
        // 			),
        // 			array(
        // 				'nis' => 3124124124,
        // 				'nama' => 'Imam'
        // 			)
        // 		)
        // 	),
        // 	array(
        //         'frk' => '2',
        // 		'siswa' => array(
        // 			array(
        // 				'nis' => 512431,
        // 			),
        // 			array(
        // 				'nis' => 541234,
        // 			),
        // 			array(
        // 				'nis' => 52311,
        // 			)
        // 		)
        // 	)
        // );
        $testdata = array(
            array(
                'idf' => '43', //agama k11
                'data' => array(
                    array(
                        'frk' => '1',
                        'abs' => 'hadir'
                    ),
                    array(
                        'frk' => '2',
                        'abs' => 'hadir'
                    ),
                    array(
                        'frk' => '3',
                        'abs' => 'hadir'
                    ),
                    array(
                        'frk' => '4',
                        'abs' => 'hadir'
                    ),
                ),
            ),
            array(
                'idf' => '42', //agama k11
                'data' => array(
                    array(
                        'frk' => '1',
                        'abs' => 'hadir'
                    ),
                    array(
                        'frk' => '2',
                        'abs' => 'hadir'
                    )
                )
            ),
            array(
                'idf' => '41', //agama k11
                'data' => array(
                    array(
                        'frk' => '1',
                        'abs' => 'hadir'
                    )
                )
            )

        );
        // echo serialize($testdata);
        // var_dump($testdata[1]['data']);
        // die;
        // echo json_encode($data); die;
        // $dataserialize = $this->db->get_where('tbl_fr_absensi', ['id_forum' => $key])->row_array();
        // $dataunser = unserialize($dataserialize['siswa_abs']);
        // $siswa = array();
        // foreach ($dataunser as $val) {
        //     $siswa = array();
        //     if ($val['frk'] == $mgg) {
        //         foreach ($val['siswa'] as $sis) {
        //             array_push(
        //                 $siswa,
        //                 array(
        //                     'nis' => $sis['nis'],
        //                 )
        //             );
        //         }
        //         $peserta['siswa'] = $siswa;
        //     }
        // }


        // $sql =
        // $this->db->select('*')->from('tbl_siswa a')->join('tbl_orangtua b', 'a.siswa_nis=b.siswa_nis', 'inner')->where(['a.siswa_nis' => $id, 'a.soft_deleted' => '0'])->result_array();
        // $sql = $this->db->get_where('tbl_siswa', ['siswa_kelas_id' => $where['id_kelas']])->result_array();
        // $sql1 = $this->db->get_where('tbl_komen_forum', ['id_forum' => $key , 'pertemuan' => $mgg])->result_array();
        $sql =$this->db->distinct()->select('siswa_nama,siswa_nis')->from('tbl_siswa a')->join('tbl_komen_forum b','a.siswa_nis=b.user_komen', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->get()->result_array(); 
        // var_dump($sql); die;

        // $data['kel'] = $sql['kelas_id'];
        // $data['absensi_siswa'] = $peserta['siswa'];
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
            // $this->db->update('tbl_abs_model', ['fr_abs' => serialize($result)], ['siswa_nis' => $this->input->post('nis')]);
            var_dump($result[0]);
            
            // echo "<script>window.history.go(-1);location.reload();</script>";
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

        // if (!empty($new_abs)) {
        //     $result[] = $new_abs;
        // }
        // if (empty($new_abs1)) {
        //     echo "data tidak adaa";

        //     $this->db->update('tbl_abs_model', ['fr_abs' => serialize($result)], ['siswa_nis' => $this->input->post('nis')]);
        // }else{
        //     echo "data sudah ada";
        //     $result[] = $new_abs;
        //     $this->db->insert('tbl_abs_model', ['siswa_nis' => $this->input->post('nis'), 'fr_abs' => serialize($new_abs)]);
        //     var_dump($result);
        //     var_dump(serialize($result));
        // }
        

        // var_dump($dataserialize);
        // var_dump($new_abs);
        // echo "<script>window.history.go(-1);location.reload();</script>";
    }

    function save_absensi_kelas()
    { 
        $testpeserta = $this->input->post('siswa[]');
        $forum = $this->input->post('fr');
        $forumke = $this->input->post('frk');
        $dataserialize = $this->db->get_where('tbl_fr_absensi', ['id_forum' => $forum])->row_array();
        $dataunser = unserialize($dataserialize['siswa_abs']);
        $dtinput = array();
        $dtfix = array();

        foreach ($dataunser as $dtsis) {
            $siswa = array();
            if ($dtsis['frk'] == $forumke) {
                foreach ($testpeserta as $dtdekoy => $val) {
                    array_push(
                        $siswa,
                        array(
                            'nis' => $val,
                        )
                    );
                }
                $dtinput['frk'] = $forumke;
                $dtinput['siswa'] = $siswa;
                $dtfix[] =  $dtinput;
                var_dump($dtfix);
            }

        }



        var_dump($dtfix);
        die;


        foreach ($peserta as $key => $val) {
            $this->db->update('tbl_siswa', ['oc' => 1], ['siswa_nis' => $val]);
        }

        redirect(site_url('siswa/online_class'));
    }
}
