<?php
foreach ($informasi as $key) {
	$tgl_lulus_adm = $key['tgl_lulus_adm'];
}

echo $this->include('layouts/head.php'); 

$tgl_sekarang = date('Y-m-d');

if ($page == 'login_panitia') {
	include 'panitia.php';
}elseif ($page == 'login_peserta') {
	if ($tgl_sekarang >= $tgl_lulus_adm) {
		include 'peserta.php';
	}else{
		include 'waktu_belum.php';
	}
}

echo $this->include('layouts/foot');

?>



