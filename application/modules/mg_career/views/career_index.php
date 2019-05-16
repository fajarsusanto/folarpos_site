<script type="text/javascript" src="<?php echo base_url() ?>assets-ds/date-range/moment.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url() ?>assets-ds/date-range/daterangepicker.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets-ds/date-range/daterangepicker.js"></script>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div id="load-form" class="row"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mr-10"></i> Loading form. Please wait...</div></div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title txt-dark"><i class="fa fa-th-large mr-10"></i> DATA CAREER</h6>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">                                           
                            <div class="add-event-wrap">
                                <div class="row">
                                    <div class="col-lg-6 mg-b-sm" id="upp" >
                                        <div class="form-group">
                                            <div class="input-group input-group">
                                                <span class="input-group-addon bg-default text-white"><i class="fa fa-calendar mg-r-sm"></i></span>
                                                <input type="hidden" class="form-control" id="startDate" >
                                                <input type="hidden" class="form-control" id="endDate" >
                                                <input readonly style="cursor:pointer; background:white;" type="text" name='tglue' id="config-demos" class="input-xlarge form-control bg-white">                           
                                            </div>
                                            <p id="pesan_range"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mg-b-sm">
                                        <div class="input-group">
                                            <span class="input-group-addon bg-default"><i class="fa fa-search text-white"></i></span>
                                            <input type="text" onkeyup="sorSup()" name="sort_data" class="form-control" placeholder="Filter Title...">
                                        </div>
                                    </div>                                                        
                                </div>                                         
                            </div>
                            <div class="table-wrap mt-20">                                                
                                <div class="saving_data" ></div>
                                <div id="load-data"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#config-demos').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        autoUpdateInput: false,
    });
    $('#config-demos').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });
    $('#config-demos').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    $('.applyBtn').on('click', function () {

        var tglaw = $("input[name=daterangepicker_start]").val();
        var tglak = $("input[name=daterangepicker_end]").val();
        var ttg1a = tglaw.split('/');
        var firstDate = ttg1a[2] + '-' + ttg1a[1] + '-' + ttg1a[0];
        var firstDate_ = new Date(ttg1a[2] + '/' + ttg1a[1] + '/' + ttg1a[0]);
        var ttg2a = tglak.split('/');
        var secondDate = ttg2a[2] + '-' + ttg2a[1] + '-' + ttg2a[0];
        var secondDate_ = new Date(ttg2a[2] + '/' + ttg2a[1] + '/' + ttg2a[0]);
        var tglnwx = firstDate + '_' + secondDate;
        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds

        var diffDays = Math.round(Math.round((secondDate_.getTime() - firstDate_.getTime()) / (oneDay)) + 1);
        if (diffDays > 60) {
            $('#pesan_range').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-info-circle mg-r-md"></i>Maks Range 60 hari!</div>');
        } else {
           $("#load-data").load('<?php echo base_url("$url_index") ?>/data?range='+ tglnwx);
        }
        //return true;
    });
    $('.cancelBtn').on('click', function () {
        $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
        //return true;
    });
    $("#load-form").load('<?php echo base_url("$url_index") ?>/form');
    $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
        function paging(e) {
            var s = "paging" + e;
            var ss = s.split("/");
            var sss = ss[1];
            var o = !sss ? 0 : sss;
            var selected = $("input[name=sort_data]").val().replace(" ", "-");
            $("#load-data").load('<?php echo base_url("$url_index") ?>/data/'+ (selected ? selected : 'all')+'/'+ o);
        }

        function sorSup() {
            var selected = $("input[name=sort_data]").val().replace(" ", "-");
            $("#load-data").load('<?php echo base_url("$url_index") ?>/data/' + (selected ? selected : 'all'));
        }
</script>

