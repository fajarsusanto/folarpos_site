<div class="modal-body">
    <div class="row"> 
        <div class="col-lg-12 col-sm-12 col-xs-12">                 
            <table class="table mg-t-md" >
                <tr>
                    <th style="width: 10%">Name</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->testi_name) ?> <hr style="padding:0px; margin:0px; padding-bottom:5px;"> <b class="label label-default"><?php echo ucwords($dt->prod_name) ?></b>
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Caption</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->testi_caption) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Date</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo indo_date($dt->testi_date,1,1) ?> 
                    </td>
                </tr>
                <?php if (!empty($dt->testi_desc)) { ?>
                    <tr>   
                        <th style="width: 10%">Description</th>
                        <td style="width: 2%">:</td>
                        <td>
                            <?php echo ucwords($dt->testi_desc) ?>
                        </td>                    
                    </tr>        
                <?php } ?>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12 mg-b-md">
            <div class="row">
                <img class="col-xs-12" style="border-radius: 7%; width:30%" src="<?php echo base_url(!empty($dt->testi_photo) ? (file_exists($dt->testi_photo) ? $dt->testi_photo : "assets-ds/square.jpg") : "assets-ds/square.jpg") ?>"/>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 mg-t-xs" style="padding-top: 20px;">
            <button type="button" onclick="closeForm()" class="cancel btn btn-danger btn-sm col-xs-12 mg-t-sm"><i class="fa fa-times mr-10"></i>Exit</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-th-large mr-10"></i>DETAIL TESTIMONY');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-contents").html(' ');
        return false;
    }
</script>
