<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title><?php echo $this->config->item('title'); ?> | <?php echo $title; ?></title>
        <meta name="description" content="FIS or Folarium Integrated System's Enterprise Resource Planning">
        <meta name="author" content="Folarium Technomedia">
        <!-- Favicon -->
        <link rel="icon" href="<?php echo base_url(); ?>assets-ds/fav.png" type="image/png">
        <script src="<?php echo base_url(); ?>assets-ds/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets-ds/vendor/modernizr.js"></script>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets-ds/select-master/dist/css/selectize.bootstrap3.css">

        <link href="<?php echo base_url() ?>assets-ds/vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url() ?>assets-ds/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">

        <!-- Custom CSS -->
        <link href="<?php echo base_url() ?>assets-ds/dist/css/style.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url() ?>assets-ds/confirm/sweetalert.css">
        <script src="<?php echo base_url() ?>assets-ds/confirm/sweetalert.min.js"></script>
<!--        <link href="<?php echo base_url() ?>assets/vendors/bower_components/jsgrid/dist/jsgrid.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() ?>assets/vendors/bower_components/jsgrid/dist/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>-->
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!-- /Preloader -->
        <div class="wrapper theme-1-active pimary-color-pink">
            <!-- Top Menu Items -->
            <?php $this->load->view("template/header/header_admin"); ?>   
            <!-- /Top Menu Items -->

            <!-- Left Sidebar Menu -->
            <?php $this->load->view("template/nav/nav_admin"); ?>   
            <!-- /Left Sidebar Menu -->
            <?php $this->load->view("extend/modal"); ?>
            <!-- Main Content -->
            <div class="page-wrapper">
                <div class="container-fluid">
                    <!-- Row -->
                    <?php $this->load->view($content); ?>
                    <!-- Row -->
                </div>

                <!-- Footer -->
                <footer class="footer container-fluid pl-30 pr-30">
                    <div class="row">
                        <div class="col-sm-12">
                            <p><?php echo date("Y") ?> &copy; Folarium Corporation. All Right Reserved</p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script>
            var baseUrl = '<?php echo "";//base_url() ?>';
            var Human_login = '<?php echo "";// $sess['users']->users_fullname; ?>'
        </script>  
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/jquery/dist/jquery.min.js"></script>        

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/chart/highcharts.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/chart/highcharts-3d.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/assets-ds/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets-ds/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets-ds/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <script type="text/javascript" src="<?php echo base_url() ?>/assets-ds/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript">
//            var $fcb = jQuery.noConflict();
            $('.fancybox').fancybox();

            $('.fancybox-buttons').fancybox({
                openEffect: 'none',
                closeEffect: 'none',
                prevEffect: 'none',
                nextEffect: 'none',
                closeBtn: false,
                helpers: {
                    title: {
                        type: 'inside'
                    },
                    buttons: {}
                },
                afterLoad: function () {
                    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                }
            });
        </script> 
        <!-- Slimscroll JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/dist/js/jquery.slimscroll.js"></script>

        <!-- Progressbar Animation JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- Fancy Dropdown JS -->
        <script src="<?php echo base_url() ?>assets-ds/dist/js/dropdown-bootstrap-extended.js"></script>

        <!-- Sparkline JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

        <!-- Owl JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

        <!-- Switchery JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/switchery/dist/switchery.min.js"></script>

        <!-- EChartJS JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/echarts/dist/echarts-en.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/vendors/echarts-liquidfill.min.js"></script>

        <!-- Toast JavaScript -->
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

        <!-- Init JavaScript -->
        <script src='<?php echo base_url(); ?>assets-ds/fullcalendar/resource/moment.min.js'></script>
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/vendors/jquery-ui.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/dist/js/init.js"></script>
        <script src="<?php echo base_url() ?>assets-ds/folarium/for.library.min.js"></script>
    </body>
</html>
