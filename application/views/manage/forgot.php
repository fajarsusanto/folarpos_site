<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome to FORPRO</title>
        <meta name="description" content="<?php echo ucwords($this->config->item("config_app_desc")); ?>">
        <meta name="author" content="CV. Folarium Technomedia">
        <meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/min/main.min.css">
        <link rel="icon" href="<?php echo base_url(); ?>assets-ds/img/favicon.png" type="image/x-icon">
        <script src="<?php echo base_url(); ?>assets-ds/vendor/modernizr.js"></script>
        <style>
            @media screen and (min-width: 768px) {
                .error-container, .app-user {
                    top: 5%;   
                }
            }
            body{
                background-image: url('assets-ds/bg.jpg');
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
        </style>
    </head>
    <?php echo $script_captcha; // javascript recaptcha ?>
    <body class="bg-dark" >        
        <div class="app-user">
            <div class="user-container"  style="padding-bottom: 80px">
                <img alt="" src="<?php echo base_url() ?>assets-ds/.jpg" class="img-responsive" style="width: 100%; margin-left: auto; margin-right: auto; margin-top: 100px" />
                <section class="panel panel-dark">
                    <header class="panel-heading text-center lead" style="margin-bottom: 0; text-transform: capitalize"><b>FORPRO SYSTEM</b><hr style="margin: 0px; padding: 0px"/><small style="font-size: 16px"><i>Production Management System</i></small></header>
                    <div class="bg-white user pd-md">
                        <?php echo $this->session->flashdata('msg'); ?>
                        <div id="reset-response"></div>
                        <p><i class="fa fa-info-circle mg-r-md text-warning"></i><i>Please enter your Email correctly</i></p>
                        <form id="frm_reset" role="form" method="post" action="<?php echo site_url(); ?>auth/forgot" class="form form--flex form--auth">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="login-username-dropdown" class="control-label">Email</label>                          
                                        <input type="email" name="user_email" placeholder="Email" id="login-username-dropdown" required class="form-control">
                                    </div>                                    
                                </div>
                            </div>   <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <?php echo $captcha // tampilkan recaptcha  ?>
                                    </div> </div>
                            </div>
                            <button type="submit" class="btn btn-primary col-xs-12" ><i class='fa fa-sign-in mg-r-sm'></i>Reset</button>                   
                        </form>
                        <div class="row">
                            <div class="col-xs-12 mg-t-md text-right"><i>Back to Log In Form ?
                                    <a href="<?php echo base_url(); ?>home" role="button" class="app__forgot">Login</a>.</i>
                            </div>
                            <div class="col-xs-12 text-center mg-t-lg">
                                <?php echo date('Y'); ?> &COPY; <b><?php echo strtoupper($this->config->item("config_client_name")) ?></b>. All Right Reserved 
                            </div>
                            <div class="col-xs-12 text-center mg-t-xs" style="color: grey">
                                Powered by <a href="http://<?php echo strtoupper($this->config->item("config_company_site")) ?>" style="color: grey; font-style: italic" target="_blank"><?php echo strtoupper($this->config->item("config_company")); ?></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script src="<?php echo base_url() ?>assets-ds/min/main.min.js"></script>
    </body>

    <script>
        $("#frm_reset").submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                url: url,
                data: data,
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    grecaptcha.reset();
                    $("input").val("");
                    $("#reset-response").html(json.msg);
                }
            });
        });
    </script>
</html>
