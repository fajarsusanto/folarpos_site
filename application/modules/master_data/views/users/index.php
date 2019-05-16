<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
<div class="loadertab"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mr-10"></i> Loading data. Please wait...</div></div> 

<div class="row deliksek">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title txt-dark"><b style="margin: 0px"><i class="fa fa-users mr-10"></i> DATA USERS</b></h6>

        </div>
        <div class="panel-wrapper collapse in">

            <div class="panel-body">                                           
                <div class="add-event-wrap">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 mg-b-sm">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon bg-default"><i id="loading_search"></i></span>
                                <input type="text" onkeyup="sorUs('input')" name="sort_data" class="form-control" placeholder="Filter Data Users... ( Name )">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                            <table class="no-border">
                                <tr>
                                    <td>
                                        <span style="margin: 0px; padding: 0px; margin-right: 10px; font-size: 30px" id="count-usr"></span>
                                    </td>
                                    <td><small style="color: grey">Users<hr style="margin: 0px; padding: 0px"/>Registered</small></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mg-b-sm hidden-xs">
                            <button type="button" onclick="actionCtrMaster('add')" class="btn btn-success col-xs-12" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus mr-10"></i> ADD USERS</button>
                        </div> 

                    </div>                                         
                </div>
                <div class="table-wrap mt-20">                                                
                    <div class="saving_notif" ></div>
                    <div id="load-data" ></div>
                </div>
            </div>
        </div>
    </div>



</div>
<script>
    sorUs();
    $('.reseter-option-index').selectize();
    $(".deliksek").attr('style', 'display:none;');
    function paging(e) {
        var s = "paging" + e;
        var ss = s.split("/");
        var sss = ss[1];

        var o = !sss ? 0 : sss;
        var selected = $("input[name=sort_data]").val().replace(" ", "-");
        var role = $("select[name=roles] option:selected").val();

        $("#load-data").load('<?php echo base_url($url_index) ?>/data/' + (!selected ? "all" : selected) + '/' + o);
    }
    function spining(r) {
        var selected = $("input[name=sort_data]").val().replace(" ", "-");
        var role = $("select[name=roles] option:selected").val();
        if (r == 'input') {
            if (!selected) {
                $("#loading_search").attr("class", "fa fa-search text-white");
            } else {
                $("#loading_search").removeAttr("class", "fa fa-search text-white");
                $("#loading_search").attr("class", "fa fa fa-spin fa-refresh text-white");
            }
        }
        if (r == 'select') {
            if (!role) {
                $("#loading_search_role").attr("class", "fa fa-search text-white");
            } else {
                $("#loading_search_role").removeAttr("class", "fa fa-search text-white");
                $("#loading_search_role").attr("class", "fa fa fa-spin fa-refresh text-white");
            }
        }
    }
    function sorUs(se) {
        var selected = $("input[name=sort_data]").val().replace(" ", "-");
        var role = $("select[name=roles] option:selected").val();
        spining(se);
        $("#load-data").load('<?php echo base_url($url_index) ?>/data/' + (!selected ? "all" : selected));

    }
</script>