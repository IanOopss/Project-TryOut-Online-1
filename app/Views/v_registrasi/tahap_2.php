<?php 
foreach ($data_peserta as $key) {
  $id_peserta = $key->id_peserta;
  $nim = $key->nim;
}
 ?>
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <br>
        <img src="<?php echo base_url(); ?>assets/academy/img/core-img/logo.png" alt="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $title; ?></h1>
        </section>
        
        <!-- Main content -->
        <section class="content">
          <div class="callout callout-info">
            <h4><?php echo $judul; ?></h4>

            <p>Data Biodata diisi dengan benar dan teliti!</p>
          </div>
          <div class="callout callout-danger">
            <h4>Ukuran Foto 3X4 Cm format .jpg Maxs 500Kb</h4>
          </div>
          <div class="callout callout-success">
            <h4>Akun Berhasil Dibuat</h4>
            <p>Dengan NIM <?php echo $nim; ?> </p>
          </div>

          <?php $this->load->view('layouts/notifikasi'); ?>

          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Form <?php echo $judul; ?></h3>
            </div>
            
            <?php echo form_open_multipart('registrasi/verifikasi_tahap2/'.$id_peserta.'/'.$nim); ?>
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Mahasiswa</label>
                      <input type="text" name="nama_peserta" class="form-control" placeholder="Nama Mahasiswa" required>
                    </div>
                    <div class="form-group">
                      <label>IPK</label>
                      <input type="text" name="ipk" class="form-control" data-inputmask='"mask": "9.99"' data-mask required>
                    </div>
                    <div class="form-group">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tmp_lahir" class="form-control" placeholder="Tempat Lahir"  required>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="text" name="tgl_lahir" class="form-control" id="datepicker" placeholder="Tanggal Lahir"  required>
                    </div>
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" id="optionsRadios1" value="Laki-laki" checked>
                          Laki-laki
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" id="optionsRadios2" value="Perempuan">
                          Perempuan
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No Hp</label>
                      <input type="text" name="no_hp" class="form-control" placeholder="No Hp" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" name="email" class="form-control" placeholder="Email"  required>
                    </div>
                    <div class="form-group">
                      <label>Agama</label>
                      <select class="form-control select2" name="agama" style="width: 100%;" required>
                        <option selected="selected" value="">--- Pilih ---</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Konghucu">Konghucu</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" id="foto" name="foto" required>
                      <p>.jpg Maxs 200Kb</p>
                    </div>
                    
                  </div>
                </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left">Submit</button>
              </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
  </div>