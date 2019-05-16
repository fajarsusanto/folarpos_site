<div class="widget js-widget widget--main widget--no-border mg-b-sm">
    <div class="widget__content">
        <div class="auth auth--inline">
            <div class="auth__wrap auth__wrap--login">
                <!-- BEGIN AUTH RESET-->
                
                <h5 class="auth__title">Reset in your account</h5>
                <div id="reset-response"></div>                
                <form id="frm_reset" role="form" method="post" action="<?php echo site_url(); ?>auth/reset" class="form form--flex form--auth">
                    <div class="row">
                        <div class="form-group">
                            <label for="login-username-dropdown" class="control-label">Email</label>                          
                            <input type="text" name="user_email" placeholder="Email" id="login-username-dropdown" required data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-validation-threshold="5" data-parsley-minlength-message="Login should be at least 6 chars" class="form-control">
                        </div>
                        
                    </div>
                    
                    <button type="submit" class="btn btn-primary col-xs-12" ><i class='fa fa-sign-in mg-r-sm'></i>Reset</button>

                    <div class="form-group  text-right">
                        <div class="row">
                            <div class="col-xs-12 mg-t-md">
                                <a href="<?php echo base_url('') ?>" class="js-user-restore" style="text-decoration: none">Log in ?</a>
                            </div>
                        </div>

                    </div>
                    
                </form>
                <!-- end of block .auth__form-->
                    <!-- END AUTH RESET-->
            </div>
        </div>
    </div>
</div>
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
                $("#reset-response").html(json.msg);
            }
        });
    });
</script>