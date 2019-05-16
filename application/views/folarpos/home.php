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
    /* Carousel */

.carousel-control.left,.carousel-control.right  {background:none;width:25px;}
.carousel-control.left {left:-25px;}
.carousel-control.right {right:-25px;}
.broun-block {
    background: none repeat scroll center top rgba(0, 0, 0, 0);
    padding-bottom: 34px;
}
.block-text {
    background-color: #fafafa;
    border-radius: 5px;
    color: #626262;
    font-size: 15px;
    margin-top: 27px;
    padding: 15px 18px;
    height:150px;
}
.block-text a {
 color: #7d4702;
    font-size: 25px;
    font-weight: bold;
    line-height: 21px;
    text-decoration: none;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.mark {
    padding: 12px 0;background:none;
}
.block-text p {
    color: #585858;
    line-height: 20px;
}
.sprite {
	background-image: none;
}
.sprite-i-triangle {
    background-position: 0 -1298px;
    height: 44px;
    width: 50px;
}
.block-text ins {
    bottom: -44px;
    left: 50%;
    margin-left: -60px;
}


.block {
    display: block;
}
.zmin {
    z-index: 1;
}
.ab {
    position: absolute;
}

.person-text {
    padding: 10px 0 0;
    text-align: center;
    z-index: 2;
    bottom:5px;
}
.person-text a {
    color: #ffcc00;
    display: block;
    font-size: 14px;
    margin-top: 3px;
    text-decoration: underline;
}
.person-text i {
    color: black;
    font-size: 13px;
}
.rel {
    position: relative;
}
</style>
<script>
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}
</script>
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
                                <img src="assets/folarpos.png" alt="Logo" style="height: 45px;">
                            </a> 
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#top" title="" class="scrollto">Home</a></li>
                                <li><a href="#features" title="" class="scrollto">Fitur</a></li>
                                <li><a href="#pricing" title="" class="scrollto">Harga</a></li>
                                <li><a href="#testimonials" title="" class="scrollto">Testimoni</a></li>
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
                        <h3 class="text-white" style="line-height: 39px; font-size: 20px"><b><?php echo ($apps['app']->apps_head) ?></b></h3>
                        <p class="text-white" style="letter-spacing: 1px; font-size: 16px; padding-right: 10px"><?php echo ($apps['app']->apps_caption) ?></p>
                        <div class="btn-box">
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6" style="padding-right:5px">
                                <a href="<?php echo site_url("katalog") ?>" class="btn btn-color"><b>Lihat Katalog</b></a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
                                <a href="#canvas-bg" title="" class="scrollto">
                                    <img src="<?php echo base_url("assets/gplay.png") ?>" style="width: 160px;"/>
                                </a>
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
        <!-- =========================
             /END HEADER
        ============================== -->	
        
        <!-- =================================
             SECTION ABOUT - INTRO FEATURES
        ====================================== -->
        <section class="intro-features" id="features">
            <div class="container">
                <div class="wrapper-sm">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 style="color:#B22222">Alasan Memilih FOLARPOS</h2>
                            <p class="large"></p>
                        </div>
                        <?php foreach ($warranty as $k => $val) { ?>
                            <div class="col-sm-3" style="height: 290px">
                                <div class="icon-lg">
                                    <img src="<?php echo base_url() ?><?php echo $val->war_icon ?>" style="height: 100px"/>
                                </div>
                                <h4 style="font-size: 18px"><?php echo strtoupper($val->war_name) ?></h4>
                                <p><?php echo ucfirst($val->war_caption) ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- =============================
             /END INTRO FEATURES
        ============================== -->
        
        
        <!-- ==================================================
             SECTION 2 COLS - IMAGE RIGHT AND TEXT WITH CALL TO ACTION
        ======================================================= -->
        <section class="img-with-action light-bg">
            <div class="container wrapper-sm">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <h3 style="color:#B22222">Monitor Outletmu Secara Real Time</h3>
                        <?php echo $apps['app']->apps_desc ?>
                        <br><br>
                        <img src="<?php echo base_url() ?>assets/png-icon/1.png" style="width:12%; margin-right:16px"/>
                        <img src="<?php echo base_url() ?>assets/png-icon/2.png" style="width:12%; margin-right:16px"/>
                        <img src="<?php echo base_url() ?>assets/png-icon/3.png" style="width:12%; margin-right:16px"/>
                        <img src="<?php echo base_url() ?>assets/png-icon/4.png" style="width:12%; margin-right:16px"/>
                        <img src="<?php echo base_url() ?>assets/png-icon/5.png" style="width:12%; margin-right:16px"/>
                        <img src="<?php echo base_url() ?>assets/png-icon/6.png" style="width:12%; margin-right:16px"/>
                        <div class="btn-box">
                            <a href="<?php echo site_url("katalog") ?>" class="btn btn-grey">Selengkapnya</a>
                            <a href="#canvas-bg" class="btn btn-color scrollto"><i class="icon arrow_carrot-2dwnn_alt"></i>Download Gratis</a>
                        </div>
                        <div class="start-charts"></div>
                    </div>
                </div>
            </div>
            <div class="hidden-sm hidden-xs col-md-6 img-col-bg img-right"></div>
        </section>
        <!-- =============================
             /END SECTION 
        ============================== -->
        
        <!-- ==================================================
            SIGNUP DIVIDER
        ======================================================= -->
        <section id="canvas-bg" class="dark-bg signup-divider">
            <div class="container">
                <div class="wrapper-sm">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-white">Mulai dengan gratis, Tanpa Resiko, Coba 30 hari!</h2>
                            <p class="large text-white">Silahkan lengkapi dahulu untuk mendownload Aplikasi.</p>
                            <p class="signup-handwritten text-white">Mengapa Menunggu ?  <br> Mulai Sekarang!</p>
                        </div>
                    </div>

                    <div class="row">
                        <form role="form" action="<?php echo base_url(); ?>download_aplikasi" method="post">
                            <div class="form-group">
                                <input type="text" name="company" id="signup-email" class="form-control input-xs" placeholder="Nama Usahamu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" id="signup-email" class="form-control input-xs" placeholder="Nama Lengkapmu" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" maxlength="15" onkeypress="return hanyaAngka(event)" id="signup-email" class="form-control input-xs" placeholder="No. Handphone" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="mail" id="signup-email" class="form-control input-xs" placeholder="Emailmu..." required>
                            </div>
                            <button class="btn btn-color">Download Aplikasi <i class="icon arrow_right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- =============================
             /END SIGNUP SECTION 
        ============================== -->
        

        <!-- =============================
             PRICING SECTION
        ============================== -->
        <section class="pricing" id="pricing">
            <div class="container">
                <div class="wrapper-sm">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 5px; color:#B22222">Harga Folarpos Instant</h2>
                            <p class="large">Pilih sesuai kebutuhan bisnismu. 30 hari gratis coba untuk semua versi.</p>
                        </div>
                    </div>
                    <div class="row grid-md">
                        <?php foreach ($price as $k => $val) { ?>
                            <div class="col-sm-4">
                                <div class="pricing-tab" style="min-height:400px;">
                                    <p class="price" style="font-size: 38px"><sup><small><?php echo strtoupper($val->pric_curency) ?></small></sup> <?php echo rupiah($val->pric_nominal) ?> K<span> / <?php echo strtolower($val->pric_period) ?></span></p>
                                    <h4><?php echo ucfirst($val->pric_name) ?></h4>
                                    <ul class="pricing-features">
                                        <?php
                                        $desc_price[$k] = explode(",", $val->pric_desc);
                                        foreach ($desc_price[$k] as $kk => $vall) {
                                            ?>
                                        <li style="border-bottom:1px solid lightgray; "><?php echo $desc_price[$k][$kk] ?></li>
                                        <?php } ?>
                                    </ul>
                                    <div style="position:absolute; bottom:20px; padding-left: 20px">
                                        <a href="#canvas-bg" class="btn btn-color scrollto" style="bottom: -4px;">Berlangganan</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="pricing-more">
                                    <p><strong>Mencari yang lebih ?</strong> &mdash; Beri tahu kami kebutuhan anda. Layanan kami mendukung customize sesuai rencana biaya anda dan membuat bisnis anda lebih mudah dalam menjalankannya.  <strong> <a href="<?php echo site_url("contact") ?>">Hubungi Kami <i class="icon arrow_carrot-right_alt2"></i></a></strong> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        <!-- =============================
             /END PRICING SECTION 
        ============================== -->  

        <!-- =======================================================
             TESTIMONIALS WITH PRESS/CLIENTS LOGOS
        ============================================================ -->
        <section class="testimonial-press light-bg" id="testimonials">
            <div class="container vmiddle">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 5px; color:#B22222">Testimoni</h2>
                        <p class="large" style="margin-bottom: 10px;">Manfaat apa yang telah mereka dapatkan setelah menggunakan FOLARPOS  <strong> <a href="<?php echo site_url("testimony") ?>">Selengkapnya <i class="icon arrow_carrot-right_alt2"></i></a></strong></p>
                    </div>
                </div>
                <div class="row">
                    <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php if (count($testimony_desc) > 0) {
                                        foreach ($testimony_desc as $k => $val) {
                                ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="block-text rel zmin">
                                       <?php echo $val->testi_desc?>
                                    </div>
                                    <div class="person-text rel">
                                        <img src="<?php echo base_url($val->testi_photo)?>" style="width:50px; height:50px; border-radius: 100%"/>
                                        <a title="" href="#"></a>
                                        <i><?php echo $val->testi_name?></i>
                                    </div>
                                </div>
                                <?php } }?>
                            </div> 
                            <div class="item">
                                <?php if (count($testimony_asc) > 0) {
                                        foreach ($testimony_asc as $k => $val) {
                                ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="block-text rel zmin">
                                       <?php echo $val->testi_desc?>
                                    </div>
                                    <div class="person-text rel">
                                        <img src="<?php echo base_url($val->testi_photo)?>" style="width:50px; height:50px; border-radius: 100%"/>
                                        <a title="" href="#"></a>
                                        <i><?php echo $val->testi_name?></i>
                                    </div>
                                </div>
                                <?php } }?>
                            </div>
                        </div>
                        <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                            <span class="fa fa-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                            <span class="fa fa-chevron-right"></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- =============================
             /END TESTIMONIALS
        ============================== -->
        
