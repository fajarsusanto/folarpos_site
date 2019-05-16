<div class="modal-body">
    <div class="row"> 
        <div class="col-lg-12 col-sm-12 col-xs-12">                 
            <table class="table mg-t-md" >
                <tr>
                    <th style="width: 20%">Date</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo indo_date($dt->referral_date,1,1) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Referral Name</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->referral_name) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Referral E-Mail</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_mail) ?>  
                    </td>
                </tr>
                
                <tr>
                    <th style="width: 10%">Referral Phone</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_phone) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Client Name</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_client_name) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Client Busines</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_client_bisnis) ?> / <?php echo ucwords($dt->referral_client_type_bisnis) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Client Phone</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_client_phone) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Client E-Mail</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_client_mail) ?>  
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Client Information</th>
                    <td style="width: 2%">:</td>
                    <td>
                       <?php echo ucwords($dt->referral_client_info) ?>  
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
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-th-large mr-10"></i>DETAIL REFERRAL');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-contents").html(' ');
        return false;
    }
</script>
