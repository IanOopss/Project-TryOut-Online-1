
<ul class="sidebar-menu" data-widget="tree">

  <li class="header">MAIN NAVIGATION</li>

  <li class="<?= ($page == 'dashboard_admin') ? "treeview active" : ''  ?>">
    <a href="<?= base_url('Admin/Dashboard'); ?>">
      <i class="fa fa-dashboard"></i> 
      <span>Dashboard</span>
    </a>
  </li>

  <li class="<?= ($page == 'informasi_pendaftaran') ? "treeview active" : ''  ?>">
    <a href="<?= base_url('Admin/InformasiPendaftaran'); ?>">
      <i class="fa fa-info"></i>
      <span>Informasi Pendaftaran</span>
    </a>
  </li>

  <li class="<?= ($page == 'data_panitia') ? "treeview active" : '' ?>">
    <a href="<?= base_url('Admin/DataPanitia'); ?>">
      <i class="fa fa-users"></i>
      <span>Data Panitia</span>
    </a>
  </li>

  <li class="<?= ($page == 'formasi_lab') ? "treeview active" : ''  ?>">
    <a href="<?= base_url('Admin/formasi_lab'); ?>">
      <i class="fa fa-university"></i>
      <span>Formasi Lab</span>
    </a>
  </li>

  <li class="<?= ($page == 'jenis_soal') ? "treeview active" : ''  ?>">
    <a href="<?= base_url('Admin/jenis_soal'); ?>">
      <i class="fa fa-files-o"></i>
      <span>Jenis Soal</span>
    </a>
  </li>

  <li class="<?= ($page == 'pertanyaan_soal' OR $page == 'pertanyaan_edit') ? "treeview active" : "treeview" ?>">
    <a href="#">
      <i class="fa fa-edit"></i>
      <span>Pertanyaan Soal</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($jenis_soal as $key) {
        # code...
      ?>
      <li><a href="<?= base_url('Admin/pertanyaan_soal/soal/'.$key['id_soal']); ?>"><i class="fa fa-circle-o"></i> <?= $key['nama_soal']; ?></a></li>
    <?php 
    } 
    ?>
    </ul>
  </li>

  <li class="<?= ($page == 'data_peserta' OR $page == 'view_peserta') ? "treeview active" : "treeview"; ?>">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Data Peserta</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($formasi_lab as $lab) {
        # code...
       ?>
      <li><a href="<?= base_url('Admin/data_peserta/formasi/'.$lab['id_lab']); ?>"><i class="fa fa-circle-o"></i> <?= $lab['nama_lab']; ?></a></li>
      <?php } ?>
    </ul>
  </li>

  <li class="<?= ($page == 'data_nilai') ? "treeview active" : "treeview"; ?>">
    <a href="#">
      <i class="fa fa-file"></i>
      <span>Data Nilai</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($formasi_lab as $lab) {
        # code...
       ?>
      <li><a href="<?= base_url('Admin/data_nilai/formasi/'.$lab['id_lab']); ?>"><i class="fa fa-circle-o"></i> <?= $lab['nama_lab']; ?></a></li>
      <?php } ?>
    </ul>
  </li>

</ul>