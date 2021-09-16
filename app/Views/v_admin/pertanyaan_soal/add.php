<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Input Pertanyaan Soal <?php echo $n_soal; ?> </h4>
      </div>
      <?php echo form_open('pertanyaan_soal/input/'.$id); ?>
        <div class="box-body">
          <div class="form-group">
            <label>Pertanyaan</label>
            <textarea id="editor1" name="pertanyaan" rows="10" cols="80" required></textarea>
          </div>
          <div class="form-group">
            <label>Pilihan A</label>
            <input type="text" name="option_1" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Pilihan B</label>
            <input type="text" name="option_2" class="form-control" required>
          </div><div class="form-group">
            <label>Pilihan C</label>
            <input type="text" name="option_3" class="form-control" required>
          </div><div class="form-group">
            <label>Pilihan D</label>
            <input type="text" name="option_4" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Pilihan E</label>
            <input type="text" name="option_5" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Jawaban Pertanyaan</label>
            <select class="form-control select2" name="jawaban" style="width: 100%;" required>
              <option selected="selected" value="">--- Pilih ---</option>
              <option value="A">Pilihan A</option>
              <option value="B">Pilihan B</option>
              <option value="C">Pilihan C</option>
              <option value="D">Pilihan D</option>
              <option value="E">Pilihan E</option>
            </select>
          </div>
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary pull-left">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>