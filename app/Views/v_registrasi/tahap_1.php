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
      <p>Daftarkan dirimu agar dapat mengikuti Tryout Online</p>
    </div>
    <?= form_open('registrasi/verifikasi_tahap1'); ?>
    <?= csrf_field() ;?>
      <div class="form-group row mb-4">
        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>" 
           name="email" placeholder="Email" value="<?= old('email') ;?>" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('email') ;?>
        </div>
      </div>
      <div class="form-group row mb-4">
        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ;?>" 
          name="password" placeholder="Password" value="<?= old('password') ;?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('password') ;?>
        </div>
      </div>
      <div class="form-group row mb-4">
        <input type="password" class="form-control <?= ($validation->hasError('confirm_password')) ? 'is-invalid' : '' ;?>" 
        name="confirm_password" placeholder="Confirm Password" value="<?= old('confirm_password') ;?>" >
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
