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
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo rupiah($j_customers); ?></span></span>
                                    <span class="weight-500 uppercase-font block font-13">Customer</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-user-following data-right-rep-icon txt-light-grey"></i>
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
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $j_projects; ?></span>%</span>
                                    <span class="weight-500 uppercase-font block">Projects Rate</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-control-rewind data-right-rep-icon txt-light-grey"></i>
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
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo rupiah($j_products); ?></span></span>
                                    <span class="weight-500 uppercase-font block">Products</span>
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
                                    <span class="txt-dark block counter"><span class="counter-anim"><?php echo $j_maintenance; ?></span>%</span>
                                    <span class="weight-500 uppercase-font block">Maintenance Rate</span>
                                </div>
                                <div class="col-xs-5 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="icon-control-rewind data-right-rep-icon txt-light-grey"></i>
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
    <div class="col-lg-12 mt-10">
        <div class="add-event-wrap">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-10">
                    <h5 class="txt-dark" style="font-style: italic"><i class="fa fa-th-large mr-10"></i> <b>Schedule & Record - <i>Data Maintenance</i></h5>
                    <hr class="light-grey-hr ma-10"/>
                </div>
                <?php if (in_array($sess['level_id'], array(1, 2, 3))) { ?>

                    <div class="col-md-3 mg-b-sm">
                        <div class="input-group">
                            <span class="input-group-addon bg-success" style="color: white"><i class="fa fa-filter text-white"></i></span>
                            <select class="reseter-option-tp" name="tp" onchange="getType(this)" data-placeholder="Filter">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mg-b-sm">
                        <div class="input-group">
                            <span class="input-group-addon bg-success" style="color: white"><i class="fa fa-check text-white"></i></span>
                            <select class="reseter-option-stt" name="stt" onchange="getType(this)" data-placeholder="Status">
                            </select>
                        </div>
                    </div>


                <?php } ?>
            </div>
        </div>
        <div class="calendar-wrap mt-10">
            <div id="calendar_data"></div>
        </div>
    </div>	
</div>	

<script>
    getType();
//
//    $(".class-loader").load("<?php echo base_url(); ?>load-notif").show();
    //setInterval(function () {
    //   $(".class-loader").load("<?php echo base_url(); ?>load-notif").show();
    //}, 10000);

    $('.reseter-option-tp').selectize({
    options: [
<?php foreach ($main_type as $rr) { ?>
        {class: 'type', value: "type-<?php echo $rr->type_id; ?>", name: "<?php echo $rr->type_name; ?>" },
<?php } foreach ($products as $rrp) { ?>
        {class: 'products', value: "prod-<?php echo $rrp->prod_id; ?>", name: "<?php echo $rrp->prod_name; ?>" },
<?php } ?>

    ],
            optgroups: [
            {value: 'type', label: 'Type', label_scientific: '(Maintenance Type)'},
            {value: 'products', label: 'Products', label_scientific: '(Products)'}
            ],
            optgroupField: 'class',
            labelField: 'name',
            searchField: ['name'],
            render: {
            optgroup_header: function(data, escape) {
            return '<div class="optgroup-header">' + escape(data.label) + ' <span class="scientific">' + escape(data.label_scientific) + '</span></div>';
            }
            }
    });
    $('.reseter-option-stt').selectize({
    options: [
    {class: 'status', value: "status-1", name: "On Proccess" },
    {class: 'status', value: "status-1a", name: "On Progress" },
    {class: 'status', value: "status-2", name: "Solved" },
    ],
            optgroupField: 'class',
            labelField: 'name',
            searchField: ['name']
    });
    function getType() {
    var tp = $("select[name=tp]").val();
    var stt = $("select[name=stt]").val();
    $("#calendar_data").load("<?php echo base_url() ?>dashboard_data/" + (!tp ? 'all' : tp) + '?status=' + (!stt ? 'all' : stt));
    }

</script>
