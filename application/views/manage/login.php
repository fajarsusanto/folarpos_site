<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->config->item('title')?></title>
        <meta name="description" content="<?php echo ucwords($this->config->item("config_app_desc")); ?>">
        <meta name="author" content="Folarbiz Enterprise">
        <meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/min/main.min.css">
        <link rel="icon" href="<?php echo base_url(); ?>assets-ds/fav.png" type="image/x-png">
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
                background-position: center ;
                background-attachment: fixed;
                background-size: cover;
                height: 100%;
                width: auto;
            }
        </style>
    </head>
    <body class="bg-dark" >        
        <div class="app-user">
            <div class="user-container" style="padding-top: 50px; padding-bottom: 100px">
                <img src="<?php echo base_url() ?>assets-ds/logo.png" style="width:100%"/>
                <section class="panel panel-info mg-t-sm">
                    <header class="panel-heading text-center"></header>
                    <div class="bg-white user pd-md">
                        <?php echo $this->session->flashdata('msg'); ?>
                        <div id="login-response"></div>
                        <p><i class="fa fa-info-circle mg-r-md text-warning"></i><i>Please enter your username and password correctly</i></p>
                        <form id="frm_login" role="form" method="post" action="<?php echo site_url(); ?>auth/login" class="form form--flex form--auth">
                            <div class="input-group input-group-md mg-b-md">
                                <span class="input-group-addon bg-dark"><i class="fa fa-user text-white"></i></span>                          
                                <input type="text" name="user_username" placeholder="Username..." id="login-username-dropdown" required data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-validation-threshold="5" data-parsley-minlength-message="Login should be at least 6 chars" class="form-control">
                            </div>
                            <div class="input-group input-group-md mg-b-md">
                                <span class="input-group-addon bg-dark"><i class="fa fa-key text-white"></i></span>
                                <input type="password" name="user_password" id="login-password-dropdown" placeholder="Password..." required class="form-control">
                            </div>
                            <button type="submit" class="btn btn-dark col-xs-12" ><i class='fa fa-sign-in mg-r-sm'></i>Log In</button>
                        </form>
                        <div class="row">
                            <div class="col-xs-12 mg-t-md text-right"><i>Forgot password ? 
                                    <a href="<?php echo base_url(); ?>reset" role="button" class="app__forgot">Reset</a>.</i>
                            </div>
                            <div class="col-xs-12 text-center mg-t-lg">
                                <?php echo date('Y'); ?> &COPY; <b><?php echo ucwords($this->config->item("config_client_name")) ?></b>. All Right Reserved 
                            </div>
                            <div class="col-xs-12 text-center mg-t-xs" style="color: grey">
                                Powered by <a href="http://<?php echo strtoupper($this->config->item("config_company_site")) ?>" style="color: grey; font-style: italic" target="_blank"><?php echo ucwords($this->config->item("config_company")); ?></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <script src="<?php echo base_url() ?>assets-ds/min/main.min.js"></script>
    </body>

    <script>
        $("#frm_login").submit(function (e) {
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                url: url,
                data: data,
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 1) {
                        location.href = json.red;
                    }
                    $("#login-response").html(json.msg);
                }
            });
        });
    </script>
</html>
