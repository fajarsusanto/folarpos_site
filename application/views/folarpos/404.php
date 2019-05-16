<style>
    .header{
        background: url("<?php echo site_url($apps['app']->apps_bg) ?>") no-repeat center top fixed;
        -webkit-background-size: cover;
        -moz-background-size:cover;
        background-size: cover;   
    }

    .header .overlay {
        height: 655px;
    }
</style>
<?php echo $script_captcha; // javascript recaptcha  ?>
<!-- =========================
             HEADER
        ============================== -->
        <header class="header" id="top" data-stellar-background-ratio="0.5" >
    <div class="overlay">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="container">                
                <?php echo $this->session->flashdata('sukses') ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                                <i class="icon icon_menu"></i>
                            </button>                  
                            <a href="<?php echo base_url() ?>" class="navbar-brand img-logo" title="Folarpos Salepoint">
                                <img src="<?php echo base_url("assets/folarpos.png") ?>" alt="Logo" style="height: 45px;">
                            </a> 
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url("home") ?>" title="">Home</a></li>
<!--                                <li><a href="<?php echo site_url("home") ?>" title="">Fitur</a></li>
                                <li><a href="<?php echo site_url("home") ?>" title="">Harga</a></li>
                                <li><a href="<?php echo site_url("home") ?>" title="">Testimoni</a></li>-->
                                <li><a href="<?php echo site_url("profile") ?>" title="">Profil</a></li>
                                <li><a href="<?php echo base_url("blog") ?>" title="">Blog & Tips</a></li>
                                <li>
                                    <a class="btn btn-nav sign-up-header" style="float:left" data-toggle="modal" href="javascript:void(0)" onclick="openLoginModal();">Login</a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="modal fade login" id="loginModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="icon icon_close_alt2"></i>
                        </button>
                        <h4 class="modal-title">Masuk ke <span>Folarpos</span></h4>
                        <p class="modal-subtitle">Masukkan Email dan Password Anda</p>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                            <div class="content">
                                <div class="loginBox">
                                    <form role="form" action="<?php echo base_url(); ?>auth/login" method="post">
                                        <?php echo $this->session->flashdata('login') ?>
                                        <input id="lm-email" class="form-control input-lg" type="text" placeholder="Email" name="email" required>
                                        <input id="lm-password" class="form-control input-lg" type="password" placeholder="Password" name="password" required>
                                        <?php echo $captcha // tampilkan recaptcha ?>
                                        <button class="btn btn-color">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
<!--                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                                <form role="form" action="<?php echo base_url(); ?>auth/register" method="post">
                                    <input id="sm-emaill" class="form-control input-lg" type="text" placeholder="Fullname" name="fullname" required>
                                    <input id="sm-email" class="form-control input-lg" type="text" placeholder="Email" name="email" required>
                                    <input id="sm-password" class="form-control input-lg" type="password" placeholder="Password" name="password">
                                    <input id="sm-confirm" class="form-control input-lg" type="password" placeholder="Repeat Password" name="password2">
                                    <button class="btn btn-color">Create Account</button>
                                </form>
                            </div>
                        </div>-->
                        <div class="box">
                            <div class="content forgotBox" style="display:none;">
                                <form role="form" action="<?php echo base_url(); ?>auth/forgot" method="post">
                                    <input id="sm-email" class="form-control input-lg" type="text" placeholder="Email" name="email" required>
                                    <?php echo $captcha // tampilkan recaptcha ?>
                                    <button class="btn btn-color">Kirim Password Baru</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Lupa Password? 
                                <a href="javascript: showForgotForm();">Lupa.</a>
                            </span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                            <span>Already have an account?</span>
                            <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container vmiddle">
            <div class="row">
                <div class="col-md-4">
                    <div class="hero-section" style="margin-top: 120px">
                        <h3 class="text-white" style="line-height: 39px;"><b>404 OOPS! </b></h3>
                        <p class="text-white" style="letter-spacing: 1px; font-size: 16px; padding-right: 10px">Halaman yang dituju tidak tersedia !!!</p>
                        <div class="btn-box">
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                <a href="<?php echo site_url("home") ?>" class="btn btn-color col-md-12 col-lg-12 col-sm-12 col-xs-12"><b>Kembali ke Utama</b></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 hidden-sm hidden-xs" style="">
                    <img src="<?php echo base_url("assets/pict-products/folarpos_instan1.png") ?>" style="width: 100%; margin-top: 40px"/>
                </div>
            </div>
        </div>
    </div>
</header>