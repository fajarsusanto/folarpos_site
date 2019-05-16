<script src="https://code.highcharts.com/modules/exporting.js"></script>
<div class="col-lg-12 col-md-12 col-sm-12 ">
    <div id="container_bar"  style="margin: 0 auto; padding-bottom: 20px"></div>
</div>
<!--<div class="col-lg-4 col-md-4 col-sm-12 ">
    <div id="container_pie"  style="margin: 0 auto;"></div>
</div>
<div class="col-lg-8 col-md-8 col-sm-12 ">
    <div id="container_bar_sub"  style="margin: 0 auto; padding-bottom: 20px"></div>
</div>
<div class="col-lg-4 col-md-4 col-sm-12 ">
    <div id="container_pie_sub" style="margin: 0 auto; "></div>
</div>-->
<script>
    Highcharts.chart('container_bar', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'VISITOR FOLARPOS'
    },
    subtitle: {
        text: 'Source: folarpos.com'
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
            text: 'Group By Device'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:1f} visitor</b></td></tr>',
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
</script>