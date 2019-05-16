<div class="panel-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <table class="table ">
                <tr>
                    <th style="width: 100px">Price Name</th>
                    <td style="width: 20px">:</td>
                    <td>
                        <?php echo ucwords($dt->pric_name) ?>
                    </td>
                </tr>                
                <tr>
                    <th>Price Currency</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->pric_curency) ? strtoupper($dt->pric_curency) : "-") ?>
                    </td>
                </tr>  
                <tr>
                    <th>Price Nominal</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->pric_nominal) ? $dt->pric_nominal : "-") ?>
                    </td>
                </tr> 
                <tr>
                    <th>Period</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->pric_period) ? $dt->pric_period : "-") ?>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->pric_desc) ? $dt->pric_desc : "-") ?>
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
    $(".modal-title").html('<i class="fa fa-user mr-10"></i>DETAIL PRICING');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-content").html(' ');
        return false;
    }
</script>