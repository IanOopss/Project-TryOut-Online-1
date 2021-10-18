<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login Peserta</p>

      <div class="callout callout-info">
          <h4>TryOut Online</h4>

          <p>Silakan Login pada tanggal <?= tgl_indonesia($tgl_ujian_cat); ?> untuk mengikuti tryout online</p>
        </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <a href="<?= base_url('/') ?>">
            <button type="button" class="btn btn-success btn-block btn-flat">Home</button>
          </a>
        </div>
        <!-- /.col -->
      </div>
   
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
