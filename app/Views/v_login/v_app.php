<?php
foreach ($informasi as $key) {
	$tgl_ujian_cat = $key['tgl_ujian_cat'];
}

echo $this->include('layouts/head.php'); 

$tgl_sekarang = date('Y-m-d');

if ($page == 'login_panitia') {
	include 'panitia.php';
}elseif ($page == 'login_peserta') {
	if ($tgl_sekarang >= $tgl_ujian_cat) {
		include 'peserta.php';
	}else{
		include 'waktu_belum.php';
	}
}

echo $this->include('layouts/foot');
?>



