<div class="modal fade" id="myModalEdit<?= $id; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Edit Data Laboratorium</h4>
      </div>
      <?= form_open_multipart('Admin/FormasiLab/editLab/'.$id); ?>
      <?= csrf_field() ;?>
        <div class="box-body">
          <div class="form-group">
            <label>Nama Peminatan</label>
            <input type="text" name="nama_lab" value="<?= $key['nama_peminatan'] ?>" class="form-control" placeholder="Nama Laboratorium" required>
          </div>
          <div class="form-group">
            <label>Lampiran</label>
            <input type="file" name="lampiran">
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