<?php 
  $id_lab = $cek_lab['id_lab'];
  $nama_lab = $cek_lab['nama_lab'];
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title." Formasi ".$nama_lab; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-body">
              <div class="btn-group">
                <button type="button" class="btn btn-success">Print</button>
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="<?= base_url('Admin/DataPeserta/cetak/'.$id_lab); ?>">Lulus Verifikasi</a></li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tabel <?= $title." Formasi ".$nama_lab; ?> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>NIM</th>
                    <th>Nama Peserta</th>
                    <th>IPK</th>
                    <th>Berkas Peserta</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Status Verifikasi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
            </div>
        </div>
      </div>  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->