<!-- ==================================================
            NEWSLETTER AND SOCIAL DIVIDER
        ======================================================= -->
<section class="newsletter color-bg" id="newsletter">
    <div class="container">
        <div class="wrapper-sm">
            <div class="row">
                <div class="col-md-6">
                    <!-- =========================
                        Social Icons
                    ============================== -->
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell follow">
                                <h5 class="table-title">Ikuti Kami</h5>
                            </div>
                            <div class="table-cell">
                                <ul class="social-list">
                                    <?php if (!empty($apps['app']->apps_fb)) { ?>
                                        <li>
                                            <a href="<?php echo $apps['app']->apps_fb ?>" target="new">
                                                <i class="icon icon-facebook"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty($apps['app']->apps_ig)) { ?>
                                        <li>
                                            <a href="<?php echo $apps['app']->apps_ig ?>" target="new">
                                                <i class="icon icon-twitter"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <?php if (!empty($apps['app']->apps_ln)) { ?>
                                        <li>
                                            <a href="<?php echo $apps['app']->apps_ln ?>" target="new">
                                                <i class="icon icon-linkedin"></i>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">         
                    <form class="mailchimp-subscribe" role="form">
                        <div class="table">
                            <div class="table-row">
                                <div class="table-cell getnewsletter">
                                    <h5 class="table-title">Berlangganan Berita</h5>
                                </div>
                                <div class="table-cell">
                                    <div class="input-group text-white">
                                        <input type="email" id="subscriber-email" name="email" placeholder="Emailmu" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-white">Berlangganan</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =============================
     /END NEWSLETTER SECTION 
============================== -->
<footer class="footer dark-bg" id="footer">
    <div class="container">
        <div class="wrapper-sm">
            <div class="row">
                <div class="col-md-5">
                    <a href="#top" class="scrollto" title="Folarpos">
                        <span class="text-logo"><?php echo $apps['app']->apps_name ?></span>
                    </a>
                    <p class="footer-hero">
                        <?php echo shortext($apps['app']->apps_desc, 160) ?> </p>
                    <p class="footer-cta">Ingin tahu lebih lengkap ?
                        <br><br><a href="<?php echo site_url("contact") ?>" class="btn btn-color">Kunjungi Pusat Layanan</a>
                    </p> 
                </div>
                <div class="col-md-3">
                    <h5 class="text-white">Hubungi Kami</h5>
                    <ul>
                        <li style="margin-bottom: 10px">
                            <span style="margin-right: 10px; width: 100px"><i class="icon icon_mail"></i></span><a href="mailto:<?php echo $apps['app']->apps_mail ?>"><?php echo $apps['app']->apps_mail ?></a>
                        </li>
                        <li style="margin-bottom: 10px">
                            <span style="margin-right: 10px; width: 100px"><i class="icon icon_phone"></i></span><a href="tel:<?php echo $apps['app']->apps_phone ?>"><?php echo $apps['app']->apps_phone ?></a>
                        </li>
                        <li>
                            <span style="margin-right: 10px; width: 100px"><i class="icon icon_pin"></i></span><?php echo $apps['app']->apps_address ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-white">Instagram</h5>
                    <script src="//lightwidget.com/widgets/lightwidget.js"></script><iframe src="//lightwidget.com/widgets/0e4d1373ea115c188b2161f91238fed9.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="footer-nav">
                            <li>
                                <a href="<?php echo site_url("profile") ?>" title="Profil">Profil</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("blog") ?>" title="Blog">Blog & Tips</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("career") ?>" title="Karir">Karir</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("gallery") ?>" title="Galeri" >Galeri</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("referral") ?>" title="referral">Referral</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("help") ?>" title="Bantuan">Bantuan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("term") ?>" title="Ketentuan">Ketentuan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url("privacy") ?>" title="Privacy">Keamanan</a>
                            </li>

                        </ul>
                        <p class="footer-copy" style="text-align: center">2017 &copy; Folarpos Salepoint. All Right Reserved.<br/><br/><span style="margin-top: 120px"><i>Developed by <a href="http://www.folarcom.co.id" target="new">Folarcom Siteplace</a></i></span></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>
</div>
<script src="<?= base_url() ?>assets/js/plugins/jquery1.11.0.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/jquery.easing.1.3.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/modernizr.custom.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/plugins.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/twitter/tweetie.min.js"></script>
<script src="<?= base_url() ?>assets/js/custom.js"></script>
<script src="<?= base_url() ?>assets/demo/styleswitcher.js"></script>
<script src="<?= base_url() ?>assets/demo/demo.js"></script>
<script src="<?php echo base_url() ?>tinymce/tinymce.min.js" type="text/javascript"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5a9554804b401e45400d3e3f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>