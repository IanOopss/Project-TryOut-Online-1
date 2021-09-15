<?php 
foreach ($nama_soal as $nama) {
  $id = $nama->id_soal;
  $n_soal = $nama->nama_soal; 
  $jml_soal = $nama->jumlah_soal;
}


 ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title." ".$n_soal; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-body">
              <?php if ($data_pertanyaan >= 0 && $data_pertanyaan < $jml_soal): ?>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Add</button>
              
              <?php else: ?>
                <div class="callout callout-info">
                  <h4>Penginputan <?php echo $title." ".$n_soal; ?> Sudah Selesai</h4>

                  <p>Jumlah <?php echo $title." ".$n_soal." = ".$data_pertanyaan; ?>.</p>
                </div>
              <?php endif; ?>

            </div>
            
            <div class="box-footer">
              <?php $this->load->view('layouts/notifikasi'); ?>
            </div>
          </div>

          <?php include 'add.php';  ?>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tabel Pertanyaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Pertanyaan</th>
                    <th>Pilihan A</th>
                    <th>Pilihan B</th>
                    <th>Pilihan C</th>
                    <th>Pilihan D</th>
                    <th>Pilihan E</th>
                    <th>Jawaban</th>
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