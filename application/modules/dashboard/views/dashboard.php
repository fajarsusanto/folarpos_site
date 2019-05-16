<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="row">
            <div class="col-xs-12 mg-b-md">
                <h3 style="border-bottom: 1px solid grey; padding-bottom: 5px; margin-bottom: 3px; margin-top: 0px; padding-top: 0px">
                    <i class="fa fa-home mg-r-sm"></i>Dashboard
                </h3>
                <small><i>Data Resume in System & Manage Data Listing</i></small>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="panel bg-dark light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-camera"></i> </div>
                        <h2 class="mt15 lh15 text-white"> <b><?php echo rupiah($total_listing) ?></b> </h2>
                        <h5 class="text-white"><b>TOTAL LISTING</b></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel bg-success light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-building-o"></i> </div>
                        <h2 class="mt15 lh15 text-white"> <b><?php echo rupiah($total_apartment) ?></b> </h2>
                        <h5 class="text-white"><b>TOTAL APARTMENT</b></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="panel bg-warning light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-users"></i></div>
                        <h2 class="mt15 lh15 text-white"> <b><?php echo rupiah($total_member) ?></b> </h2>
                        <h5 class="text-white"><b>TOTAL MEMBER</b></h5>
                    </div>
                </div>
            </div> 
            <!--<div class="col-md-6 col-sm-4">
                <div class="panel bg-info light of-h mb10">
                    <div class="pn pl20 p5">
                        <div class="icon-bg"> <i class="fa fa-truck"></i></div>
                        <h2 class="mt15 lh15 text-white"> <b><?php echo rupiah($total_agent) ?></b> </h2>
                        <h5 class="text-white"><b>TOTAL AGENT</b></h5>
                    </div>
                </div>
            </div>--> 
        </div>
        <div class="row">
            <div class="col-xs-12 mg-b-md mg-t-md">
                <h3 style="border-bottom: 1px solid grey; padding-bottom: 5px; margin-bottom: 3px; margin-top: 0px; padding-top: 0px">
                    <i class="fa fa-edit mg-r-sm"></i>Latest News
                </h3>
                <small><i>Get all new information at jakarta-apartment.com</i></small>
            </div>
        </div>
        <div class="row">
            <?php foreach ($latest_co as $nom_co => $row_co) { ?>
                <div class="col-xs-12 mg-b-md">
                    <b><i><?php echo $row_co->content_title ?></i></b>
                    <hr style="border-top: 1px solid grey; margin: 3px 0px 0px 0px; padding: 0px"/>
                    <small>Posted on <b><?php echo indo_date($row_co->content_date, 1, 1) ?></b><a href="<?php echo base_url("$row_co->menu_url-detail/$row_co->content_url") ?>" class="pull-right btn btn-xs btn-info mg-t-xs"><i class="fa fa-search mg-r-sm"></i>Readmore</a></small>
                    <p class="mg-t-md"><?php echo shortext($row_co->content_desc, 200) ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-6" id="load-subscribes"></div>
</div>
<script>
    $("#load-subscribes").load('<?php echo base_url() ?>dash-v/mg-subscribe-data');
    function latestNews() {
        $("#load-latest-news").html("<center style='margin-top: 50px;'><i class=' fa fa-refresh fa-spin mg-b-sm' style='font-size: 30px'></i><br/>Loading data ads !<br/>Please wait...</center>");
        $.ajax({
            url: '<?php echo base_url() ?>dash-v/latest-news',
            type: 'GET',
            dataType: 'json',
            success: function (json) {

                var template = "";
                if (json.id.length > 0) {
                    for (var i = 0; i < json.id.length; i++) {

                    }
                }
                $("#load-latest-news").html(template);
            }
        });
    }
</script>