<div class="modal fade" id="myModalEdit<?= $id_soal; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Form Edit Jenis Soal</h4>
      </div>
     <?= form_open('Admin/JenisSoal/editSoal/'.$id_soal); ?>
        <div class="box-body">
          <div class="form-group">
            <label>Nama Soal</label>
            <input type="text" name="nama_soal" value="<?= $jso['nama_soal'] ?>" class="form-control" placeholder="Nama Soal" required>
          </div>
          <div class="form-group">
            <label>Kategori Peminatan</label>
            <select class="form-control select2" name="peminatan" style="width: 100%;" required>
              <option selected disabled>--- Pilih ---</option>
              <?php 
                foreach ($tbl_peminatan as $p) {
              ?>
                <option value="<?= $p['id_peminatan'] ;?>"
                  <?php  
                      if($p['id_peminatan'] == $jso['id_peminatan']){
                        echo 'selected';
                      }
                  ?>
                >
                  <?= $p['nama_peminatan'] ;?>
                </option>
              <?php
                }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Soal</label>
            <input type="text" name="jumlah_soal" value="<?= $jso['jumlah_soal'] ?>" class="form-control" data-inputmask='"mask": "99"' data-mask required>
          </div>
          <div class="form-group">
            <label>Jumlah Soal Minimal Benar</label>
            <input type="text" name="minimal_benar" value="<?= $jso['minimal_benar'] ?>" class="form-control" data-inputmask='"mask": "99"' data-mask required>
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