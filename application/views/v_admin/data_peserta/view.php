<?php 
foreach ($cek_lab as $formasi) {
  $nama_lab = $formasi->nama_lab;
}

foreach ($view_peserta as $view) {
  
}

 ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title." Formasi ".$nama_lab; ?>
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
                        <img src="<?php echo base_url('uploads/berkas_peserta/'.$view->foto); ?>" alt="">
                      </div>
                      <!-- /.widget-user-image -->
                      <h3 class="widget-user-username"><?php echo $view->nama_peserta; ?></h3>
                      <h5 class="widget-user-desc"><?php echo $view->tmp_lahir.", ".tgl_indonesia($view->tgl_lahir) ; ?></h5>
                    </div>
                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="#"><?php echo $view->ipk; ?></a></li>
                        <li><a href="#"><?php echo $view->jenis_kelamin; ?></a></li>
                        <li><a href="#"><?php echo $view->agama; ?></a></li>
                        <li><a href="#"><?php echo $view->no_hp; ?></a></li>
                        <li><a href="#"><?php echo $view->email; ?></a></li>
                        <li><a href="#">Tanggal Pendaftan <span class="pull-right badge bg-aqua"><?php echo tgl_indonesia($view->tgl_selesai_pendaftaran); ?></span></a></li>
                        <li><a href="#">Status Pendaftaran <span class="pull-right badge bg-green"><?php echo $view->status_pendaftaran; ?></span></a></li>
                        <li><a href="#">Status Verifikasi <span class="pull-right badge bg-red"><?php echo $view->status_verifikasi; ?></span></a></li>
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