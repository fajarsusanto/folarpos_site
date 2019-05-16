<div class="modal-body">
    <div class="row"> 
        <div class="col-lg-12 col-sm-12 col-xs-12">                 
            <table class="table mg-t-md" >
                <tr>
                    <th style="width: 10%">Name</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->subs_name) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Phone</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->subs_phone) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Mail</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->subs_mail) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Company</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->subs_company) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Date</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo indo_date($dt->subs_date) ?>  
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-12 col-xs-12 mg-t-xs" style="padding-top: 20px;">
            <button type="button" onclick="closeForm()" class="cancel btn btn-danger btn-sm col-xs-12 mg-t-sm"><i class="fa fa-times mr-10"></i>Exit</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-th-large mr-10"></i>DETAIL SUBSCRIBES');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-contents").html(' ');
        return false;
    }
</script>
