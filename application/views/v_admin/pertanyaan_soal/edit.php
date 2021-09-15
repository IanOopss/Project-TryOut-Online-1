<?php 
foreach ($nama_soal as $nama) {
  $n_soal = $nama->nama_soal; 
}

foreach ($tampil_edit as $tam) {
  # code...
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
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Pertanyaan Soal <?php echo $n_soal; ?></h3>
          </div>
          <!-- /.box-header -->
          <?php echo form_open('pertanyaan_soal/edit_proses/'.$tam->id_soal.'/'.$tam->id_pertanyaan); ?>
              <div class="box-body">
                <div class="form-group">
                  <label>Pertanyaan</label>
                  <textarea id="editor1" name="pertanyaan" rows="10" cols="80" required><?php echo $tam->pertanyaan; ?></textarea>
                </div>
                <div class="form-group">
                  <label>Pilihan A</label>
                  <input type="text" name="option_1" value="<?php echo $tam->option_1; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Pilihan B</label>
                  <input type="text" name="option_2" value="<?php echo $tam->option_2; ?>" class="form-control" required>
                </div><div class="form-group">
                  <label>Pilihan C</label>
                  <input type="text" name="option_3" value="<?php echo $tam->option_3; ?>" class="form-control" required>
                </div><div class="form-group">
                  <label>Pilihan D</label>
                  <input type="text" name="option_4" value="<?php echo $tam->option_4; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Pilihan E</label>
                  <input type="text" name="option_5" value="<?php echo $tam->option_5; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Jawaban Pertanyaan</label>
                  <select class="form-control select2" name="jawaban" style="width: 100%;" required>
                    <option value="A" <?php if ($tam->jawaban=="A") {echo "selected";} ?> >Pilihan A</option>
                    <option value="B" <?php if ($tam->jawaban=="B") {echo "selected";} ?> >Pilihan B</option>
                    <option value="C" <?php if ($tam->jawaban=="C") {echo "selected";} ?> >Pilihan C</option>
                    <option value="D" <?php if ($tam->jawaban=="D") {echo "selected";} ?> >Pilihan D</option>
                    <option value="E" <?php if ($tam->jawaban=="E") {echo "selected";} ?> >Pilihan E</option>
                  </select>
                </div>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary pull-left">Submit</button>
              <button type="button" class="btn btn-danger" onclick="window.history.back();">Cancel</button>
            </div>
          </form>

      </div>
    </div>  
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->