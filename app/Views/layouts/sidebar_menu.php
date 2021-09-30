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
    <a href="<?= base_url('Admin/FormasiLab'); ?>">
      <i class="fa fa-university"></i>
      <span>Formasi Lab</span>
    </a>
  </li>

  <li class="<?= ($page == 'jenis_soal') ? "treeview active" : ''  ?>">
    <a href="<?= base_url('Admin/JenisSoal'); ?>">
      <i class="fa fa-files-o"></i>
      <span>Jenis Soal</span>
    </a>
  </li>

  <li class="<?= ($page == 'pertanyaan_soal' || $page == 'pertanyaan_edit') ? "treeview active" : "treeview" ?>">
    <a href="#">
      <i class="fa fa-edit"></i>
      <span>Pertanyaan Soal</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($jenis_soal as $key) {
      ?>
      <li><a href="<?= base_url('Admin/PertanyaanSoal/soal/'.$key['id_soal']); ?>"><i class="fa fa-circle-o"></i> <?= $key['nama_soal']; ?></a></li>
    <?php 
    } 
    ?>
    </ul>
  </li>

  <li class="<?= ($page == 'data_peserta' || $page == 'view_peserta') ? "treeview active" : "treeview"; ?>">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Data Peserta</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($peminatan as $p) {
       ?>
      <li><a href="<?= base_url('Admin/DataPeserta/formasi/'.$p['id_peminatan']); ?>"><i class="fa fa-circle-o"></i> <?= $p['nama_peminatan']; ?></a></li>
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
      <?php foreach ($peminatan as $p) {
       ?>
      <li><a href="<?= base_url('Admin/DataNilai/formasi/'.$p['id_peminatan']); ?>"><i class="fa fa-circle-o"></i> <?= $p['nama_peminatan']; ?></a></li>
      <?php } ?>
    </ul>
  </li>

</ul>