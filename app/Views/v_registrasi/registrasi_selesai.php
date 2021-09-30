<?php 
  foreach ($informasi as $key ) {
    $nama_kegiatan = $key['nama_kegiatan'];
  }
  
  
  $id_peserta = $data_peserta['id_peserta'];
  $email = $data_peserta['email'];
  $nama_peserta = $data_peserta['nama_peserta'];
 ?>
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <br>
        <img src="<?= base_url(); ?>assets/academy/img/core-img/logo.png" alt="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <div class="callout callout-info">
            <h4><?= $nama_kegiatan; ?></h4>
          </div>
        </section>
        
        <!-- Main content -->
        <section class="content">
          <div class="callout callout-info">
            <h4><?= $judul; ?></h4>

            <p>Anda Berhasil Melakuan Pendaftaran <?= $nama_kegiatan; ?>!</p>
            <p>Untuk Mengetahui Pengumuman Lulus Adminitrasi!</p>
            <p>Silakan Login dengan menggunakan Email dan Password Anda !</p>
          </div>

          <div class="callout callout-success">
            <h4>Email : <?= $email; ?></h4>
          </div>

          <a href="<?= base_url('/'); ?>">
            <button type="submit" class="btn btn-primary pull-left">Home</button>
          </a>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
  </div>