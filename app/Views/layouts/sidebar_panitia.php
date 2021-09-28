<ul class="sidebar-menu" data-widget="tree">

  <li class="header">MAIN NAVIGATION</li>

  <li class="<?php if ($page == 'dashboard_panitia') echo "treeview active";  ?>">
    <a href="<?= base_url('panitia'); ?>">
      <i class="fa fa-dashboard"></i> 
      <span>Dashboard</span>
    </a>
  </li>

  <li class="<?php if ($page == 'formasi_lab') echo "treeview active";  ?>">
    <a href="<?= base_url('Admin/FormasiLab'); ?>">
      <i class="fa fa-university"></i>
      <span>Formasi Lab</span>
    </a>
  </li>

  <li class="<?php if ($page == 'jenis_soal') echo "treeview active";  ?>">
    <a href="<?= base_url('Admin/JenisSoal'); ?>">
      <i class="fa fa-files-o"></i>
      <span>Jenis Soal</span>
    </a>
  </li>

  <li class="<?php if ($page == 'pertanyaan_soal' OR $page == 'pertanyaan_edit') echo "treeview active"; else echo "treeview"; ?>">
    <a href="#">
      <i class="fa fa-edit"></i>
      <span>Pertanyaan Soal</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($jenis_soal as $key) { ?>
      <li><a href="<?= base_url('Admin/PertanyaanSoal/soal/'.$key['id_soal']); ?>"><i class="fa fa-circle-o"></i> <?= $key['nama_soal']; ?></a></li>
    <?php 
    } 
    ?>
    </ul>
  </li>

  <li class="<?php if ($page == 'data_peserta' OR $page == 'view_peserta') echo "treeview active"; else echo "treeview"; ?>">
    <a href="#">
      <i class="fa fa-pie-chart"></i>
      <span>Data Peserta</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($formasi_lab as $lab) { ?>
      <li><a href="<?= base_url('Admin/DataPeserta/formasi/'.$lab['id_lab']); ?>"><i class="fa fa-circle-o"></i> <?= $lab['nama_lab']; ?></a></li>
      <?php } ?>
    </ul>
  </li>

  <li class="<?php if ($page == 'data_nilai') echo "treeview active"; else echo "treeview"; ?>">
    <a href="#">
      <i class="fa fa-file"></i>
      <span>Data Nilai</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <?php foreach ($formasi_lab as $lab) { ?>
      <li><a href="<?= base_url('Admin/DataNilai/formasi/'.$lab['id_lab']); ?>"><i class="fa fa-circle-o"></i> <?= $lab['nama_lab']; ?></a></li>
      <?php } ?>
    </ul>
  </li>

</ul>