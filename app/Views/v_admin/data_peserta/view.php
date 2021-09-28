<?php 
  $nama_lab = $cek_lab['nama_lab'];
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title." Formasi ".$nama_lab; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Peserta </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- Widget: user widget style 1 -->
                  <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                      <div class="widget-user-image">
                        <img src="<?= base_url('assets/academy/img/uploads/berkas_peserta/'.$view_peserta['foto']); ?>" alt="">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username"><?= $view_peserta['nama_peserta']; ?></h3>
                      <h5 class="widget-user-desc"><?= $view_peserta['tmp_lahir'].", ".tgl_indonesia($view_peserta['tgl_lahir']) ; ?></h5>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="#"><?= $view_peserta['ipk']; ?></a></li>
                        <li><a href="#"><?= $view_peserta['jenis_kelamin']; ?></a></li>
                        <li><a href="#"><?= $view_peserta['agama']; ?></a></li>
                        <li><a href="#"><?= $view_peserta['no_hp']; ?></a></li>
                        <li><a href="#"><?= $view_peserta['email']; ?></a></li>
                        <li><a href="#">Tanggal Pendaftan <span class="pull-right badge bg-aqua"><?= tgl_indonesia($view_peserta['tgl_selesai_pendaftaran']); ?></span></a></li>
                        <li><a href="#">Status Pendaftaran <span class="pull-right badge bg-green"><?= $view_peserta['status_pendaftaran']; ?></span></a></li>
                        <li><a href="#">Status Verifikasi <span class="pull-right badge bg-green"><?= $view_peserta['status_verifikasi']; ?></span></a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.widget-user -->
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" onclick="window.history.back();">Back</button>
            </div>

        </div>
      </div>  
    </section>
    <!-- /.content -->


  </div>
  <!-- /.content-wrapper -->