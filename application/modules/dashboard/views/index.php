
<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $count_prod->jml ?></span></span>
                                    <span class="weight-500 uppercase-font block font-13">Products</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $count_testi->jml ?></span></span>
                                    <span class="weight-500 uppercase-font block">Testimony</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $count_msg->jml ?></span></span>
                                    <span class="weight-500 uppercase-font block">Message</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-7 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $count_subs->jml ?></span></span>
                                    <span class="weight-500 uppercase-font block">Subscribes</span>
                                </div>
                                <div class="col-xs-5 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 ">
        <div class="col-lg-2 col-md-2 col-sm-2 ">
            <div class="form-group">
                <div class="input-group input-group-md">                    
                    <span class="input-group-addon bg-default text-white"><i class="fa fa-calendar"></i></span>
                    <select name="tahun_m" class="reseter-option-fil" id="fil" >
                        <option value="all">- Semua -</option>
                        <?php foreach ($tahun as $nn => $row) {
                            if ($nn == 0) {
                                ?>
                                <option <?php echo date('Y') == ($row->tahun - 1) ? 'selected' : ''; ?> value="<?php echo $row->tahun - 1; ?>"><?php echo $row->tahun - 1; ?></option>    
                            <?php } ?>
                            <option <?php echo date('Y') == $row->tahun ? 'selected' : ''; ?> value="<?php echo $row->tahun; ?>"><?php echo $row->tahun; ?></option>
                        <?php } ?>                        
                    </select>
                </div>
            </div>
        </div>  
<!--        <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="form-group">
                <div class="input-group input-group-md">                    
                    <span class="input-group-addon bg-default text-white"><i class="fa fa-th-large"></i></span>
                    <select name="type_d" class="reseter-option-fil" id="fil" >
                        <option value="all">Semua (Graph Pie)</option>
                        <option value="desktop">Desktop (Graph Pie)</option>   
                        <option value="mobile">Mobile (Graph Pie)</option>
                    </select>
                </div>
            </div>
        </div>-->
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
            <a role="button" class="btn btn-success col-xs-12 mg-b-xs" onclick="sorSup()"><i class="fa fa-search mg-r-sm"></i></a>
        </div>
    </div>    
</div>

<div class="row">    
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="data_column" ></div>                            
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div id="data_column_prod" ></div>                            
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div id="data_pie_prod" ></div>                            
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="data_column_cont" ></div>                            
    </div> 
<!--    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
        <div id="data_gauge" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto" ></div>       
    </div>-->
</div>

<script>
    $('.reseter-option-fil').selectize();
    sorSup();
    function sorSup() {
        var thn = $('select[name=tahun_m] option:selected').val();
        var td = 'all';
        $("#data_column").load('<?php echo base_url('dashboard') ?>/column/' + thn + '/' + td);
        $("#data_column_prod").load('<?php echo base_url('dashboard') ?>/column_prod/' + thn + '/' + td);
        $("#data_column_cont").load('<?php echo base_url('dashboard') ?>/column_cont/' + thn + '/' + td);
        $("#data_pie_prod").load('<?php echo base_url('dashboard') ?>/pie_prod/' + thn + '/' + td);
        //$("#data_gauge").load('<?php echo base_url('dashboard') ?>/gauge/' + thn + '/' + td);
    }
</script>
<!--<script src="<?php echo base_url() ?>assets-ds/chart/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>-->
<!--<script>
Highcharts.chart('data_gauge', {

    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false
    },

    title: {
        text: 'Speedometer'
    },

    pane: {
        startAngle: -150,
        endAngle: 150,
        background: [{
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#FFF'],
                    [1, '#333']
                ]
            },
            borderWidth: 0,
            outerRadius: '109%'
        }, {
            backgroundColor: {
                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                stops: [
                    [0, '#333'],
                    [1, '#FFF']
                ]
            },
            borderWidth: 1,
            outerRadius: '107%'
        }, {
            // default background
        }, {
            backgroundColor: '#DDD',
            borderWidth: 0,
            outerRadius: '105%',
            innerRadius: '103%'
        }]
    },

    // the value axis
    yAxis: {
        min: 0,
        max: 1000,

        minorTickInterval: 'auto',
        minorTickWidth: 1,
        minorTickLength: 10,
        minorTickPosition: 'inside',
        minorTickColor: '#666',

        tickPixelInterval: 30,
        tickWidth: 2,
        tickPosition: 'inside',
        tickLength: 10,
        tickColor: '#666',
        labels: {
            step: 2,
            rotation: 'auto'
        },
        title: {
            text: 'km/h'
        },
        plotBands: [{
            from: 0,
            to: 120,
            color: '#55BF3B' // green
        }, {
            from: 120,
            to: 160,
            color: '#DDDF0D' // yellow
        }, {
            from: 160,
            to: 200,
            color: '#DF5353' // red
        }]
    },

    series: [{
        name: 'Speed',
        data: [80],
        tooltip: {
            valueSuffix: ' km/h'
        }
    }]

});
</script>-->