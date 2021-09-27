<!-- Navbar Area -->
<div class="academy-main-menu">
    <div class="classy-nav-container breakpoint-off">
        <div class="container">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="academyNav">

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="<?= base_url('/'); ?>">Home</a></li>
                            
                            <li><a href="#">Pengumuman</a>
                                <div class="megamenu">
                                    <div class="single-mega cn-col-4">
                                    </div>
                                    <ul class="single-mega cn-col-4">
                                        <li><a href="<?= base_url('home/alur_pendaftaran'); ?>">Alur Pendaftaran</a></li>
                                        <li><a href="<?= base_url('home/formasi_asisten'); ?>">Formasi Asisten</a></li>
                                        <li><a href="<?= base_url('home/passing_grade'); ?>">Passing Grade</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="<?= base_url(); ?>/assets/academy/img/core-img/logos.png" alt="">
                                    </div>
                                </div>
                            </li>
                            <li><a href="<?= base_url('home/about_us'); ?>">About Us</a></li>
                            <li><a href="<?= base_url('register'); ?>">Registrasi</a></li>
                            <li><a href="<?= base_url('login'); ?>">Login</a></li>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>

                <!-- Calling Info -->
                <div class="calling-info">
                    <div class="call-center">
                        <a href="tel:0214450668"><i class="icon-telephone-2"></i> <span>(021) 4450668, 4450669</span></a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>