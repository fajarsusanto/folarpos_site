<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div id="load-form" class="row"><div class="loader mg-t"><i class="fa fa-refresh fa-spin mr-10"></i> Loading form. Please wait...</div></div>
    </div>

    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title txt-dark"><i class="fa fa-th-large mr-10"></i> DATA TESTIMONY</h6>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">                                           
                            <div class="add-event-wrap">
                                <div class="row">
                                    <div class="col-lg-12 mg-b-sm">
                                        <div class="input-group">
                                            <span class="input-group-addon bg-default"><i class="fa fa-search text-white"></i></span>
                                            <input type="text" onkeyup="sorSup()" name="sort_data" class="form-control" placeholder="Filter Testimony...">
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
    $("#load-form").load('<?php echo base_url("$url_index") ?>/form');
    $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
        function paging(e) {
            var s = "paging" + e;
            var ss = s.split("/");
            var sss = ss[1];
            var o = !sss ? 0 : sss;
            var selected = $("input[name=sort_data]").val().replace(" ", "-");
            $("#load-data").load('<?php echo base_url("$url_index") ?>/data/' + (selected ? selected : 'all')+'/'+ o);
        }

        function sorSup() {
            var selected = $("input[name=sort_data]").val().replace(" ", "-");
            $("#load-data").load('<?php echo base_url("$url_index") ?>/data/' + (selected ? selected : 'all'));

        }
</script>

