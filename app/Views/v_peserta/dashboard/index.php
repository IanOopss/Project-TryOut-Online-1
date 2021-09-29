<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?= $key['nama_kegiatan']?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4>Selamat Anda Lulus Admistrasi!</h4>
        <h4><?= $data_lab['nama_lab'] ;?></h4>

        <p>Silakan Cetak Kartu Ujian Untuk Mengikuti Ujian Berbasis CAT</p>
      </div> 

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive " src="<?= base_url('assets/academy/img/uploads/berkas_peserta/'.$peserta['foto']); ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $peserta['nama_peserta'] ?></h3>

              <p class="text-muted text-center"><?= $peserta['nim'] ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>IPK</b> <a class="pull-right"><?= $peserta['ipk'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right"><?= $peserta['email'] ?></a>
                </li>
                <li class="list-group-item">
                  <b>Formasi Lab</b> <a class="pull-right"><?= $data_lab['nama_lab'] ?></a>
                </li>
              </ul>

              <a href="<?= base_url('peserta/cetak_kartu') ?>" class="btn btn-primary btn-block"><b>Cetak Kartu Ujian</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        
          <?php 
          //Pengecekan Tanggal Ujian 
          // Apabila Tanggal Sekarang kecil dari tanggal ujian
          if ($tgl_sekarang < $tgl_ujian_cat) {
            echo "
                  <div class='col-md-8'>
                    <div class='callout callout-success'>
                      <h4>Ujian Berbasis CAT !</h4>
                      <p>Dilaksanakan pada tanggal ".tgl_indonesia($tgl_ujian_cat)."</p>
                    </div>
                  </div>
                ";
          }
          // Apabila Tanggal Sekarang == tanggal ujian
          elseif ($tgl_sekarang == $tgl_ujian_cat) {
            // Cek Tabel Id Peserta Pada Tabel Jawaban
            if ($jawaban <= 0) {
            echo "
                  <div class='col-md-8'>
                    <div class='callout callout-success'>
                      <h4>Klik Tombol Dibawah Untuk Memulai Ujian Berbasis CAT !</h4>
                    </div>
                    <a href='".base_url('peserta/acak_soal')."' class='btn btn-primary'><b>Mulai Ujian</b></a>
                  </div>
                ";
            
            }else{
              if ($data_jawaban['status_jawaban'] == "Belum") {
                echo "
                  <div class='col-md-8'>
                    <div class='callout callout-success'>
                      <h4>Klik Tombol Dibawah Untuk Memulai Ujian Berbasis CAT !</h4>
                    </div>
                    <a href='".base_url('peserta/acak_soal')."' class='btn btn-primary'><b>Mulai Ujian</b></a>
                  </div>
                ";
              }
              else{
                //Nilai Ujian CAT Peserta
                echo "
                  <div class='col-md-8'>
                    <div class='callout callout-success'>
                      <h4>Hasil Ujian Berbasis CAT</h4>
                    </div>

                    <!-- Profile Image -->
                    <div class='box box-success'>
                      <div class='box-body box-profile'>

                        <ul class='list-group list-group-unbordered'>
                ";
                foreach ($data_nilai as $nilai) {
                  echo "
                      <li class='list-group-item'>
                        <b>".$nilai['nama_soal']."</b> <a class='pull-right'>".$nilai['nilai_peserta']."</a>
                      </li>
                  ";
                }
                echo "
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                ";
              }
            }
          }
          //Melewati Tanggal Ujian
          else{
            // Cek Tabel Id Peserta Pada Tabel Jawaban
            if ($jawaban <= 0) {
            echo "
              <div class='col-md-8'>
                <div class='callout callout-warning'>
                  <h4>Anda Tidak Mengikuti Ujian !</h4>
                </div>
              </div>
            ";
            
            }else{
              dd($title);
              //Nilai Ujian CAT Peserta
              echo "
                  <div class='col-md-8'>
                    <div class='callout callout-success'>
                      <h4>Hasil Ujian Berbasis CAT</h4>
                    </div>

                    <!-- Profile Image -->
                    <div class='box box-success'>
                      <div class='box-body box-profile'>

                        <ul class='list-group list-group-unbordered'>
                ";
                dd($data_nilai);
                foreach ($data_nilai as $nilai) {
                  echo "
                      <li class='list-group-item'>
                        <b>".$nilai['nama_soal']."</b> <a class='pull-right'>".$nilai['nilai_peserta']."</a>
                      </li>
                  ";
                }
                echo "
                        </ul>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                ";
            }

          }
          
            ?>
          
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.container -->
</div>