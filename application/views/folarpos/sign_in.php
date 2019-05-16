<!-- Login -->
<section id="login" class="page-banner padding">
    <div class="container">
        <h3 class="hidden">hidden</h3>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="profile-login">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Login</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Register</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content padding_half">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div class="agent-p-form">
                                <div id="login-response"></div>
                                <?php
                                echo $this->session->flashdata("mailm");
                                echo $this->session->flashdata('sukses');
                                ?>
                                <form id="frm_login" role="form" action="<?php echo base_url(); ?>auth/login" method="post" class="callus clearfix">
                                    <div class="form-group col-sm-12">
                                        <input type="text" name="user_username" class="col-sm-12 col-lg-12 col-md-12 col-xs-12 keyword-input" placeholder="Username or Email...">
                                    </div>
                                    <div class="single-query form-group  col-sm-12">
                                        <input type="password" name="user_password" class="keyword-input" placeholder="Password...">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-6">
                                                <div class="search-form-group white form-group text-left">
                                                    <div class="check-box-2"><i><input type="checkbox" name="check-box"></i></div>
                                                    <span>Remember Me</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <a href="<?php echo base_url('reset') ?>" class="lost-pass">Lost your password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn-slide border_radius" ><i class='fa fa-sign-in mg-r-sm'></i>Log In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile">
                            <div class="agent-p-form">
                                <?php
                                echo $this->session->flashdata('register');
                                ?>
                                <form id="frm_register" role="form" action="<?php echo base_url(); ?>auth/Registration" method="post" class="callus clearfix">
                                    <div class="single-query col-sm-12 form-group">
                                        <input type="text" name="fullname" class="keyword-input" placeholder="Fullname" required>
                                    </div>
                                    <div class="single-query col-sm-12 form-group">
                                        <input type="text" name="email" class="keyword-input" placeholder="Email Address">
                                    </div>                                    
                                    <div class="single-query col-sm-12 form-group">
                                        <input type="text" name="username" class="keyword-input" placeholder="username" required>
                                    </div>
                                    <div class="single-query col-sm-12 form-group">
                                        <input type="password" name="password" class="pass1 keyword-input" placeholder="Password">
                                    </div>
                                    <div class="single-query col-sm-12 form-group">
                                        <input type="password" name="password2" class="pass2 keyword-input" placeholder="Confirm  Password">
                                    </div>
                                    <div class="pass3"></div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <div class="query-submit-button">
                                            <input type="submit" value="Creat an Account" class="btn-slide">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
//    $(document).ready(function(){
//        $("#frm_login").submit(function (e) {
//            e.preventDefault();
//            var url = $(this).attr('action');
//            var data = $(this).serialize();
//            console.log(data)
//
//            $.ajax({
//                url: url,
//                data: data,
//                type: "POST",
//                dataType: "JSON",
//                success: function (json) {
//                    if (json.status == 1) {
//                        location.href = json.red;
//                    }
//                    $("#login-response").html(json.msg);
//                }
//            });
//        });
//    })
//    function pass(){
//        var pass1 = $(".pass1").val();
//        var pass2 = $(".pass2").val();
//        if (pass1 == 'asd'){
//            $(".pass3").load("<div class='col-sm-12'><div class='alert alert-success alert-dismissable'><i class='fa fa-info-circle mg-r-md'></i>Password tidak sama </div></div>");
//        }
//    }
//    function log_in(){
//        //$("#frm_login").submit(function (e) {
//        //e.preventDefault();
//        var url = $(this).attr('action');
//        var data = $(this).serialize();
//
//        $.ajax({
//            url: url,
//            data: data,
//            type: "POST",
//            dataType: "JSON",
//            success: function (json) {
//                if (json.status == 1) {
//                    location.href = json.red;
//                }
//                $("#login-response").html(json.msg);
//            }
//        });
//    //});
//    }
    
</script>
