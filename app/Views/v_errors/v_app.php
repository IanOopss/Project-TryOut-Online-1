<?= $this->include('layouts/head'); ?>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <br>
        <img src="<?= base_url(); ?>/assets/academy/img/core-img/logo.png" alt="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        
        <!-- Main content -->
	    <section class="content">

	      <div class="error-page">
	        <h2 class="headline text-red">500</h2>

	        <div class="error-content">
	          <h3><i class="fa fa-warning text-red"></i> <?= $title; ?></h3>

	          <form class="search-form">
	            <div class="input-group">

	              <div class="input-group-btn">
	                <button type="submit" class="btn btn-danger btn-flat" onclick="window.history.back();"><i class="fa fa-close"></i> Go Back!
	                </button>
	              </div>
	            </div>
	            <!-- /.input-group -->
	          </form>
	        </div>
	      </div>
	      <!-- /.error-page -->

	    </section>
	    <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
  </div>

<?= $this->include('layouts/foot'); ?>
