<?= $this->extend('_layout/user/_template') ?>

<?= $this->section('content') ?>

<!-- ##### Breadcumb Area Start ##### -->
<div class="breadcumb-area">
    <img src="<?php echo base_url(); ?>assets/academy/img/bg-img/breadcumb.jpg" class="breadcumb-area bg-img">
    <div class="bradcumbContent">
        <h2>About Us</h2>
    </div>
</div>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### About Us Area Start ##### -->
<section class="about-us-area mt-50 section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center mx-auto wow fadeInUp" data-wow-delay="300ms">
                    <h3>Professional, dan Berdaya Saing Global</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                <p>ITLG (Information Technology Laboratory Group)</p>
                <p>Terakreditasi oleh BAN PT</p>
            </div>
            <div class="col-12 col-md-6 wow fadeInUp" data-wow-delay="500ms">
          
                <!-- Single Contact Info -->
                <div class="single-contact-info d-flex">
                    <div class="contact-icon mr-15">
                        <i class="icon-placeholder"></i>
                    </div>
                    <p>Jalan Alumni No. 3 Kampus USU Medan 20155, Sumatera Utara</p>
                </div>

                <!-- Single Contact Info -->
                <div class="single-contact-info d-flex">
                    <div class="contact-icon mr-15">
                        <i class="icon-telephone-1"></i>
                    </div>
                    <p>Office: +62 61 8222129</p>
                </div>

                <!-- Single Contact Info -->
                <div class="single-contact-info d-flex">
                    <div class="contact-icon mr-15">
                        <i class="icon-contract"></i>
                    </div>
                    <p>https://it.usu.ac.id</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### About Us Area End ##### -->

<?= $this->endSection() ?>
