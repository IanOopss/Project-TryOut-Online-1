<?php 

$id_admin = session()->get('id_admin');

 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Settings Password</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open('admin/edit_password/'.$id_admin, 'class="form-horizontal"'); ?>
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" placeholder="Password" readonly>
                  </div>
                  <div class="col-md-2 ">
                    <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Tampilkan
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>

                  <div class="col-sm-8">
                    <input type="password" maxlength="15" minlength="8"  class="form-control" id="new_password" name="new_password" placeholder="New Password">
                  </div>
                  <div class="col-md-2 ">
                    <input type="checkbox" onchange="document.getElementById('new_password').type = this.checked ? 'text' : 'password'"> Tampilkan
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Comfirm New Password</label>

                  <div class="col-sm-8">
                    <input type="password" maxlength="15" minlength="8"  class="form-control" id="comfirm_password" name="comfirm_password" placeholder="Comfirm New Password">
                  </div>
                  <div class="col-md-2 ">
                    <input type="checkbox" onchange="document.getElementById('comfirm_password').type = this.checked ? 'text' : 'password'"> Tampilkan
                  </div>
                </div>
              
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                 <button type="button" class="btn btn-danger pull-right" onclick="window.history.back();">Cancel</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
