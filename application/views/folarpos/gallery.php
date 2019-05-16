
<style>
    @import url(https://fonts.googleapis.com/css?family=Quicksand:400,300);
    body{
        font-family: 'Quicksand', sans-serif;
    }
    .gal-container{
        padding: 12px;
    }
    .gal-item{
        overflow: hidden;
        padding: 3px;
    }
    .gal-item .box{
        height: 250px;
        overflow: hidden;
    }
    .box img{
        height: 100%;
        width: 100%;
        object-fit:cover;
        -o-object-fit:cover;
    }
    .gal-item a:focus{
        outline: none;
    }
    .gal-item a:after{
        content:"\e003";
        opacity: 0;
        background-color: rgba(0, 0, 0, 0.75);
        position: absolute;
        right: 3px;
        left: 3px;
        top: 3px;
        bottom: 3px;
        text-align: center;
        line-height: 350px;
        font-size: 30px;
        color: #fff;
        -webkit-transition: all 0.5s ease-in-out 0s;
        -moz-transition: all 0.5s ease-in-out 0s;
        transition: all 0.5s ease-in-out 0s;
    }
    .gal-item a:hover:after{
        opacity: 1;
    }
    .modal-open .gal-container .modal{
        background-color: rgba(0,0,0,0.4);
    }
    .modal-open .gal-item .modal-body{
        padding: 0px;
    }
    .modal-open .gal-item button.close{
        position: absolute;
        width: 25px;
        height: 25px;
        background-color: #000;
        opacity: 1;
        color: #fff;
        z-index: 999;
        right: -12px;
        top: -12px;
        border-radius: 50%;
        font-size: 15px;
        border: 2px solid #fff;
        line-height: 25px;
        -webkit-box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
        box-shadow: 0 0 1px 1px rgba(0,0,0,0.35);
    }
    .modal-open .gal-item button.close:focus{
        outline: none;
    }
    .modal-open .gal-item button.close span{
        position: relative;
        top: -3px;
        font-weight: lighter;
        text-shadow:none;
    }
    .gal-container .modal-dialogue{
        width: 80%;
    }
    .gal-container .description{
        position: relative;
        height: 40px;
        top: -40px;
        padding: 10px 25px;
        background-color: rgba(0,0,0,0.5);
        color: #fff;
        text-align: left;
    }
    .gal-container .description h4{
        margin:0px;
        font-size: 15px;
        font-weight: 300;
        line-height: 20px;
    }
    .gal-container .modal.fade .modal-dialog {
        -webkit-transform: scale(0.1);
        -moz-transform: scale(0.1);
        -ms-transform: scale(0.1);
        transform: scale(0.1);
        top: 100px;
        opacity: 0;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .gal-container .modal.fade.in .modal-dialog {
        -webkit-transform: scale(1);
        -moz-transform: scale(1);
        -ms-transform: scale(1);
        transform: scale(1);
        -webkit-transform: translate3d(0, -100px, 0);
        transform: translate3d(0, -100px, 0);
        opacity: 1;
    }
    @media (min-width: 768px) {
        .gal-container .modal-dialog {
            width: 55%;
            margin: 50 auto;
        }
    }
    @media (max-width: 768px) {
        .gal-container .modal-content{
            height:250px;
        }
    }
    /* Footer Style */
    i.red{
        color:#BC0213;
    }
    .gal-container{
        padding-top :75px;
        padding-bottom:75px;
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
                        <div class="btn-box">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
        </div>
    </div>
</header>           
<section style="padding-top:20px">
    <div class="container gal-container">
        <div class="col-md-12">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 5px; color:#B22222">Galeri</h2>
                    <p class="large" style="text-transform: capitalize; margin-bottom: 40px"><i>Pelajari lebih lanjut tentang penjualan, dapatkan peningkatan penjualan Anda</i></p>
                </div>
        <?php foreach ($gal as $k => $val) { ?>
            <?php foreach ($gal_dt[$k] as $kk => $vall) { ?>
                <div class="col-md-3 col-sm-4 co-xs-12 gal-item">
                    <div class="box">
                        <a href="#" data-toggle="modal" data-target="#<?php echo $k, $kk ?>">
                            <img src="<?php echo base_url($vall->gal_dt_photo) ?>">
                        </a>
                        <div class="modal fade" id="<?php echo $k, $kk ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <div class="modal-body">
                                        <img src="<?php echo base_url($vall->gal_dt_photo) ?>">
                                    </div>
                                    <div class="col-md-12 description">
                                        <h4 style="color:white"><?php echo $val->gal_title ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</section>
