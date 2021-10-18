<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Input Data Laboratorium</h4>
      </div>
      <?= form_open_multipart('Admin/Peminatan/inputPeminatan'); ?>
      <?= csrf_field() ;?>
        <div class="box-body">
          <div class="form-group">
            <label>Peminatan</label>
            <input type="text" name="nama_peminatan" class="form-control" placeholder="Peminatan" required autofocus>
          </div>
          <div class="form-group">
            <label>Waktu Pengerjaan</label>
            <input type="text" name="waktu_pengerjaan" class="form-control" placeholder="Waktu Pengerjaan" required>
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