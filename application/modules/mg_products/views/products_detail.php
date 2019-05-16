<div class="panel-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 mg-b-md">
            <div class="row">
                <img class="col-xs-12" style="border-radius: 7% " src="<?php echo !empty($dt->prod_icon) ? (file_exists($dt->prod_icon) ? base_url($dt->prod_icon) : "assets-ds/square.jpg") : "assets-ds/square.jpg" ?>"/>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <table class="table ">
                <tr>
                    <th style="width: 100px">Products Name</th>
                    <td style="width: 20px">:</td>
                    <td>
                        <?php echo ucwords($dt->prod_name) ?>
                    </td>
                </tr>                
                <tr>
                    <th>Caption</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->prod_caption) ? $dt->prod_caption : "-") ?>
                    </td>
                </tr>  
                <tr>
                    <th>Demo</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->prod_demo) ? $dt->prod_demo : "-") ?>
                    </td>
                </tr> 
                <tr>
                    <th>Keyword</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->prod_keyword) ? $dt->prod_keyword : "-") ?>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->prod_desc) ? $dt->prod_desc : "-") ?>
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
    $(".modal-title").html('<i class="fa fa-user mr-10"></i>DETAIL PRODUCT');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-content").html(' ');
        return false;
    }
</script>