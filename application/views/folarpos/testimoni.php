<style>
    .gal-container{
        padding: 5px;
    }
    .box{
        height: 100%;
        overflow: hidden;
        margin-bottom: 50px;  
    }
    .box img{
        height: 100%;
        width: 100%;
        object-fit:cover;
        -o-object-fit:cover;
    }
    .header{
        background: url("<?php echo site_url('assets-ds/bg-3.jpg') ?>") no-repeat center top fixed;
        -webkit-background-size: cover;
        -moz-background-size:cover;
        background-size: 100%;   
    }

    .header .overlay2 {
        height: 200px;
    }
</style>
<?php echo $script_captcha; // javascript recaptcha  ?>
<header class="header" id="top" data-stellar-background-ratio="0.5" >
    <div class="overlay2">
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
                                <img src="assets/folarpos.png" alt="Logo" style="height: 45px;">
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
                <div class="col-md-6">
                    <div class="hero-section" style="margin-top: 120px">
                    </div>
                </div>
                <div class="col-md-6">                    
                </div>
            </div>
        </div>
    </div>
</header>           
    <div class="container">
        <div class="wrapper-xs">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 5px; color:#B22222">Testimony</h2>
                    <p class="large" style="text-transform: capitalize; margin-bottom: 40px"><i>Pelajari lebih lanjut tentang penjualan, dapatkan peningkatan penjualan Anda</i></p>
                    <div class="tabs testimonials tab-container">
                        <?php
                        if (count($testimony) > 0) {
                            foreach ($testimony as $k => $val) {
                                ?>
                                <div class="col-md-8" style="padding-bottom:20px">
                                    <div class="panel-container">
                                        <div class="" id="">
                                            <blockquote>
                                                <?php echo $val->testi_desc ?>
                                                <img src="<?php echo base_url() ?><?php echo $val->testi_photo ?>" alt=" ">
                                                <p class="testimonial-name"><span><?php echo $val->testi_name ?></span></p>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding-top:14px">
                    <h4 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 5px;color:#B22222">Blog & Tips</h4>
                    <?php foreach ($tips_lates as $k => $val) { ?>
                    <div class="col-sm-12 team-box" style="padding:15px">
                            <a href="<?php echo site_url("blog/" . $val->cont_url) ?>">
                                <div class="team-img">
                                    <img src="<?php echo base_url() ?><?php echo $val->cont_header ?>" class="img-responsive" alt="">
                                </div>
                            </a>
                            <h4 style="font-size:18px"><a href="<?php echo site_url("blog/" . $val->cont_url) ?>"><?php echo $val->cont_title ?></a></h4>
<!--                            <p class="team-bio"><span class="text-color"><?php echo $val->users_fullname ?> </span><?php echo shortext($val->cont_desc, 90) ?></p>-->
                        </div>
                    <?php } ?>
                </div>
            </div>            
        </div>
    </div>
