<div class="panel-body">
    <?php echo form_open("$url_index/save", array('class' => 'form-horizontal', 'id' => 'form-users')); ?>
    <?php if (!empty($dt)) { ?>
        <input type="hidden" name="id" value="<?php echo $dt->gal_id ?>"/>
    <?php } ?>
    <div class="row">
        <div class='col-xs-12'>
            <div class="saving"></div>               
        </div>
        <div class="col-md-6">
            <div class="row">   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Title *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="gal_title" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->gal_title) ?>" class="form-control" placeholder="Title">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Caption *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="gal_caption" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->gal_caption) ?>" class="form-control" placeholder="Caption">
                    </div>
                </div>                     
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="app__user-notif">
                                <label for="upload-gallery" class=" btn btn-sm btn-primary">
                                    <i class="fa fa-camera mg-r-sm" style="font-size: 18px"></i>
                                    <span>Upload</span>
                                </label>
                                <input type="file" onchange="previewImage(this)" id="upload-gallery"/>
                            </span>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-right">
                            <h4><i class="fa fa-desktop mg-r-sm"></i><i>Data Gallery *</i></h4>
                        </div>
                        <div class="col-xs-12 mg-b-sm">
                            <hr style="margin: 0px; padding: 0px"/>
                            <i><small>* Format image supported jpg/png</small></i>
                        </div>
                    </div>
                    <div class="row" id="preview-gallery">
                        <?php
                        if (!empty($dt)) {
                            if (!empty($gal)) {
                                $no = 1;
                                foreach ($gal as $xs => $row_spl) {
                                    if (file_exists($row_spl->gal_dt_photo)) {
                                        ?>
                                        <div class="col-md-6 mg-b-md image-show" id="page-img-<?php echo $no ?>">
                                            <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url($row_spl->gal_dt_photo) ?>">
                                                <div style="height: 120px; width: 100%; overflow: hidden; display: block; border: 4px solid grey">
                                                    <img style="height: 120px; min-width: 100%" src="<?php echo base_url($row_spl->gal_dt_photo) ?>"/>
                                                    <input type="hidden" id="data-img-<?php echo $no ?>" name="gallery[]" value="<?php echo base64_encode_image(base_url($row_spl->gal_dt_photo)) ?>"/>
                                                </div>
                                            </a> 
                                            <input type="hidden" id="gal-id-<?php echo $no ?>"  value="<?php echo ($row_spl->gal_dt_id) ?>" class="form-control mg-t-xs" name="gal_dt_id[]"/>
                                            <input type="hidden" id="gal-status-<?php echo $no ?>" value="1" class="form-control mg-t-xs" name="gal_status[]"/>
                                            <a role="button" id="btn-<?php echo $no ?>" onclick="clearLink(<?php echo $no ?>)" class="btn btn-xs col-xs-12 btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <?php
                                        $no++;
                                    }
                                }
                            }
                        }
                        ?>
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
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-user mr-10"></i>FORM <?php echo $act; ?> GALLERY');
    function close_formum() {
        $(".modal-lg .modal-body").html("");
        $('.modal').modal('hide');
        return false;
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];

            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                fileReader.readAsDataURL(imageFile);
                fileReader.onload = function (e) {
                    var counts = $(".image-show").length + 1;
                    var pages = '<div class="col-md-6 mg-b-md image-show" id="page-img-' + counts + '">'
                            + '<a class="fancybox-buttons" data-fancybox-group="button" href="' + e.target.result + '">'
                            + '<div style="height: 120px; width: 100%; overflow: hidden; display: block; border: 4px solid grey">'
                            + '<img style="height: 120px; min-width: 100%" src="' + e.target.result + '"/>'
                            + '<input type="hidden" id="data-img-' + counts + '" name="gallery[]" value="' + e.target.result + '"/>'
                            + '</div>'
                            + '</a>'
                            + '<input type="hidden" id="gal-status-' + counts + '" class="form-control mg-t-xs" name="gal_status[]" value="1"/>'
                            + '<input type="hidden" id="gal-id-' + counts + '" class="form-control mg-t-xs" name="gal_dt_id[]" value=""/>'
                            + '<a role="button" id="btn-' + counts + '" onclick="clearLink(' + counts + ')" class="btn btn-xs col-xs-12 btn-danger"><i class="fa fa-trash-o"></i></a>'
                            + '</div>';
                    $('#preview-gallery').append(pages);
                    $('#upload-gallery').html('<input type="file" onchange="previewImage(this)"/>');
                }
            } else {
                $('#upload-gallery').html('<input type="file" onchange="previewImage(this)"/>');
                bootbox.alert("<i class='fa fa-info-circle mg-r-md'></i>Image format not support...");
                return false;
            }

        }
    }
    function clearLink(param) {
        if (!$("#gal-id-" + param).val()) {
            $("#page-img-" + param).remove();
            var counts = $(".image-show").length + 1;
            for (var a = param; a < counts; a++) {
                var rz = a + 1;
                $("#btn-" + rz).attr('onclick', "clearLink(" + a + ")");
                $("#btn-" + rz).attr("id", "btn-" + a);
                $("#data-img-" + rz).attr("id", "data-img-" + a);
                $("#page-img-" + rz).attr("id", "page-img-" + a);
                $("#gal-status-" + rz).attr("id", "gal-status-" + a);
                $("#gal-id-" + rz).attr("id", "gal-id-" + a);
            }
        } else {
            $("#gal-status-" + param).val('2');
            $("#gal-caption-" + param).attr("readonly", "readonly");
            $("#btn-" + param).attr("disabled", "disabled");
        }
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
<style>
    .app__user-photo {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        -webkit-transition: -webkit-transform 0.3s 0.2s cubic-bezier(0.62, 0.35, 0.56, 1.55);
        transition: -webkit-transform 0.3s 0.2s cubic-bezier(0.62, 0.35, 0.56, 1.55);
        transition: transform 0.3s 0.2s cubic-bezier(0.62, 0.35, 0.56, 1.55);
        transition: transform 0.3s 0.2s cubic-bezier(0.62, 0.35, 0.56, 1.55), -webkit-transform 0.3s 0.2s cubic-bezier(0.62, 0.35, 0.56, 1.55);
    }
    .app__user-notif {
        /*position: absolute;*/
        right: 0;
        cursor: pointer;
        float: left;
        margin-right: 10px;
    }
    .app__user-notif > label{
        cursor: pointer;
    }
    .app__user-notif > label > i{
        font-size: 40px;
        float: left;
    }
    .app__user-notif > input{
        display: none;
    }
</style>
