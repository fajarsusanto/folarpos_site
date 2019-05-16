<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->config->item('title'); ?></title>
        <meta name="description" content="<?php echo ucwords($this->config->item("config_app_desc")); ?>">
        <meta name="author" content="Folarbiz Enterprise">
        <meta name="viewport" content="width=device-width, user-scalable=1, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>assets-ds/fav.png" type="image/x-png">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/login/css/style.css">
        <script src="<?php echo base_url() ?>assets-ds/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets-ds/vendor/modernizr.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>assets-ds/confirm/sweetalert.css">
        <script src="<?php echo base_url() ?>assets-ds/confirm/sweetalert.min.js"></script>
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
            .company {
                padding-top: 30px;
                font-size:15px;
                margin:0px auto;
                color:white;
            }
            p.powered {
                font-size:12px;
                color:white;
            }
            .captcha {
                padding: 35px;
                margin-top: -25px;
                margin-left: 38px;
            }



        </style>
        <?php echo $script_captcha; // javascript recaptcha ?>
    </head>

    <body>

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <h2 class="active"> Forgot Password?</h2>
                <p style="color:#fff; margin-top:-10px;">You can reset your password here.</p>
                <!-- Icon -->
                <div class="fadeIn first" style="padding-bottom:10px;">
                    <img src="<?php echo base_url() ?>assets-ds/logo.png" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form role="form" id="form_reset" method="post" action="<?php echo site_url(); ?>auth/forgot">
                    <input type="email" id="email" class="fadeIn second" name="user_email" placeholder="Email..." required>
                    <div class="fadeIn third captcha">
                        <?php echo $captcha // tampilkan recaptcha  ?>
                    </div>    
                    <button id="loginReset" type="submit" class="fadeIn fourth" ><i class='fa fa-sign-in mg-r-sm'></i>Reset</button>  
                </form>


                <!-- Remind Passowrd -->
                <div id="formFooter">                                         
                    <a style="float:right; padding-bottom: 20px;" class="underlineHover" href="<?php echo base_url(); ?>home">Log In</a>                   
                </div>                
            </div>
            <div class="company fadeIn"><?php echo date('Y'); ?> &COPY; <b><?php echo ucwords($this->config->item("config_client_name")) ?></b>. All Right Reserved</div>
            <p class="powered fadeIn">Powered by <a href="http://<?php echo strtoupper($this->config->item("config_company_site")) ?>" style="color: grey; font-style: italic" target="_blank"><?php echo ucwords($this->config->item("config_company")); ?></a></p>

        </div>

        <script>
            $("#form_reset").submit(function (e) {
                e.preventDefault();
                $("#loginReset").html("Please wait ...").attr("disabled", "disabled");
                var url = $(this).attr('action');
                var data = $(this).serialize();
                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    dataType: "JSON",
                    success: function (json) {
                        document.getElementById("loginReset").disabled = false;
                        $("#loginReset").html("Log In");
                        $("#loginReset").attr("class", "fadeIn fourth");
                        if (json.status == 1) {
                            swal({
                                title: "Good job!",
                                text: json.msg,
                                type: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true
                            }, function () {
                                setTimeout(function () {
                                    location.href = json.red;
                                }, 3000);
                            });
                        } else {
                            swal("Oooppssss!", json.msg, "error");
                        }
                        $(document).ready(function () {
                            grecaptcha.reset();
                        });
                    }
                });
            });

        </script>