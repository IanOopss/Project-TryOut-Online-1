 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-body">
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Add</button>
            </div>
          </div>

          <?php include 'add.php';  ?>
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tabel Jenis Soal</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Soal</th>
                    <th>Peminatan</th>
                    <th>Jumlah Soal</th>
                    <th>Jumlah Minimal Benar</th>
                    <th>Total Nilai</th>
                    <th>Passing grade</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no = 1;
                      foreach ($kategori_soal as $jso) {
                        $id_soal = $jso['id_soal'];
                     ?>
                  <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $jso['nama_soal']; ?></td>
                    <td><?= $jso['nama_peminatan']; ?></td>
                    <td><?= $jso['jumlah_soal']; ?></td>
                    <td><?= $jso['minimal_benar']; ?></td>
                    <td><?= $jso['total_nilai']; ?></td>
                    <td><?= $jso['passing_grade']; ?></td>
                    </td>
                    <td>

                      <a data-toggle="tooltip" data-placement="top" title="Edit">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalEdit<?= $id_soal; ?>"><i class="fa fa-edit"></i></button>
                      </a>
                      
                      <a href="<?= base_url('Admin/JenisSoal/deleteSoal/'.$id_soal); ?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Hapus <?= $jso['nama_soal']; ?> ?')">
                        <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                      </a>

                    </td>
                  </tr>
                  <?php 
                    $no++;
                    include 'edit.php'; 
                    }
                   ?>
                  </tbody>
                </table>
            </div>
        </div>
      </div>  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->