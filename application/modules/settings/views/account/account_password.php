<div class="col-lg-6">
    <div class="saving"></div>
    <section class="panel panel-danger">
        <header class="panel-heading"><i class="fa fa-key"></i> Password
            <a role="button" class="cancel pull-right"><i class="fa fa-times"></i></a>
        </header>
        <div class="panel-body">
            <?= form_open('set-account/change-password', array('class' => 'form-horizontal ', 'id' => 'form')); ?>
            <div class="form-group">
                <label class="col-sm-4 control-label">Password Lama</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="password" name="old" class="form-control" placeholder="Password Lama">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Password Baru</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="password" name="new" class="form-control" placeholder="Password Baru">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check mg-r-sm"></i>Perbaharui</button>
                    <a role="button" class="cancel btn btn-warning"><i class="fa fa-times mg-r-sm"></i>Batal</a>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#loader").html('');
        $(".cancel").click(function () {
            $("#message").hide('slow');
            $("#forms").hide('slow');
            $('#prof').load("<?php echo base_url() ?>set-account/content");
            return false;
        });
        $("#form").submit(function () {
            $('input').attr('readonly', 'readonly');
            $('select').attr('readonly', 'readonly');
            $(".saving").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
            $.ajax({
                url: $("#form").attr('action'),
                data: $("#form").serialize(),
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $(".saving").html(json.msg);
                        $('input').removeAttr('readonly', 'readonly');
                        $('select').removeAttr('readonly', 'readonly');
                    } else {
                        $("#message").hide('slow', function () {
                            $("#message").show('slow').html(json.msg);
                            $('#forms').hide('slow', function () {
                                $('#prof').load("<?php echo base_url() ?>set-account/content");
                            });
                        });
                    }
                }
            });
            return false;
        });
    });

</script>