<div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $key->nama_kegiatan; ?>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row"> 
          <div class="col-md-8">

            <div class="clock" style="margin:2em;"></div>
            <div class="message"></div>

            <div class="callout callout-info">
              <h4><?php echo $title; ?></h4>
              <h4>Formasi - <?php echo $pstr->nama_lab; ?></h4>
            </div>

            <?php 
            //List Jawaban
            foreach ($tampil_soal as $tampil_s) {
              $id_soal = $tampil_s->id_soal;
              $nama_soal = $tampil_s->nama_soal;
              $pertanyaan = $tampil_s->pertanyaan;
              $option_1 = $tampil_s->option_1;
              $option_2 = $tampil_s->option_2;
              $option_3 = $tampil_s->option_3;
              $option_4 = $tampil_s->option_4;
              $option_5 = $tampil_s->option_5;

            }

             ?>

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title"><?php echo $nama_soal;?></h3>
              </div>
              <?php echo form_open('peserta/simpan_jawaban/'.$no_soal); ?>
              <input type="hidden" name="id_soal" value="<?php echo $id_soal;?>">
                  <div class="box-body">
                    <div class="form-group">
                      <p>No. <?php echo $no_soal;?></p>
                      <?php echo $pertanyaan;?>
                        <input type="radio" name="jawaban_peserta" value="A" class="flat-red" <?php if ($jawaban_peserta == 'A') echo "checked"; ?>> A. <?php echo $option_1;?><br>
                        <input type="radio" name="jawaban_peserta" value="B" class="flat-red" <?php if ($jawaban_peserta == 'B') echo "checked"; ?>> B. <?php echo $option_2;?><br>
                        <input type="radio" name="jawaban_peserta" value="C" class="flat-red" <?php if ($jawaban_peserta == 'C') echo "checked"; ?>> C. <?php echo $option_3;?><br>
                        <input type="radio" name="jawaban_peserta" value="D" class="flat-red" <?php if ($jawaban_peserta == 'D') echo "checked"; ?>> D. <?php echo $option_4;?><br>
                        <input type="radio" name="jawaban_peserta" value="E" class="flat-red" <?php if ($jawaban_peserta == 'E') echo "checked"; ?>> E. <?php echo $option_5;?><br>
                      
                    </div>
                  </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary pull-left">Simpan dan Lanjutkan</button>
                  <?php 
                  $next = $no_soal+1;
                    echo "<a href='".base_url('peserta/ujian_cat/'. $next)."'>
                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Lewati Soal Ini</button>
                          </a>";
                  ?>
                  
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-4">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Nomor Soal</h3>
                <a href="<?php echo base_url('peserta/selesai_ujian') ?>">
                  <button type="button" class="btn btn-success pull-right"><i class="fa fa-check-circle"></i> Selesai</button>
                </a>
                
              </div>
              <div class="box-body">
                <div class="col-sm-12">
                <?php 

                // Nomor Soal
                foreach ($data_jawaban as $data_j) {
                    $list_jawaban = $data_j->list_jawaban;
                }

                $jawaban = explode(",", $list_jawaban);
                $nomor = sizeof($jawaban); 
                
                for ($i=1; $i <= $nomor ; $i++) {
                  $a = $i-1; 
                  $jwb = explode(":", $jawaban[$a]);
                  if ($no_soal == $i) {

                    echo "<div class=\"col-md-3\">";
                    echo "<a href='".base_url('peserta/ujian_cat/'.$i)."' >";
                    echo "<button type=\"button\" class=\"btn btn-block btn-primary btn-sm\">".$i.". ".$jwb[1]."</button>";
                    echo "</a>";
                    echo "</div>";
                  }
                  elseif ($jwb[2] == "N") {
                    
                    echo "<div class=\"col-md-3\">";
                    echo "<a href='".base_url('peserta/ujian_cat/'.$i)."' >";
                    echo "<button type=\"button\" class=\"btn btn-block btn-default btn-sm\">".$i." .</button>";
                    echo "</a>";
                    echo "</div>";
                  
                  }else{

                    echo "<div class=\"col-md-3\">";
                    echo "<a href='".base_url('peserta/ujian_cat/'.$i)."' >";
                    echo "<button type=\"button\" class=\"btn btn-block btn-success btn-sm\">".$i.". ".$jwb[1]."</button>";
                    echo "</a>";
                    echo "</div>";

                  }
                  
                }

                ?>
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>