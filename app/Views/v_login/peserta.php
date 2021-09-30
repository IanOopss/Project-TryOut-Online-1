<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login Peserta</p>

    <?= form_open('login/peserta_login'); ?>
    <?= csrf_field() ;?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ;?>" 
           name="email" placeholder="Email" value="<?= old('email') ;?>" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('email') ;?>
        </div>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ;?>" 
          name="password" placeholder="Password" value="<?= old('password') ;?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <div class="invalid-feedback">
            <?= $validation->getError('password') ;?>
        </div>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-8">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <a href="<?= base_url('/') ?>">
            <button type="button" class="btn btn-success btn-block btn-flat">Home</button>
          </a>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
