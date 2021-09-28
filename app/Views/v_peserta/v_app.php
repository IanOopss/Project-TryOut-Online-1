<?php 
echo $this->include('layouts/head');

foreach ($informasi as $key) {
  $tgl_ujian_cat = $key['tgl_ujian_cat'];
  $waktu_pengerjaan = $key['waktu_pengerjaan'];
}

$status_verifikasi = $peserta['status_verifikasi'];

$tgl_sekarang = date('Y-m-d');
?>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>B.</b>A</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          
        </div>
        <!-- /.navbar-collapse -->

        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                 <img src="<?= base_url(); ?>/assets/adminlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= $peserta['nama_peserta']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= base_url(); ?>/assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    <?= $peserta['nama_peserta'] ?>
                    <small><?= $peserta['nim'] ?></small>
                  </p>
                </li>
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?= base_url('peserta/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <?php 
    if ($page == 'dashboard_peserta') {
      if ($status_verifikasi == 'Lulus') {
        include 'dashboard/index.php';
      }else{
        include 'dashboard/tidak_lulus.php';
      }
    }elseif ($page == 'ujian_cat'){
      include 'ujian_cat/index.php';
    }

   ?>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Bang Ambo University All rights reserved  
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<?= $this->include('layouts/foot') ?>
