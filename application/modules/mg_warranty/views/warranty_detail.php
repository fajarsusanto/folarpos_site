<div class="modal-body">
    <div class="row"> 
        <div class="col-lg-12 col-sm-12 col-xs-12">                 
            <table class="table mg-t-md" >
                <tr>
                    <th style="width: 10%">Name</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->war_name) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Caption</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->war_caption) ?> 
                    </td>
                </tr>
                <tr>
                    <th style="width: 10%">Position</th>
                    <td style="width: 2%">:</td>
                    <td>
                        <?php echo ucwords($dt->war_post) ?> 
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12 mg-b-md">
            <div class="row">
                <img class="col-xs-12" style="border-radius: 7%;width: 30%" src="<?php echo base_url(!empty($dt->war_icon) ? (file_exists($dt->war_icon) ? $dt->war_icon : "assets-ds/square.jpg") : "assets-ds/square.jpg") ?>"/>
            </div>
        </div>
        <div class="col-sm-12 col-xs-12 mg-t-xs" style="padding-top: 20px;">
            <button type="button" onclick="closeForm()" class="cancel btn btn-danger btn-sm col-xs-12 mg-t-sm"><i class="fa fa-times mr-10"></i>Exit</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-th-large mr-10"></i>DETAIL WARRANTY');
    function closeForm() {
        $('.modal').modal('hide');
        $("#modal-contents").html(' ');
        return false;
    }
</script>
