<script src="https://code.highcharts.com/modules/exporting.js"></script>
<style>
    .highcharts-credits {
        display:none;
    }
</style>
<!--<div class="col-lg-6 col-md-6 col-sm-12 ">
    <div id="container_pie" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12 ">
    <div id="container_pie_sub" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
</div>-->
<script>    
Highcharts.chart('container_pie', {
    chart: {
     credits: {
      enabled: false
  },    
    type: 'pie',
            options3d: {
            enabled: true,
                    alpha: 45,
                    beta: 0
            }
    },
            title: {
            text: 'Visitor By Type Property'
            },
            tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
            pie: {
            allowPointSelect: true,
                    cursor: 'pointer',
                    depth: 35,
                    dataLabels: {
                    enabled: true,
                            format: '{point.name}'
                    }
            }
            },
            series: [{
            name: 'Total',
                    colorByPoint: true,
                    data: [<?php foreach ($type_prop as $nn => $r) { ?> {
                    name: '<?php echo $r->prop_type_name; ?>',
                            y: <?php echo $count[$nn]; ?>,<?php if ($nn == 1) { ?>
                    sliced: true,
                            selected: true
    <?php } ?>
                        }, <?php } ?> ]
            }]
            });

Highcharts.chart('container_pie_sub', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Visitor By Type Device'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
            name: 'Total',
                    colorByPoint: true,
                    data: [<?php foreach ($type_propp as $nn => $r) { ?> {
                    name: '<?php echo $r->prop_type_name; ?>',
                            y: <?php echo $countt[$nn]; ?>,<?php if ($nn == 1) { ?>
                    sliced: true,
                            selected: true
    <?php } ?>
                        }, <?php } ?> ]
            }]
});
</script>