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
                                    <!--                                    <a class="btn btn-nav btn-color sign-in-header" style="float:left" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Sign Up</a>-->
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
                        <h4 class="modal-title">Sign in to <span>Folarpos</span></h4>
                        <p class="modal-subtitle">Enter your email and password</p>
                        <div class="modal-body">  
                            <div class="box">
                                <div class="content">
                                    <div class="loginBox">
                                        <form role="form" action="<?php echo base_url(); ?>auth/login" method="post">
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
                                                                 Success/Alert Notification 
                                                                <p class="sm-success"><i class="icon icon_check_alt2"></i> <strong>Congratulation! Signup modal validation is working. Implement your code.</strong></p>
                                                                <p class="sm-failed"><i class="icon icon_close_alt2"></i><strong> Something went wrong! Insert correct value.</strong></p>
                                                                 Input Fields 
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
                                        <button class="btn btn-color">Send New Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="forgot login-footer">
                                <span>Forgot Password? 
                                    <a href="javascript: showForgotForm();">Forgot.</a>
                                </span><br>
    <!--                            <span>Don't have an account? 
                                    <a href="javascript: showRegisterForm();">Sign up.</a>
                                </span>-->
                            </div>
                            <!-- Signup-Footer. Redirect to Login-Modal -->
                            <div class="forgot register-footer" style="display:none">
                                <span>Already have an account?</span>
                                <a href="javascript: showLoginForm();">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================
                 Hero-Section
            ========================================== -->
            <div class="container vmiddle">
                <div class="row">
                    <div class="col-md-8">
                        <div class="hero-section">
                            <h1 class="text-white" style="line-height: 59px;"></h1>
                            <p class="text-white" style="letter-spacing: 1.5px; font-size: 16px"><i> </i></p>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
</header>            
    <div class="container">
        <div class="wrapper-xs">
            <div class="row">
                <?php echo $this->session->flashdata('sukses_receive') ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 20px">Pusat Layanan</h2> 
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">                   
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.6110708570177!2d110.39367351428277!3d-7.724810194431954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a577c8e7b7071%3A0x3db8b266217fa4dd!2sCV.+Folarium+Technomedia!5e0!3m2!1sid!2sid!4v1519663337344" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-top:13px">
                    <div class="box">
                        <form role="form" action="<?php echo base_url(); ?>home/receive_message" method="post">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="msg_author" class="form-control" placeholder="Nama" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" class="form-control" placeholder="Subject" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="email" name="msg_mail" class="form-control" placeholder="Email" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="msg_content" rows="7" placeholder="Pesan yang akan dikirimkan" required=""></textarea>
                                    </div>                    
                                    <?php echo $captcha // tampilkan recaptcha ?>
                                    <button class="btn btn-color col-md-12">Kirim Kami Pesan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
