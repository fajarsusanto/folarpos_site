<div class="panel-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <table class="table ">
                <tr>
                    <th style="width: 70px">Name</th>
                    <td style="width: 20px">:</td>
                    <td>
                        <?php echo ucwords($dt->users_fullname) ?>
                    </td>
                </tr>                
                <tr>
                    <th>Mail</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->users_mail) ? $dt->users_mail : "-") ?>
                    </td>
                </tr>  
                <tr>
                    <th>Mail</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->users_phone) ? $dt->users_phone : "-") ?>
                    </td>
                </tr> 
                <tr>
                    <th>Registered</th>
                    <td>:</td>
                    <td>
                        <?php echo (!empty($dt->users_registered) ? $dt->users_registered : "-") ?>
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
    $(".modal-title").html('<i class="fa fa-user mr-10"></i>DETAIL USER');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-content").html(' ');
        return false;
    }
</script>