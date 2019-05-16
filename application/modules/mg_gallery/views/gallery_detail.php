<div class="panel-body">
    <div class="row">
        <?php if (!empty($dt_)) {
            foreach ($dt_ as $k => $val) { ?>
                <div class="col-lg-6 col-sm-12 col-xs-6 mg-b-md">
                    <div class="row">
                        <img class="col-xs-12" style="height: 200px " src="<?php echo base_url(!empty($val->gal_dt_photo) ? (file_exists($val->gal_dt_photo) ? $val->gal_dt_photo : "assets-ds/square.jpg") : "assets-ds/square.jpg") ?>"/>
                    </div>
                </div>
            <?php }
        } ?>        
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <table class="table ">
                <tr>
                    <th style="width: 100px">Title</th>
                    <td style="width: 20px">:</td>
                    <td>
                    <?php echo ucwords($dt->gal_title) ?>
                    </td>
                </tr>                
                <tr>
                    <th>Caption</th>
                    <td>:</td>
                    <td>
                    <?php echo (!empty($dt->gal_caption) ? $dt->gal_caption : "-") ?>
                    </td>
                </tr>  
                <tr>
                    <th>Date</th>
                    <td>:</td>
                    <td>
                    <?php echo indo_date($dt->gal_date,1,1) ?>
                    </td>
                </tr>  
            </table>
        </div>
        <div class="col-sm-12 col-xs-6">
            <button type="button" onclick="closeForm()" class="cancel btn btn-danger btn-sm col-xs-12 mg-t-sm"><i class="fa fa-times mr-10"></i>Exit</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-title").html('<i class="fa fa-user mr-10"></i>DETAIL GALLERY');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-content").html(' ');
        return false;
    }
</script>