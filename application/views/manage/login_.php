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

            /* Create a custom checkbox */
            /* The container */
            .container {
                float:left;
                display: block;
                width:40%;
                padding-bottom: 20px;
                position: relative;                
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Hide the browser's default checkbox */
            .container input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            /* Create a custom checkbox */
            .checkmark {
                position: absolute;
                top: 0;
                left: 0;
                height: 25px;
                width: 25px;
                background-color: #eee;
            }

            /* On mouse-over, add a grey background color */
            .container:hover input ~ .checkmark {
                background-color: #ccc;
            }

            /* When the checkbox is checked, add a blue background */
            .container input:checked ~ .checkmark {
                background-color: #39ace7;
            }

            /* Create the checkmark/indicator (hidden when not checked) */
            .checkmark:after {
                content: "";
                position: absolute;
                display: none;
            }

            /* Show the checkmark when checked */
            .container input:checked ~ .checkmark:after {
                display: block;
            }

            /* Style the checkmark/indicator */
            .container .checkmark:after {
                left: 9px;
                top: 5px;
                width: 5px;
                height: 10px;
                border: solid white;
                border-width: 0 3px 3px 0;
                -webkit-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                transform: rotate(45deg);
            }
        </style>
    </head>

    <body>

        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->
                <h2 class="active"> Sign In </h2>
                <!-- Icon -->
                <div class="fadeIn first" style="padding-bottom:10px;">
                    <img src="<?php echo base_url() ?>assets-ds/logo.png" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form role="form" id="form_login" method="post" action="<?php echo site_url(); ?>auth/login">
                    <input type="text" id="login" class="fadeIn second" name="user_username" placeholder="Username..." required>
                    <input type="password" id="password" class="fadeIn third" name="user_password" placeholder="Password..." required>
                    <button id="loginButton" type="submit" class="fadeIn fourth" ><i class='fa fa-sign-in mg-r-sm'></i>Log In</button>  
                </form>


                <!-- Remind Passowrd -->
                <div id="formFooter"> 
                    <label class="container"> Remember
                        <input type="checkbox" value="remember-me" id="remember_me">  
                        <span class="checkmark"></span>
                    </label>                    
                    <a style="float:right" class="underlineHover" href="<?php echo base_url(); ?>reset">Forgot Password?</a>                   
                </div>                
            </div>
            <div class="company fadeIn"><?php echo date('Y'); ?> &COPY; <b><?php echo ucwords($this->config->item("config_client_name")) ?></b>. All Right Reserved</div>
            <p class="powered fadeIn">Powered by <a href="http://<?php echo strtoupper($this->config->item("config_company_site")) ?>" style="color: grey; font-style: italic" target="_blank"><?php echo ucwords($this->config->item("config_company")); ?></a></p>

        </div>
        <script src="<?php echo base_url() ?>assets-ds/min/main.min.js"></script>
        <script>
            $("#form_login").submit(function (e) {
                e.preventDefault();
                $("#loginButton").html("Please wait ...").attr("disabled", "disabled");
                var url = $(this).attr('action');
                var data = $(this).serialize();
                $.ajax({
                    url: url,
                    data: data,
                    type: "POST",
                    dataType: "JSON",
                    success: function (json) {
                        document.getElementById("loginButton").disabled = false;
                        $("#loginButton").html("Log In");
                        $("#loginButton").attr("class", "fadeIn fourth");
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
                    }
                });
            });

            $(function () {
                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#loginEmail').val(localStorage.usrname);
                    $('#loginPW').val(localStorage.pass);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#loginEmail').val('');
                    $('#loginPW').val('');
                }

                $('#remember_me').click(function () {

                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.usrname = $('#loginEmail').val();
                        localStorage.pass = $('#loginPW').val();
                        localStorage.chkbx = $('#remember_me').val();
                    } else {
                        localStorage.usrname = '';
                        localStorage.pass = '';
                        localStorage.chkbx = '';
                    }
                });
            });
        </script>