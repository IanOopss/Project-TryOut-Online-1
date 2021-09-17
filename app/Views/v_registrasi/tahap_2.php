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
            <p>Dengan NIM <?= $data_peserta['nim']; ?> </p>
          </div>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?= $judul; ?></h3>
            </div>
            
            <?= form_open_multipart('registrasi/verifikasi_tahap2/'.$data_peserta['id_peserta'].'/'.$data_peserta['nim']); ?>
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Mahasiswa</label>
                      <input type="text" name="nama_peserta" class="form-control <?= ($validation->hasError('nama_peserta')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Nama Mahasiswa" value="<?= old('nama_peserta') ;?>" autofocus required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('nama_peserta') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>IPK</label>
                      <input type="text" name="ipk" class="form-control <?= ($validation->hasError('ipk')) ? 'is-invalid' : '' ;?>" 
                        placeholder="IPK" value="<?= old('ipk') ;?>" data-inputmask='"mask": "9.99"' data-mask required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('ipk') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tmp_lahir" class="form-control <?= ($validation->hasError('tmp_lahir')) ? 'is-invalid' : '' ;?>" 
                        placeholder="Tempat Lahir" value="<?= old('tmp_lahir') ;?>" required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('tmp_lahir') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control <?= ($validation->hasError('tgl_lahir')) ? 'is-invalid' : '' ;?>"
                       id="datepicker" placeholder="Tanggal Lahir" value="<?= old('tgl_lahir') ;?>" required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('tgl_lahir') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" id="optionsRadios1" value="Laki-laki" checked>
                          Laki-laki
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" id="optionsRadios2" value="Perempuan">
                          Perempuan
                        </label>
                      </div>
                      <div class="invalid-feedback">
                          <?= $validation->getError('password') ;?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No Hp</label>
                      <input type="text" name="no_hp" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : '' ;?>"
                       placeholder="No Hp" value="<?= old('no_hp') ;?>" required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('no_hp') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>"
                       placeholder="Email" value="<?= old('email') ;?>" required>
                      <div class="invalid-feedback">
                          <?= $validation->getError('email') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Agama</label>
                      <select class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : '' ;?> select2" name="agama" style="width: 100%;" required>
                        <option selected="selected" value="" disabled>--- Pilih ---</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                      </select>
                      <div class="invalid-feedback">
                          <?= $validation->getError('agama') ;?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" id="foto" name="foto" required>
                      <p>.jpg Maxs 200Kb</p>
                      <div class="invalid-feedback">
                          <?= $validation->getError('foto') ;?>
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