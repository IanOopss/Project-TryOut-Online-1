<?php 
  echo $this->include('layouts/head');
?>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini" onload="setInterval('displayServerTime()', 1000);">
<!-- Site wrapper -->
<div class="wrapper">
<?php 

  if (session()->get('level_admin') == "1") {
     echo $this->include('layouts/header');
   } else{
     echo $this->include('layouts/header_panitia');
   }
?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>/assets/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          
          <p><?= session()->get('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      if (session()->get('level_admin') == "1") {
         echo $this->include('layouts/sidebar_menu');
       } else{
          echo $this->include('layouts/sidebar_panitia');
       }
       ?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <?php 
  // Admin
  if ($page == 'dashboard_admin') { 
    include 'dashboard/index.php';
  }elseif ($page == 'admin_edit'){ 
    include 'dashboard/admin_edit.php'; 
  }elseif ($page == 'informasi_pendaftaran'){ 
    include 'informasi_pendaftaran/index.php'; 
  }elseif ($page == 'formasi_lab'){ 
    include 'formasi_lab/index.php'; 
  }elseif ($page == 'jenis_soal'){ 
    include 'jenis_soal/index.php'; 
  }elseif ($page == 'pertanyaan_soal'){ 
    include 'pertanyaan_soal/index.php'; 
  }elseif ($page == 'pertanyaan_edit'){ 
    include 'pertanyaan_soal/edit.php'; 
  }elseif ($page == 'data_panitia'){ 
    include 'data_panitia/index.php'; 
  }elseif ($page == 'data_peserta'){ 
    include 'data_peserta/index.php'; 
  }elseif ($page == 'view_peserta'){ 
    include 'data_peserta/view.php'; 
  }elseif ($page == 'data_nilai'){ 
    include 'data_nilai/index.php'; 
  }

  // Panitia
  elseif ($page == 'dashboard_panitia'){ 
    include 'dashboard_panitia/index.php'; 
  }elseif ($page == 'panitia_edit'){ 
    include 'dashboard_panitia/panitia_edit.php'; 
  }else{
    echo base_url('access_denied/not_found');
  }
  ?>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    Copyright &copy;<script>document.write(new Date().getFullYear());</script> Bang Ambo University All rights reserved 
  </footer>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php 
  echo $this->include('layouts/foot');
?>
