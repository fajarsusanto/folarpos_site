<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="mobile-only-brand pull-left">
        <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
        <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
    </div>
    <div id="mobile_only_nav" class="mobile-only-nav pull-right">
        <ul class="nav navbar-right top-nav pull-right">
            <li class="dropdown full-width-drp mr-10">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Modul"><i class="zmdi zmdi-apps top-nav-icon"></i></a>
                <ul class="dropdown-menu mega-menu pa-0" data-dropdown-in="slideInRight" data-dropdown-out="flipOutX">
                    <li class="product-nicescroll-bar row">
                        <ul class="pa-20">
                            <li class="col-md-12 col-xs-6 col-menu-list text-left">
                                <h4 style="font-size: 18px"><i class="fa fa-th-large mr-10"></i>MODUL MENU</h4>
                                <hr class="light-grey-hr ma-10 mb-10"/>
                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="<?php echo base_url() ?>">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div >Marketing <sup><small style="font-size: 10px; color: red">Soon</small></sup></div>
                                </a>

                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="<?php echo base_url() ?>">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div >Finance <sup><small style="font-size: 10px; color: red">Soon</small></sup></div>
                                </a>
                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div <?php echo isset($maint) ? $maint : null; ?> >Maintenance</div>
                                </a>

                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="<?php echo base_url() ?>">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div >Warehouse <sup><small style="font-size: 10px; color: red">Soon</small></sup></div>
                                </a>
                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div >Purchasing <sup><small style="font-size: 10px; color: red">Soon</small></sup></div>
                                </a>
                            </li>
                            <li class="col-md-2 col-xs-6 col-menu-list text-center">
                                <a href="">
                                    <img src="" style="height: 100px"/>
                                    <hr class="light-grey-hr ma-10"/>
                                    <div <?php echo isset($hr) ? $hr : null; ?> >Human Resource</div>
                                </a>

                            </li>
                        </ul>
                    </li>	
                </ul>
            </li>
            <li class="dropdown alert-drp mr-10">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge" id="load_row"></span></a>
                <ul  class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                    <li>
                        <div class="notification-box-head-wrap">
                            <span class="notification-box-head pull-left inline-block">notifications</span>
                            <div class="clearfix"></div>
                            <hr class="light-grey-hr ma-0"/>
                        </div>
                    </li>
                    <li>
                        <div class="streamline message-nicescroll-bar" id="load_data">

                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown auth-drp">
                <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                    <img id="preview-upload-logo" src="<?php echo base_url(!empty($sess['users']->users_photo) ? $sess['users']->users_photo : "assets-ds/nonuser.png") ?>" alt="user_auth" class="user-auth-img img-circle"/>
                    <span class="user-online-status"></span></a>
                <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <li>
                        <a href="<?php echo base_url() ?>dash-v/my-profile"><i class="zmdi zmdi-account"></i><span>Your Account</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>dash-v/apps-profile"><i class="zmdi zmdi-settings"></i><span>Setting System</span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() ?>logout"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>	
</nav>

<script>
    //$(document).ready(function () {
    //    $("#load_row").load('<?php echo base_url() ?>dash-v/notif/load_row');
    //    $("#load_data").load('<?php echo base_url() ?>dash-v/notif/load_data');
    //});

    //function SetReminder() {
    //    $(".modal-sm #mySmallModalLabel").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading data. Please wait...');
    //    $(".modal-sm .modal-body").html("");
    //    $(".modal-sm .modal-body").load("<?php echo base_url() ?>dash-v/set-reminder")
    //}
</script>