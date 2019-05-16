<div class="col-lg-8">
    <div class="saving"></div>
    <section class="panel panel-warning">
        <header class="panel-heading"><i class="fa fa-user mg-r-sm"></i> Profile
            <a role="button" class="cancel pull-right"><i class="fa fa-times"></i></a>
        </header>
        <div class="panel-body">
            <?php echo form_open('set-account/save', array('class' => 'form-horizontal row', 'id' => 'form')); ?>
            <div class="col-sm-6 mg-b-sm">
                <label>Nama</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="us_name" value="<?php echo $sess['users']->users_fullname ?>" class="form-control" placeholder="Nama Lengkap">
                </div>
            </div>
            <div class="col-sm-6 mg-b-sm">
                <label>Email</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="mail" value="<?php echo $sess['users']->users_mail ?>" class="form-control" placeholder="Email">
                </div>
            </div> 
            <div class="col-sm-6 mg-b-sm">
                <label>Handphone</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="text" name="phone" maxlength="16" value="<?php echo $sess['users']->users_phone ?>" class="form-control" placeholder="Hanphone">
                </div>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check mg-r-sm"></i>Perbaharui</button>
                <a role="button" class="cancel btn btn-warning"><i class="fa fa-times mg-r-sm"></i>Batal</a>
                <a role="button" id="foto" class="btn btn-danger pull-right"><i class="fa fa-upload mg-r-sm"></i> Upload Foto</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
</div>
<div class="col-lg-4 " id="ganti-foto">
    <section class="panel panel-dark">
        <header class="panel-heading"><i class="fa fa-camera mg-r-sm"></i> Photo Account</header>
        <div class="panel-body">
            <?php echo form_open('set-account/upload-photo', array("enctype" => "multipart/form-data", 'class' => 'form-horizontal row')); ?>
            <div class="col-sm-12">
                <input type="file" name="foto">
                <p class="help-block">Maksimal upload 1MB</p>
            </div>
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary"><i class="fa fa-upload mg-r-sm"></i>Upload</button>
                <button onclick="action_control_sub('close')" class="btn btn-warning"><i class="fa fa-times mg-r-sm"></i>Batal</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>
    <?php if (!empty($sess['users']->users_photo)) { ?>
        <button type="button" class="col-sm-12 btn btn-danger" id="removeph"><i class="fa fa-times"></i>&nbsp;&nbsp;Hapus Foto</button>
    <?php } ?>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#loader").html('');
        $("#ganti-foto").hide();
        $(".cancel").click(function () {
            $("#message").hide('slow');
            $("#forms").hide('slow');
            $('#prof').load("<?php echo base_url() ?>set-account/content");
            return false;
        });
        $("#foto").click(function () {
            $("#ganti-foto").show('slow');
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
                        $('#forms').hide('slow', function () {
                            $("#fulnm").html(json.name);
                            $("#mailusr").html(json.mail);
                            $("#message").hide('slow');
                            $('#prof').load("<?php echo base_url() ?>set-account/content");
                        });
                    }
                }
            });
            return false;
        });
        $("#removeph").on('click', function () {
            $.ajax({
                url: "<?php echo base_url() ?>set-account/del-photo",
                data: 'forlck',
                type: "POST",
                dataType: "JSON",
                success: function (json) {
                    if (json.status == 0) {
                        $("#message").show('slow');
                        $("#message").html(json.msg);
                    } else {
                        $('#forms').hide('slow', function () {
                            window.location.href = "<?php echo base_url() ?>set-account";
                        });
                    }
                }
            });
            return false;
        });
    });
    function action_control_sub(el) {
        if (el == 'close') {
            $("#ganti-foto").hide('slow');
            return false;
        }
    }
</script>