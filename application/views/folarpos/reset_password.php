<section id="login" class="page-banner padding">
    <div class="container">
        <h3 class="hidden">hidden</h3>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="profile-login">
                    <div class="tab-content padding_half">
                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                            <div class="agent-p-form">
                                <div id="login-response"></div>
                                <?php
                                echo $this->session->flashdata('sukses');
                                ?>
                                <form id="frm_reset" role="form" action="<?php echo base_url(); ?>auth/ForgotPassword" method="post" class="callus clearfix">
                                    <div class="single-query form-group col-sm-12">
                                        <input type="text" name="email" class="keyword-input" placeholder="Entry Your Email">
                                    </div>
                                    <div class=" col-sm-12">
                                        <button type="submit" class="btn-slide border_radius" ><i class='fa fa-reply mg-r-sm'></i>Reset Password</button>
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