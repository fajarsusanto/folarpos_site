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

    .header .overlay {
        height: 400px;
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
                                <img src="assets/folarpos.png" alt="Logo" style="height: 45px;">
                            </a> 
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url("home") ?>" title="">Home</a></li>
<!--                                <li><a href="#features" title="" class="scrollto">Fitur</a></li>
                                <li><a href="#pricing" title="" class="scrollto">Harga</a></li>
                                <li><a href="#testimonials" title="" class="scrollto">Testimoni</a></li>-->
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
                <div class="col-md-12">
                    <div class="hero-section" style="margin-top: 120px">
                        <h1 class="text-white" style="line-height: 39px;"><b>Dapatkan Fee Rp. 500.000</b></h1>
                        <p class="text-white" style="letter-spacing: 1px; font-size: 18px; padding-right: 10px">Untuk setiap klien yang anda akujan join ke Folarpos.<br><i style="font-size: 10px;">*Syarat dan ketentuan berlaku</i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>           
<section class="" id="features">
    <div class="container">
        <div class="wrapper-xs">
            <div class="row">
                <?php echo $this->session->flashdata('referral') ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 20px; color: #B22222">Dapatkan penghasilan tambahan dengan manjdai partner Referral kami</h2>
                    <p class="large" style="text-transform: capitalize; margin-bottom: 40px"><i>Cukup isi dan kirimkan formulir dibawah ini, kami akan segera menghubungi klien yang adna rekomendasikan. Jika mereka bergabung dengan Folarpos dan melakukan upgrade ke Premuim, Anda akan mendapatkan komisi sebesar Rp 500.000 ! (Syarat dan ketentuan berlaku, bisa Anda baca di bagian bawah halaman ini)</i></p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 ">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 20px; font-size: 28px;color: #B22222">Form Referral</h2>
                     <div class="box">
                        <form role="form" action="<?php echo base_url(); ?>home/receive_referral" method="post">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="ref_name" class="form-control" placeholder="Nama Anda Sesuai KTP*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="email" name="ref_mail" class="form-control" placeholder="Email Utama Anda*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="ref_hp" class="form-control" placeholder="Nomor HP Anda*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="ref_recomended" class="form-control" placeholder="Nama Orang yang Anda Rekomendasikan (Referral)*" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="ref_bisnis_referral" class="form-control" placeholder="Nama Bisnis / Usaha Referral*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="email" name="ref_mail_referral" class="form-control" placeholder="Email Referral*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input type="text" name="ref_hp_referral" class="form-control" placeholder="Nomor HP Referral*" required="">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <select name="ref_jenis_referral" class="form-control" placeholder="Jenis Bisnis Referral*">
                                            <option value="Tidak dipilih">Jenis Bisnis Referral*</option>
                                            <option value="Kafe/Restoran/Warung/Food Truck">Kafe/Restoran/Warung/Food Truck</option>
                                            <option value="Ritel (Toko Baju, Kelontong, dll.)">Ritel (Toko Baju, Kelontong, dll.)</option>
                                            <option value="Jasa (Salon, Laundry, dll.)">Jasa (Salon, Laundry, dll.)</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="ref_info" rows="8" placeholder="Informasi Tambahan (Optional)" required=""></textarea>
                                    </div>
                                    <?php echo $captcha // tampilkan recaptcha ?>
                                    <button class="btn btn-color col-md-12">Kirim Formulir</button>
                                </div>
                            </div>
                        </form>
                    </div>                          
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 ">
                    <h2 style="border-bottom: 1px solid grey; padding-bottom: 10px; margin-bottom: 20px; font-size: 28px;color: #B22222">Pertanyaan Umum (FAQ)</h2>
                    <p style="text-transform: capitalize; margin-bottom: 40px"><i><b style="color: #B22222">Bagaimana cara Folarpos Referral Program bekerja ?</b><br><br>
                        Anda punya kenalana atau saudata yang memnpunyai bisnis seperti kuliner, toko, klinik, barbershop? Gunakan formulir diatas untuk menginfokan kebutuhan mereka kepada kami. Tim Folarpos akan melakukan follow up kepada orang yang bersangkutan, dan jika mereka menjadi member Premium / berbayar, Anda akan mendapatka komisi Rp 500.000.</i></p>
                    <p style="text-transform: capitalize; margin-bottom: 40px"><b style="color: #B22222">Q : Siapa yang boleh ikut join ?</b><br><i>A : Siapapun boleh ikut program referral ini, Mahasiswa/Karyawan swasta ingin mendapat penghasilah tambahan</i><p>
                    <p style="text-transform: capitalize; margin-bottom: 40px"><b style="color: #B22222">Q : Kapan saya akan mendapatkan Transferan Fee dari Folarpos ?</b><br><i>A : Setelah referral kamu membayar, kami akan langsung transfer ke rekening kamu</i><p>
                    <p style="text-transform: capitalize; margin-bottom: 40px"><b style="color: #B22222">Q : Sebelum saya menawarkan produk Folarpos ke pemilik warung, saya ingin mendapat training tentang produk Folarpos, apa bisa ?</b><br><i>A : Bisa. Kami akan berikan training lengkap beserta tips dan trik saat jualan.</i><p>
                    <p style="text-transform: capitalize; margin-bottom: 40px">Saya tertarik untuk menjadi referral resmi Folarpos. Bagaimana caranya ?<br><i>Bagi Anda yang ingin menjadi mitra resmi Folarpos, Hubungi marketing@folarpos.co.id untuk keterangan lebih lanjut.</i><p>
                </div>
            </div>            
        </div>
    </div>
</section>
