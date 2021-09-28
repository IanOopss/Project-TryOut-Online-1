<?php 
  $n_soal = $nama_soal['nama_soal'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $title." ".$n_soal; ?>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Pertanyaan Soal <?= $n_soal; ?></h3>
          </div>
          <!-- /.box-header -->
          <?= form_open('Admin/PertanyaanSoal/edit_proses/'.$tampil_edit['id_soal'].'/'.$tampil_edit['id_pertanyaan']); ?>
            <?= csrf_field() ;?>
              <div class="box-body">
                <div class="form-group">
                  <label>Pertanyaan</label>
                  <textarea id="editor1" name="pertanyaan" rows="10" cols="80" required><?= $tampil_edit['pertanyaan'] ?></textarea>
                </div>
                <div class="form-group">
                  <label>Pilihan A</label>
                  <input type="text" name="option_1" value="<?= $tampil_edit['option_1']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Pilihan B</label>
                  <input type="text" name="option_2" value="<?= $tampil_edit['option_2']; ?>" class="form-control" required>
                </div><div class="form-group">
                  <label>Pilihan C</label>
                  <input type="text" name="option_3" value="<?= $tampil_edit['option_3']; ?>" class="form-control" required>
                </div><div class="form-group">
                  <label>Pilihan D</label>
                  <input type="text" name="option_4" value="<?= $tampil_edit['option_4']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Pilihan E</label>
                  <input type="text" name="option_5" value="<?= $tampil_edit['option_5']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Jawaban Pertanyaan</label>
                  <select class="form-control select2" name="jawaban" style="width: 100%;" required>
                    <option value="A" <?= ($tampil_edit['jawaban']=="A") ? "selected" : '' ?> >Pilihan A</option>
                    <option value="B" <?= ($tampil_edit['jawaban']=="B") ? "selected" : '' ?> >Pilihan B</option>
                    <option value="C" <?= ($tampil_edit['jawaban']=="C") ? "selected" : '' ?> >Pilihan C</option>
                    <option value="D" <?= ($tampil_edit['jawaban']=="D") ? "selected" : '' ?> >Pilihan D</option>
                    <option value="E" <?= ($tampil_edit['jawaban']=="E") ? "selected" : '' ?> >Pilihan E</option>
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