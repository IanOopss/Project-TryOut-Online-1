<?php 
  $id_peserta = $data_peserta['id_peserta'];
  $email = $data_peserta['email'];
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

            <p>Unggah Bukti Pembayaran sesuai dengan format!</p>
          </div>
          <div class="callout callout-danger">
            <h4>Format file .jpg, .jpeg, .png Maxs 2 MB</h4>
            <p>Berkas Lamaran Disatukan Dalam Satu Pdf secara berurutan dengan Ukuran Maksimal 2 MB</p>
          </div>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?= $judul; ?></h3>
            </div>
            
            <?= form_open_multipart('registrasi/verifikasi_tahap3/'.$id_peserta.'/'.$email); ?>
              <?= csrf_field() ;?>
                <div class="box-body">
                  <div class="container">
                    <div class="form-group row mb-4">
                      <label>Foto</label>
                      <div class="col-sm-8 col-md-4">
                        <img src="<?= base_url() ;?>/assets/academy/img/web/preview.png" class="img-preview">
                      </div>
                      <div class="col-sm-10 col-md-8">
                        <input type="file" id="foto" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                        <p>.jpg Maxs 500Kb</p>
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto') ;?>
                        </div>
                      </div>
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