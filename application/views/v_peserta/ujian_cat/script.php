<script src="<?php echo base_url(); ?>assets/flip/compiled/flipclock.js"></script>
<script type="text/javascript">

	<?php 
	date_default_timezone_set('Asia/Jakarta');
	$tgl = date('Y-m-d H:i:s');
	$awal  = strtotime($tgl);
	$akhir = strtotime($waktu_selesai);
	$diff  = $akhir - $awal;
	 ?>
	var clock;
	
	$(document).ready(function() {
		var clock;

		clock = $('.clock').FlipClock({
	        clockFace: 'DailyCounter',
	        autoStart: false,
	        callbacks: {
	        	stop: function() {
	        		window.location.assign("<?php echo base_url(); ?>peserta/selesai_ujian"); 
	        	}
	        }
	    });
			    
	    clock.setTime(<?php echo  $diff;?>);
	    clock.setCountdown(true);
	    clock.start();

	});
</script>