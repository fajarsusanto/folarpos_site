<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
<div class="panel-body">
    <?php echo form_open("$url_index/save", array('class' => 'form-horizontal', 'id' => 'form-users')); ?>
    <?php if (!empty($dt)) { ?>
        <input type="hidden" name="id" value="<?php echo $dt->pric_id ?>"/>
    <?php } ?>
    <div class="row">
        <div class='col-xs-12'>
            <div class="saving"></div>               
        </div>
        <div class="col-md-6">
            <div class="row">   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Name *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="pric_name" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->pric_name) ?>" class="form-control" placeholder="Price Name">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Currency *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <select name="pric_curency" class="reseter-option" data-placeholder="Currency" data-style="btn-white">
                            <option value="idr" <?php echo empty($dt) ? null : ($dt->pric_curency == 'idr' ? 'selected' : NULL) ?>>IDR</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Nominal *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="pric_nominal" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->pric_nominal) ?>" class="form-control" placeholder="Price Nominal">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">  
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Period *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <select name="pric_period" class="reseter-option" data-placeholder="Period" data-style="btn-white">
                            <option value="day" <?php echo empty($dt) ? null : ($dt->pric_period == 'day' ? 'selected' : NULL) ?>>Day</option>
                            <option value="month" <?php echo empty($dt) ? null : ($dt->pric_period == 'month' ? 'selected' : NULL) ?>>Month</option>                            
                            <option value="year" <?php echo empty($dt) ? null : ($dt->pric_period == 'year' ? 'selected' : NULL) ?>>Year</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Description *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="pric_desc" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->pric_desc) ?>" class="form-control" placeholder="Split with (,)">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-20">
        <?php if (!empty($dt)) { ?>
            <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <a role="button" style="cursor: pointer" onclick="close_formum()" class="btn btn-danger btn-anim col-xs-12"><i class="fa  fa-times"></i><span class="btn-text"> Cancel</span></a>
            </div>
        <?php } ?>
        <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
            <button type="submit" class="btn btn-success btn-anim col-xs-12"><i class="icon-rocket"></i><span class="btn-text"> Save</span></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $('.reseter-option').selectize();
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-user mr-10"></i>FORM <?php echo $act; ?> PRICE');
    function close_formum() {
        $(".modal-lg .modal-body").html("");
        $('.modal').modal('hide');
        return false;
    }
    $("#form-users").submit(function () {
        $('input').attr('readonly', 'readonly');
        $('select').attr('readonly', 'readonly');
        $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mr-10"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#form-users").attr('action'),
            data: $("#form-users").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                } else {
                    close_formum();
                    sorUs();
                }
                $('input').removeAttr('readonly', 'readonly');
                $('select').removeAttr('readonly', 'readonly');
            }
        });
        return false;
    });
</script>
<style>   
    .app__user-notif > input{
        display: none;
    }  

</style>
