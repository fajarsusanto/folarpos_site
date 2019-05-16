<div class="panel-body">

    <?php echo form_open("$url_index/save", array('class' => 'form-horizontal', 'id' => 'form-users')); ?>
    <?php if (!empty($dt)) { ?>
        <input type="hidden" name="id" value="<?php echo $dt->users_id ?>"/>
    <?php } ?>
    <div class="row">
        <div class='col-xs-12'>
            <div class="saving"></div>               
        </div>
        <div class="col-md-6">
            <div class="row">   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Fullname *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="fullname" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->users_fullname) ?>" class="form-control" placeholder="Fullname">
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Email *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span>
                        <input type="email" name="mail" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->users_mail) ?>" class="form-control" placeholder="Email">
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Phone *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                        <input type="text" onkeydown="number(this)" name="phone" value="<?php echo empty($dt) ? null : ucwords($dt->users_phone) ?>" class="form-control" placeholder="Phone">
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <h4><i class="fa fa-desktop mr-10"></i><i>Access System</i></h4>
                    <hr style="margin: 0px; padding: 0px"/>
                    <small style="font-size:11px"><i>If the employee is not allowed system access, please empty the account data below !</i></small>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-10">
                    <label>Password *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                        <input type="password" name="password" minlength="6" value="<?php echo empty($dt) ? null : $dt->users_password ?>" class="form-control" placeholder="Min 6 Character">
                    </div>
                </div>


            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mg-b-lg">
            <div class="app__user-notif a-bit-down">
                <label for="file-input" >                            
                    <div id="showpict" class="form-control file-input text-center" style="float:right; overflow: hidden; height: 160px; border: 3px solid grey; width: 96%; margin-left: 15px; margin-bottom: 15px; cursor:pointer;">
                        <?php echo empty($dt) ? null : (!empty($dt->users_photo) ? '<img style="width: 100%; min-height: 100%; margin-top: 0px; margin-left: 0px;" src="' . base_url($dt->users_photo) . '">' : null ) ?><?php if (empty($dt->users_photo)) { ?><i class="fa fa-camera" style="font-size:85px; margin-top:15px;"></i><br>Upload File<hr style="margin:0px; padding:0px"/><small style="color: red"><i>Maks. 500 KB !</i></small><?php } ?>
                    </div>  

                </label>
                <input type="file"  id="file-input" />
                <input type="hidden" class="form-control" name="file" value=""/>                        
            </div> 
            <div style="margin-top:-10px;">
                <div class="msg-upload"></div>
                <a role='button' onclick='rePreview()' id="clear_image" class='btn btn-xs btn-danger' ><i class='fa fa-times'></i></a>  
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
                    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-user mr-10"></i>FORM <?php echo $act; ?> USER');
                    function close_formum() {
                        $(".modal-lg .modal-body").html("");
                        $('.modal').modal('hide');
                        return false;
                    }
                    
                    $(document).on('change', '#file-input', function () {

                        var input = this;
                        if (input.files && input.files[0]) {
                            var fileReader = new FileReader();
                            var imageFile = input.files[0];
                            var imageSize = imageFile.size / 1048576;

                            if (imageFile.type == "image/jpeg" || imageFile.type == "image/png" || imageFile.type == "image/jpg") {
                                if (imageSize > 0.5) {
                                    $("input[type=file]").val('');
                                    $(".msg-upload").html('<small style="margin: 0px 0px 10px 0px; color: red"><i class="fa fa-warning text-danger" style="margin-right: 10px"></i>Ukuran gambar tidak boleh melebihi dari 500 KB !</small>');
                                    return false;
                                } else {
                                    $(".a-bit-down").removeAttr("style", "margin-left:-5px;");
                                    fileReader.readAsDataURL(imageFile);
                                    fileReader.onload = function (e) {
                                        $("input[name=file]").val(e.target.result);
                                        $("#clear_image").show();
                                        $(".a-bit-down").attr("style", "margin-left:-15px;");
                                        $(".msg-upload").html("");
                                        $("#showpict").html("<img src='" + e.target.result + "' class='col-xs-12' style='min-width: 100%; min-height: 100%; margin-top: 0px; margin-left: 0px;'/>");

                                    }


                                }
                            } else {
                                $("input[type=file]").val('');
                                $(".msg-upload").html('<small style="margin: 0px 0px 10px 0px; color: red"><i class="fa fa-warning text-danger" style="margin-right: 10px"></i>File yang diperbolehkan hanya berformat JPG, JPEG, PNG !</small>');
                                return false;
                            }

                        }
                    });

                    function rePreview() {
                        $(document).ready(function () {
                            $("#showpict").html('<i class="fa fa-camera" style="font-size:85px; margin-top:30px;"></i>');
                            $("input[name=file]").val('');
                            $("input[type=file]").val('');
                            $("#clear_image").hide();
                            $(".msg-upload").html("");
                            $(".a-bit-down").removeAttr("style", "margin-left:-15px;");
                            $(".a-bit-down").attr("style", "margin-left:-5px;");
                        });
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
