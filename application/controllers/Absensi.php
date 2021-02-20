<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_forum', 'm_forum');
        $this->load->helper('text');
        $this->load->model('M_course', 'm_course');

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

    function attendent_fr($key, $mgg)
    {

        $where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
        $mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();

        $sql = $this->db->distinct()->select('siswa_nama,siswa_nis')->from('tbl_siswa a')->join('tbl_komen_forum b', 'a.siswa_nis=b.user_komen', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->order_by('siswa_nama ASC')->get()->result_array();

        $data['nm_mapel'] = $mapel['nm_mapel'];
        $data['dt_siswa'] = $sql;


        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/absensi/v_absensi', $data);
    }

    function submit_absensi_fr()
    {
        $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $this->input->post('nis')]);
        if ($dataserialize->num_rows() > 0) {
            $unser = $dataserialize->row_array();
            $dataunser = unserialize($unser['fr_abs']);

            if ($dataunser == null) {
                $new_abs1 = array(
                    array(
                        'idf' => $this->input->post('idf'),
                        'data' => array(
                            array(
                                'frk' => $this->input->post('idfk'),
                                'abs' => $this->input->post('absensi')
                            )
                        )
                    )
                );
                $this->session->set_flashdata('msg', 'success');
                $this->db->update('tbl_abs_model', ['fr_abs' => serialize($new_abs1)], ['siswa_nis' => $this->input->post('nis')]);
                redirect(site_url('absensi_fr/' . $this->input->post('idf') . '/' . $this->input->post('idfk')));
                // echo "<script>window.history.go(-1); location.reload();</script>";
                die;
            } else {

                if (($key1 = array_search($this->input->post('idf'), array_column($dataunser, 'idf'))) !== false) {
                    if (($key2 = array_search($this->input->post('idfk'), array_column($dataunser[$key1]['data'], 'frk'))) !== false) {
                        // untuk pergantian status absensi
                        $new_abs1[$key1] = array(
                            'data' => array(
                                $key2 => array(
                                    'frk' => $this->input->post('idfk'),
                                    'abs' => $this->input->post('absensi')
                                )
                            )

                        );
                        $newarray =   array_replace_recursive($dataunser, $new_abs1);
                        $dataunser = $newarray;
                        //end untuk pergantian status absensi
                    } else {
                        // untuk menambah status absensi
                        $new_abs2 =
                            array(
                                'frk' => $this->input->post('idfk'),
                                'abs' => $this->input->post('absensi')
                            );
                        array_push($dataunser[$key1]['data'], $new_abs2);
                        //end untuk menambah status absensi
                    }
                } else {
                    //untuk menambah status mapel
                    $new_abs3 =
                        array(
                            'idf' => $this->input->post('idf'),
                            'data' => array(
                                array(
                                    'frk' => $this->input->post('idfk'),
                                    'abs' => $this->input->post('absensi')
                                )
                            )
                        );
                    array_push($dataunser, $new_abs3);
                    //end untuk menambah status mapel
                }
            }
            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_model', ['fr_abs' => serialize($dataunser)], ['siswa_nis' => $this->input->post('nis')]);
            redirect(site_url('absensi_fr/' . $this->input->post('idf') . '/' . $this->input->post('idfk')));
            // echo "<script>window.history.go(-1);location.reload();</script>";

        } else {
            $new_abs1 = array(
                array(
                    'idf' => $this->input->post('idf'),
                    'data' => array(
                        array(
                            'frk' => $this->input->post('idfk'),
                            'abs' => $this->input->post('absensi')
                        )
                    )
                )
            );
            $this->session->set_flashdata('msg', 'success');
            $this->db->insert('tbl_abs_model', ['siswa_nis' => $this->input->post('nis'), 'fr_abs' => serialize($new_abs1)]);
            redirect(site_url('absensi_fr/' . $this->input->post('idf') . '/' . $this->input->post('idfk')));
            die;
        }
    }

    function attendent_tgs($key, $mgg)
    {

        $where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
        $mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();


        $sql = $this->db->distinct()->select('siswa_nama,siswa_nis')->from('tbl_siswa a')->join('tbl_komen_tugas b', 'a.siswa_nis=b.user_komen', 'inner')->where(['b.id_forum' => $key, 'b.pertemuan' => $mgg])->order_by('siswa_nama ASC')->get()->result_array();

        $data['nm_mapel'] = $mapel['nm_mapel'];
        $data['dt_siswa'] = $sql;

        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/v_absensi_tgs', $data);
    }

    function submit_absensi_tgs()
    {
        $dataserialize = $this->db->get_where('tbl_abs_model', ['siswa_nis' => $this->input->post('nis')]);
        if ($dataserialize->num_rows() > 0) {
            $unser = $dataserialize->row_array();
            $dataunser = unserialize($unser['tgs_abs']);

            if ($dataunser == null) {
                $new_abs1 = array(
                    array(
                        'idtg' => $this->input->post('idtg'),
                        'data' => array(
                            array(
                                'tgk' => $this->input->post('idtgk'),
                                'abs' => $this->input->post('absensi')
                            )
                        )
                    )
                );
                $this->session->set_flashdata('msg', 'success');
                $this->db->update('tbl_abs_model', ['tgs_abs' => serialize($new_abs1)], ['siswa_nis' => $this->input->post('nis')]);
                redirect(site_url('absensi_tgs/' . $this->input->post('idtg') . '/' . $this->input->post('idtgk')));
                // echo "<script>window.history.go(-1);location.reload();</script>";
                die;
            } else {

                if (($key1 = array_search($this->input->post('idtg'), array_column($dataunser, 'idtg'))) !== false) {
                    if (($key2 = array_search($this->input->post('idtgk'), array_column($dataunser[$key1]['data'], 'tgk'))) !== false) {
                        // untuk pergantian status absensi
                        $new_abs1[$key1] = array(
                            'data' => array(
                                $key2 => array(
                                    'tgk' => $this->input->post('idtgk'),
                                    'abs' => $this->input->post('absensi')
                                )
                            )

                        );
                        $newarray =   array_replace_recursive($dataunser, $new_abs1);
                        $dataunser = $newarray;
                        //end untuk pergantian status absensi
                    } else {
                        // untuk menambah status absensi
                        $new_abs2 =
                            array(
                                'tgk' => $this->input->post('idtgk'),
                                'abs' => $this->input->post('absensi')
                            );
                        array_push($dataunser[$key1]['data'], $new_abs2);
                        //end untuk menambah status absensi
                    }
                } else {
                    //untuk menambah status mapel
                    $new_abs3 =
                        array(
                            'idtg' => $this->input->post('idtg'),
                            'data' => array(
                                array(
                                    'tgk' => $this->input->post('idtgk'),
                                    'abs' => $this->input->post('absensi')
                                )
                            )
                        );
                    array_push($dataunser, $new_abs3);
                    //end untuk menambah status mapel
                }
            }
            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_model', ['tgs_abs' => serialize($dataunser)], ['siswa_nis' => $this->input->post('nis')]);
            redirect(site_url('absensi_tgs/' . $this->input->post('idtg') . '/' . $this->input->post('idtgk')));
        } else {
            $new_abs1 = array(
                array(
                    'idtg' => $this->input->post('idtg'),
                    'data' => array(
                        array(
                            'tgk' => $this->input->post('idtgk'),
                            'abs' => $this->input->post('absensi')
                        )
                    )
                )
            );
            $this->session->set_flashdata('msg', 'success');
            $this->db->insert('tbl_abs_model', ['siswa_nis' => $this->input->post('nis'), 'tgs_abs' => serialize($new_abs1)]);
            redirect(site_url('absensi_tgs/' . $this->input->post('idtg') . '/' . $this->input->post('idtgk')));
            die;
        }
    }

    public function keyid()
    {
        $data['id'] = $this->input->post('id');
        echo json_encode($data);
        exit();
    }
    public function attendent_oc($key)
    {
        $sql1 = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $key])->row_array();
        $unser = unserialize($sql1['dt_oc']);
        $data['dt_tgl'] = $unser;

        // var_dump($unser[1]); die;

        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        if ($unser == null) {
            $this->load->view('pengajar/absensi/v_absensi_oc');
        } else {
            $this->load->view('pengajar/absensi/v_absensi_oc', $data);
        }
    }

    public function list_siswa_oc($idpel, $tgl)
    {
        // $where1 =  $this->db->get_where('tbl_pelajaran', ['id_oc' => $idpel])->row_array();
        // $where = $this->db->get_where('tbl_abs_oc', ['id_oc' => $idpel])->row_array();
        $dtsiswa = $this->db->select('siswa_nis,siswa_nama')->from('tbl_siswa a')->join('tbl_pelajaran b', 'a.siswa_kelas_id=b.id_kelas', 'inner')->where(['b.id_pelajaran' => $idpel, 'a.oc' => '1'])->order_by('siswa_nama ASC')->get()->result_array();
        $data['dt_siswa'] = $dtsiswa;
        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/absensi/v_absensi_oc_list', $data);
    }

    function submit_absensi_oc()
    {
        $dataserialize = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $this->input->post('idoc')]);

        if ($dataserialize->num_rows() > 0) {
            $unser = $dataserialize->row_array();
            $dataunser = unserialize($unser['dt_oc']);

            if (($key1 = array_search($this->input->post('tgl'), array_column($dataunser, 'tgl'))) !== false) {
                //menghilangkan nilai default null
                if (($key2 = array_search('null', array_column($dataunser[$key1]['data'], 'nis'))) !== false) {
                    $new_abs1[$key1] = array(
                        'data' => array(
                            $key2 => array(
                                'nis' => $this->input->post('nis'),
                                'absensi' => $this->input->post('absensi')
                            )
                        )
                    );
                    $newarray =   array_replace_recursive($dataunser, $new_abs1);
                    $dataunser = $newarray;
                }
                //end of menghilangkan nilai default null
                if (($key3 = array_search($this->input->post('nis'), array_column($dataunser[$key1]['data'], 'nis'))) !== false) {
                    $new_abs1[$key1] = array(
                        'data' => array(
                            $key3 => array(
                                'nis' => $this->input->post('nis'),
                                'absensi' => $this->input->post('absensi')
                            )
                        )

                    );
                    $newarray =   array_replace_recursive($dataunser, $new_abs1);
                    $dataunser = $newarray;
                } else {
                    // untuk menambah absensi siswa
                    $new_abs2 =
                        array(
                            'nis' => $this->input->post('nis'),
                            'absensi' => $this->input->post('absensi')
                        );

                    array_push($dataunser[$key1]['data'], $new_abs2);
                    //end untuk menambah absensi siswa
                }
            }
            // array_values($dataunser[$key1]['data']);

            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_oc', ['dt_oc' => serialize($dataunser)], ['id_pelajaran' => $this->input->post('idoc')]);
            redirect(site_url('absensi/list_siswa_oc/' . $this->input->post('idoc') . '/' . $this->input->post('tgl')));
            // echo "<script>window.history.go(-1);location.reload();</script>";
        }
    }

    function hapus_tgl_oc($idpel, $tgl)
    {
        // var_dump($idpel); die;
        $sql = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $idpel])->row_array();
        $dtunsersql = unserialize($sql['dt_oc']);
        foreach ($dtunsersql as $key => $value) {
            if ($value['tgl'] == $tgl) {
                unset($dtunsersql[$key]);
            }
        }
        $dtfix = array_merge($dtunsersql);
        // var_dump($dtfix); die;
        $this->session->set_flashdata('msg', 'deleted');
        $this->db->update('tbl_abs_oc', ['dt_oc' => serialize($dtfix)], ['id_pelajaran' => $idpel]);
        redirect(site_url('absensi/attendent_oc/' . $idpel));
        // echo "<script>window.history.go(-1);</script>";
        // a:3:{i:0;a:2:{s:3:"tgl";s:10:"2020-09-08";s:4:"data";a:4:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}i:1;a:2:{s:3:"nis";s:7:"2019639";s:3:"abs";s:5:"hadir";}i:2;a:2:{s:3:"nis";s:7:"2019636";s:3:"abs";s:5:"hadir";}i:3;a:2:{s:3:"nis";s:7:"2019644";s:3:"abs";s:5:"hadir";}}}i:1;a:2:{s:3:"tgl";s:10:"2020-08-20";s:4:"data";a:2:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}i:1;a:2:{s:3:"nis";s:7:"2019644";s:3:"abs";s:5:"hadir";}}}i:2;a:2:{s:3:"tgl";s:10:"2020-08-28";s:4:"data";a:1:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}}}}
    }

    function attendent_kc($key)
    {
        // var_dump($_POST); die;
        $sql1 = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $key])->row_array();
        if ($sql1 === null) {
            $this->db->insert('tbl_abs_oc', ['id_pelajaran' => $key]);
            echo "<script>location.reload();</script>";
        }
        $unser = unserialize($sql1['dt_kc']);
        $where = $this->db->get_where('tbl_pelajaran', ['id_pelajaran' => $key])->row_array();
        $mapel = $this->db->get_where('tbl_mapel', ['kd_mapel' => $where['kd_mapel']])->row_array();
        $data1['nm_mapel'] = $mapel['nm_mapel'];
        $data['dt_tgl'] = $unser;
        $data['nm_mapel'] = $data1['nm_mapel'];



        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        if ($unser == null) {
            $this->load->view('pengajar/absensi/v_absensi_kc', $data1);
        } else {
            $this->load->view('pengajar/absensi/v_absensi_kc', $data);
        }
    }

    function add_jadwal_kc()
    {
        // var_dump($_POST); die;
        $sql = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $this->input->post('id')])->row_array();
        $new_abs1 = array(
            array(
                'tgl' => $this->input->post('jdl_kelas'),
                'start' => $this->input->post('start_on'),
                'end' => $this->input->post('end_on'),
                'data' => array(
                    array(
                        'nis' => 'null',
                        'absensi' => 'null'
                    )
                )
            )
        );

        foreach ($new_abs1[0] as $key => $value) {
            if ($value === '') {
                $this->session->set_flashdata('msg', 'valid'); //jika ada yang kosong
                redirect(site_url('absensi/attendent_kc/' . $this->input->post('id')));
            }
        }


        //data yang lama
        if ($sql == null) {
            $this->db->insert('tbl_abs_oc', ['id_pelajaran' => $this->input->post('id')]);
            $this->db->update('tbl_abs_oc', ['dt_kc' => serialize($new_abs1)], ['id_pelajaran' => $this->input->post('id')]);
            $this->session->set_flashdata('msg', 'success');
        }

        //data yang lama
        if ($sql['dt_kc'] != null) {
            $dtunser = unserialize($sql['dt_kc']);
            foreach ($dtunser as $datuns) {
                if ($datuns['tgl'] == $this->input->post('jdl_kelas')) {
                    $this->session->set_flashdata('msg', 'info');
                    redirect(site_url('absensi/attendent_kc/' . $this->input->post('id')));
                }
            }
            $dtfix = array_merge($dtunser, $new_abs1);
            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_oc', ['dt_kc' => serialize($dtfix)], ['id_pelajaran' => $this->input->post('id')]);
            redirect(site_url('absensi/attendent_kc/' . $this->input->post('id')));
        }

        if ($sql['dt_kc'] == null) {
            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_oc', ['dt_kc' => serialize($new_abs1)], ['id_pelajaran' => $this->input->post('id')]);
            redirect(site_url('absensi/attendent_kc/' . $this->input->post('id')));
        }

        //end of data lama

    }

    function hapus_tgl_kc($idpel, $tgl)
    {
        // var_dump($idpel); die;
        $sql = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $idpel])->row_array();
        $dtunsersql = unserialize($sql['dt_kc']);
        foreach ($dtunsersql as $key => $value) {
            if ($value['tgl'] == $tgl) {
                unset($dtunsersql[$key]);
            }
        }
        $dtfix = array_merge($dtunsersql);
        // var_dump($dtfix); die;
        $this->db->update('tbl_abs_oc', ['dt_kc' => serialize($dtfix)], ['id_pelajaran' => $idpel]);
        $this->session->set_flashdata('msg', 'deleted');
        redirect(site_url('absensi/attendent_kc/' . $idpel));
        // echo "<script>window.history.go(-1);location.reload();</script>";
        // a:3:{i:0;a:2:{s:3:"tgl";s:10:"2020-09-08";s:4:"data";a:4:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}i:1;a:2:{s:3:"nis";s:7:"2019639";s:3:"abs";s:5:"hadir";}i:2;a:2:{s:3:"nis";s:7:"2019636";s:3:"abs";s:5:"hadir";}i:3;a:2:{s:3:"nis";s:7:"2019644";s:3:"abs";s:5:"hadir";}}}i:1;a:2:{s:3:"tgl";s:10:"2020-08-20";s:4:"data";a:2:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}i:1;a:2:{s:3:"nis";s:7:"2019644";s:3:"abs";s:5:"hadir";}}}i:2;a:2:{s:3:"tgl";s:10:"2020-08-28";s:4:"data";a:1:{i:0;a:2:{s:3:"nis";s:7:"2019638";s:3:"abs";s:5:"hadir";}}}}
    }

    function list_siswa_kc($idpel, $tgl)
    {
        // $where1 =  $this->db->get_where('tbl_pelajaran', ['id_oc' => $idpel])->row_array();
        // $where = $this->db->get_where('tbl_abs_oc', ['id_oc' => $idpel])->row_array();
        $dtsiswa = $this->db->select('siswa_nis,siswa_nama')->from('tbl_siswa a')->join('tbl_pelajaran b', 'a.siswa_kelas_id=b.id_kelas', 'inner')->where(['b.id_pelajaran' => $idpel, 'a.kc' => '1'])->order_by('siswa_nama ASC')->get()->result_array();
        $data['dt_siswa'] = $dtsiswa;
        $this->load->view('pengajar/layout/v_header');
        $this->load->view('pengajar/layout/v_navbar');
        $this->load->view('pengajar/absensi/v_absensi_kc_list', $data);
    }

    function submit_absensi_kc()
    {
        $dataserialize = $this->db->get_where('tbl_abs_oc', ['id_pelajaran' => $this->input->post('idkc')]);
        // var_dump($_POST);
        // die;


        if ($dataserialize->num_rows() > 0) {
            $unser = $dataserialize->row_array();
            $dataunser = unserialize($unser['dt_kc']);
            if (($key1 = array_search($this->input->post('tgl'), array_column($dataunser, 'tgl'))) !== false) {
                //menghilangkan nilai default null
                if (($key2 = array_search('null', array_column($dataunser[$key1]['data'], 'nis'))) !== false) {
                    $new_abs1[$key1] = array(
                        'data' => array(
                            $key2 => array(
                                'nis' => $this->input->post('nis'),
                                'absensi' => $this->input->post('absensi')
                            )
                        )
                    );
                    $newarray =   array_replace_recursive($dataunser, $new_abs1);
                    $dataunser = $newarray;
                }
                //end of menghilangkan nilai default null
                if (($key3 = array_search($this->input->post('nis'), array_column($dataunser[$key1]['data'], 'nis'))) !== false) {
                    $new_abs1[$key1] = array(
                        'data' => array(
                            $key3 => array(
                                'nis' => $this->input->post('nis'),
                                'absensi' => $this->input->post('absensi')
                            )
                        )
                    );
                    $newarray =   array_replace_recursive($dataunser, $new_abs1);
                    $dataunser = $newarray;
                } else {
                    // untuk menambah absensi siswa
                    $new_abs2 =
                        array(
                            'nis' => $this->input->post('nis'),
                            'absensi' => $this->input->post('absensi')
                        );

                    array_push($dataunser[$key1]['data'], $new_abs2);
                    //end untuk menambah absensi siswa
                }
            }
            // var_dump($dataunser[0]);
            // die;
            $this->session->set_flashdata('msg', 'success');
            $this->db->update('tbl_abs_oc', ['dt_kc' => serialize($dataunser)], ['id_pelajaran' => $this->input->post('idkc')]);
            redirect(site_url('absensi/list_siswa_kc/' . $this->input->post('idkc') . '/' . $this->input->post('tgl')));
            // echo "<script>window.history.go(-1);location.reload();</script>";
            // var_dump($result[1]);
        }
    }
}
