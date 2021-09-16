<?php 
foreach ($data_peserta as $key) {
  $id_peserta = $key['id_peserta'];
  $nim = $key['nim'];
}
 ?>
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <br>
        <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?= $title; ?></h1>
        </section>
        
        <!-- Main content -->
        <section class="content">
          <div class="callout callout-info">
            <h4><?= $judul; ?></h4>

            <p>Unggah Berkas sesuai dengan format!</p>
          </div>
          <div class="callout callout-danger">
            <h4>Format Berkas .pdf Maxs 2 MB</h4>
            <p>Berkas Lamaran Disatukan Dalam Satu Pdf secara berurutan dengan Ukuran Maksimal 2 MB</p>
          </div>

          <?= $this->include('layouts/notifikasi'); ?>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?= $judul; ?></h3>
            </div>
            
            <?= form_open_multipart('registrasi/verifikasi_tahap3/'.$id_peserta.'/'.$nim); ?>
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Formasi Lab</label>
                      <select class="form-control select2" name="id_lab" style="width: 100%;" required>
                        <option selected="selected" value="">--- Pilih ---</option>
                        <?php
                        foreach ($formasi_lab as $key) {
                          
                         ?>
                        <option value="<?= $key['id_lab']; ?>"><?= $key['nama_lab']; ?></option>
                      <?php 
                      } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Berkas Lamaran</label>
                      <input type="file" id="exampleInputFile" name="berkas_peserta">
                    </div>
                  </div>
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left">Pendaftaran Selesai</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
  </div>