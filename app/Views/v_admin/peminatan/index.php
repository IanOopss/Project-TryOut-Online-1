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
              <h3 class="box-title">Tabel <?= $title; ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Peminatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Waktu Pengerjaan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      foreach ($peminatan as $key) {
                        $id = $key['id_peminatan'];
                        ?>
                  <tr>
                    <td><?= $no; ?>.</td>
                    <td><?= $key['nama_peminatan']; ?></td>
                    <td><?= $key['jumlah_peserta']; ?></td>
                    <td><?= $key['waktu_pengerjaan'] ;?></td>
                    <td>

                      <a data-toggle="tooltip" data-placement="top" title="Edit">
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalEdit<?= $id; ?>"><i class="fa fa-edit"></i></button>
                      </a>
                      
                      <a href="<?= base_url('Admin/Peminatan/deletePeminatan/'.$id); ?>" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Hapus Formasi <?= $key['nama_peminatan']; ?> ?')">
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