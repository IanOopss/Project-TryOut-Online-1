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

            <p>Data Biodata diisi dengan benar dan teliti!</p>
          </div>
          <div class="callout callout-danger">
            <h4>Ukuran Foto 3X4 Cm format .jpg Maxs 500Kb</h4>
          </div>
          <div class="callout callout-success">
            <h4>Akun Berhasil Dibuat</h4>
            <p>Dengan Email <strong><?= $data_peserta['email']; ?> </strong></p>
          </div>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?= $judul; ?></h3>
            </div>
            
            <?= form_open_multipart('registrasi/verifikasi_tahap2/'.$data_peserta['id_peserta'].'/'.$data_peserta['email']); ?>
              <?= csrf_field() ;?>
              <div class="container">
                <div class="row">
                  <div class="col">
                    <div class="form-group mb-4">
                      <label>Nama Lengkap</label>
                      <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Nama Mahasiswa" value="<?= old('nama') ;?>" autofocus>
                      <div class="invalid-feedback">
                          <?= $validation->getError('nama') ;?>
                      </div>
                    </div>
                    
                    <div class="form-group mb-4">
                      <label>Jenis Kelamin</label>
                      <div class="form-check">
                        <input type="radio" class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ;?>" 
                          id="optionsRadio1" name="jenis_kelamin" value="Laki-laki" 
                          <?php  
                            if(old('jenis_kelamin') == 'Laki-laki'){
                              echo 'checked';
                            }
                          ?>
                          >
                        <label class="form-check-label" for="optionsRadio1">Laki-laki</label>
                      </div>
                      <div class="form-check mb-3">
                        <input type="radio" class="form-check-input <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ;?>"
                          id="optionsRadio2" name="jenis_kelamin" value="Perempuan" 
                          <?php  
                            if(old('jenis_kelamin') == 'Perempuan'){
                              echo 'checked';
                            }
                          ?>
                          >
                        <label class="form-check-label" for="optionsRadio2">Perempuan</label>
                        <div class="invalid-feedback"><?= $validation->getError('jenis_kelamin') ;?></div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <label>No Hp</label>
                      <input type="text" name="no_hp" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ;?>"
                      placeholder="No Hp" value="<?= old('no_hp') ;?>">
                      <div class="invalid-feedback">
                        <?= $validation->getError('no_hp') ;?>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group mb-4">
                      <label>Peminatan</label>
                      <select class="form-control select2 <?= ($validation->hasError('peminatan')) ? 'is-invalid' : '' ;?>" name="peminatan" style="width: 100%;">
                        <option selected disabled value="">--- Pilih ---</option>
                        <?php foreach($peminatan as $key) { ?>
                        <option value="<?= $key['id_peminatan']; ?>"
                        <?php  
                          if(old('peminatan') && old('peminatan') == $key['id_peminatan']){
                              echo 'selected';
                          }
                        ?>
                        ><?= $key['nama_peminatan']; ?></option>
                      <?php 
                      } ?>
                      </select>
                      <div class="invalid-feedback">
                        <?= $validation->getError('peminatan') ;?>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label>Foto</label>
                      <div class="col-sm-4 col-md-3">
                        <img src="<?= base_url() ;?>/assets/academy/img/web/preview.png" class="img-preview">
                      </div>
                      <div class="col-sm-8 col-md-7">
                        <input type="file" id="foto" name="foto" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : '' ;?>">
                        <p>.jpg Maxs 500Kb</p>
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto') ;?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left">Submit</button>
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