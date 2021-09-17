<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <br>
        <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
         <div class="callout callout-info">
            <h4><?= $nama_kegiatan; ?></h4>
            <h4>Pendaftaran Belum Dibuka</h4>
            <p>Pendaftaran Dapat Dilakukan Pada Tanggal <?= tgl_indonesia($tgl_pendaftaran); ?></p>
          </div>

        </section>
        
        <!-- Main content -->
        <section class="content">
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