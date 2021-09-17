<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?= $title; ?></p>
    <div class="callout callout-info">
      <h4><?= $judul; ?></h4>

      <p>Pendaftaran Hanya Bisa Dilakukan Oleh Mahasiswa Jurusan Teknik Informatika Angkatan 2018</p>
      <p>Contoh: NIM Mahasiswa 201846001</p>
      <p>2017 = Angkatan. 46 = Jurusan Teknik Informatika. 001 = Nomor Mahasiswa</p>
    </div>
    
    <?= form_open('registrasi/verifikasi_tahap1'); ?>
    <?= csrf_field() ;?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : '' ;?>" 
          maxlength="9" minlength="9" name="nim"  placeholder="NIM" data-inputmask='"mask": "999999999"' 
          data-mask value="<?= old('nim') ;?>" autofocus required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('nim') ;?>
        </div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ;?>" 
          maxlength="15" minlength="8" name="password" placeholder="Password" value="<?= old('password') ;?>" 
          required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('password') ;?>
        </div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ;?>" 
        maxlength="15" minlength="8" name="confirm_password" placeholder="Confirm Password" value="<?= old('confirm_password') ;?>"  
        required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('confirm_password') ;?>
        </div>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
          <button type="submit" class="btn btn-danger btn-block btn-flat" onclick="window.history.back();">Back</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
