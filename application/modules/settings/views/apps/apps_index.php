<div class="row">
    <div id="load-data" class="col-xs-12">
        <center><i class="fa fa-refresh fa-spin mg-r-md"></i>Loading data. Please wait...</center>
    </div>
</div>
<script>
    $("#load-data").load('<?php echo base_url($url_index) ?>-data');
    
</script>