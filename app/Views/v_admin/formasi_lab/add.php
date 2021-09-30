<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Input Data Laboratorium</h4>
      </div>
      <?= form_open_multipart('Admin/FormasiLab/inputLab'); ?>
      <?= csrf_field() ;?>
        <div class="box-body">
          <div class="form-group">
            <label>Nama Peminatan</label>
            <input type="text" name="nama_lab" class="form-control" placeholder="Nama Laboratorium" required autofocus>
          </div>
          <div class="form-group">
            <label>Lampiran</label>
            <input type="file" name="lampiran" required>
            <p class="help-block">.pdf max 2 Mb</p>
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