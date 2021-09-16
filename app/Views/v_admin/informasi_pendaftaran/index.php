
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <?php $this->load->view('layouts/notifikasi'); ?>
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tabel Informasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Kegiatan</th>
                    <th>Pendaftaran</th>
                    <th>Tutup</th>
                    <th>Lulus Administrasi</th>
                    <th>Ujian CAT</th>
                    <th>Waktu Pengejaan</th>
                    <th>Alur Pendaftaran</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $no = 1;
                      foreach ($informasi as $key) {
                        $id_informasi = $key->id_informasi;
                     ?>
                  <tr>
                    <td><?php echo $no; ?>.</td>
                    <td><?php echo $key->nama_kegiatan; ?></td>
                    <td><?php echo tgl_indonesia($key->tgl_pendaftaran); ?></td>
                    <td><?php echo tgl_indonesia($key->tgl_tutup); ?></td>
                    <td><?php echo tgl_indonesia($key->tgl_lulus_adm); ?></td>
                    <td><?php echo tgl_indonesia($key->tgl_ujian_cat); ?></td>
                    <td><?php echo $key->waktu_pengerjaan; ?></td>
                    <td>
                      <?php 
                        if ($key->alur_pendaftaran == "") {
                          echo "Belum Diinput";
                        }else{
                          echo "<a href='".base_url('formasi_lab/download/'.$key->alur_pendaftaran)."'>
                                  <p align='center'><i class='fa fa-file'></i></p>
                                </a>";
                        }
                      ?>
                    </td>
                    <td>

                      <a data-toggle="tooltip" data-placement="top" title="Edit">
                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $id_informasi; ?>"><i class="fa fa-edit"></i></button>
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