<div class="row">
    <?php echo form_open('dash-v/set-reminder/save', array('class' => 'form-horizontal', 'id' => 'form-interval-set')); ?>
    <div class="col-xs-12">
        <div class="input-group mb-10">
            <span class="input-group-addon"><i class="fa fa-calendar-o mr-10"></i>Days</span>
            <input type="number" maxlength="24" name="apps_interval" value="<?php echo (!empty($sess['app']->apps_interval)) ? $sess['app']->apps_interval : 1; ?>" class="form-control" placeholder="">
        </div>
    </div>
    <div class="col-xs-6 mg-t-xs">
        <button type="button" onclick="closeForm()" class="btn btn-sm btn-danger col-xs-12"><i class="fa fa-times mr-10"></i>Cancel</button>
    </div>
    <div class="col-xs-6 mg-t-xs">
        <button type="submit" class="btn btn-sm btn-primary col-xs-12"><i class="fa fa-check  mr-10"></i>Save</button>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $(".modal-sm #mySmallModalLabel").html('<i class="fa fa-gears mr-10"></i>SET REMINDER');
    $("#form-interval-set").submit(function () {
        $.ajax({
            url: $("#form-interval-set").attr('action'),
            data: $("#form-interval-set").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                closeForm();
            }
        });
        return false;
    });
    function closeForm() {
        $(".modal-sm .modal-body").html("");
        $('.modal').modal('hide');
        return false;
    }
</script>