<?php 

function check($kelas, $mapel){
	$ci = get_instance();

	$result = $ci->db->get_where('tbl_pelajaran', ['id_kelas' => $kelas, 'kd_mapel' => $mapel]);
	if($result->num_rows() > 0){
		return "checked='checked'";
	}
}

?>