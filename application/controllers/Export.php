<?php defined('BASEPATH') or die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // $data['semua_pengguna'] = $this->export_model->getAll()->result();
        // $this->load->view('export', $data);
    }

    public function export()
    {
        // $siswa = $this->db->select('id, name, kelasid')->from('user')->where(['kelasid' => $id])->get()->result_array();
        $header = $this->db->select('id, namapelajaran')->from('matapelajaran')->where(['kelasid' => $id])->order_by('sort_by', 'asc')->order_by('namapelajaran', 'asc')->get()->result_array();

        // $dt_dummy = array();
        // $dt_nilai = array();
        // foreach ($siswa as $val) {
        //     $dt_dummy['data'] = array(
        //         'siswa' => $val['name'],
        //         'kelas' => $val['kelasid']
        //     );

        //     foreach ($header as $head) {
        //         $nilai = $this->db->get_where('jawaban', ['userid' => $val['id'], 'matapelajaranid' => $head['id']])->row_array();

        //         $cond = !empty($nilai['nilai']) ? $nilai['nilai'] : 0;

        //         $dt_dummy['data']['nilai'][] = array(
        //             'mapel' => $head['namapelajaran'],
        //             'nilai' => $cond
        //         );
        //     }

        //     $dt_nilai[] = $dt_dummy;
        // }
        // var_dump($dt_nilai[0]);
        // die;

        $filename = 'template-rekon-channeling'; // set filename for csv file to be exported

        $csv_header = '';
        $csv_header .= 'NO|NAMA SISWA|KELAS|';
        // looping header mapel
        foreach ($header as $key => $col) {
            $csv_header .= strtoupper($col['namapelajaran']) . '|';
        }
        $csv_header .= "\n";

        // looping data nilai siswa
        // $csv_row = "";

        // for ($i = 0; $i < count($dt_nilai); $i++) {
        //     $csv_row .= ($i + 1) . '|';
        //     $csv_row .= $dt_nilai[$i]['data']['siswa'] . '|' . $dt_nilai[$i]['data']['kelas'] . '|';

        //     $kolom = array_column($dt_nilai[$i], 'siswa');
        //     if (array_search($dt_nilai[$i]['data']['siswa'], $kolom) !== false) {
        //         foreach ($dt_nilai[$i]['data']['nilai'] as $val) {
        //             $csv_row .= $val['nilai'] . '|';
        //         }
        //     }
        //     $csv_row .= "\n";
        // }
        // var_dump($csv_row);
        // die;
        // end data nilai siswa

        $csv_header = '';
        foreach ($nm_column as $key => $col) {
            $csv_header .= $col . '|';
        }
        $csv_header .= "\n";

        $csv_row = '7081935337|LD1826138904|Hary Sudaryanto|1|12|2019-10-12|50000000.00|2019-12-12|99037645.71|';
        $csv_row .= "\n";

        /* Download as CSV File */
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        echo $csv_header . $csv_row;
        exit;
    }
}
