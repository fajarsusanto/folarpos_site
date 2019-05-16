<script src="<?php echo base_url() ?>assets-ds/js/highcharts.src.js"></script>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="row">
            <div class="col-xs-12 mg-b-md">
                <h3 style="border-bottom: 1px solid grey; padding-bottom: 5px; margin-bottom: 3px; margin-top: 0px; padding-top: 0px">
                    <i class="fa fa-home mg-r-sm"></i>Dashboard
                </h3>
                <small><i>Data Resume in System & Manage Data Listing</i></small>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 ">
                <div id="container_bar"  style="margin: 0 auto;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 mg-b-md mg-t-md">
                <h3 style="border-bottom: 1px solid grey; padding-bottom: 5px; margin-bottom: 3px; margin-top: 0px; padding-top: 0px">
                    <i class="fa fa-edit mg-r-sm"></i>Latest News
                </h3>
                <small><i>Get all new information at HunianID</i></small>
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
</div>
<script>
    Highcharts.chart('container_bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Visitor By Device'
    },
    subtitle: {
        text: 'Source: HunianID.com'
    },
    xAxis: {
        categories: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Visitor'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Visitor</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [<?php foreach ($devicee as $nompp => $rpp) { ?> {
                        name: '<?php echo $rpp->read_device; ?>',
                        data: [<?php echo $device[$nompp]->januari > 0 ? $device[$nompp]->januari : 'null'; ?>, <?php echo $device[$nompp]->februari > 0 ? $device[$nompp]->februari : 'null'; ?>, <?php echo $device[$nompp]->maret > 0 ? $device[$nompp]->maret : 'null'; ?>, <?php echo $device[$nompp]->april > 0 ? $device[$nompp]->april : 'null'; ?>, <?php echo $device[$nompp]->mei > 0 ? $device[$nompp]->mei : 'null'; ?>, <?php echo $device[$nompp]->juni > 0 ? $device[$nompp]->juni : 'null'; ?>, <?php echo $device[$nompp]->juli > 0 ? $device[$nompp]->juli : 'null'; ?>, <?php echo $device[$nompp]->agustus > 0 ? $device[$nompp]->agustus : 'null'; ?>, <?php echo $device[$nompp]->september > 0 ? $device[$nompp]->september : 'null'; ?>, <?php echo $device[$nompp]->oktober > 0 ? $device[$nompp]->oktober : 'null'; ?>, <?php echo $device[$nompp]->november > 0 ? $device[$nompp]->november : 'null'; ?>, <?php echo $device[$nompp]->desember > 0 ? $device[$nompp]->desember : 'null'; ?>]
    }, <?php } ?>]
});
    
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