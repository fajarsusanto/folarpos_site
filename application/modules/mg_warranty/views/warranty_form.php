<script src="<?php echo base_url() ?>tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: "textarea#elm1",
        theme: "modern",
        height: 450,
        subfolder: "content",
        relative_urls: false,
        plugins: [
            "advlist autolink link image lists charmap preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor filemanager"
        ],
        content_css: "css/content.css",
        image_advtab: true,
        toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink image | media fullpage | forecolor backcolor",
        style_formats: [
            {title: 'H1', block: 'h1'},
            {title: 'H2', block: 'h2'},
            {title: 'H3', block: 'h3'},
            {title: 'H4', block: 'h4'},
            {title: 'H5', block: 'h5'},
        ]
    });
</script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title txt-dark"><b style="margin: 0px"><i class='fa <?php echo $act == 'EDIT' ? 'fa-pencil' : 'fa-plus'; ?> mr-10'></i> <?php echo $act; ?> WARRANTY</b></h6>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-wrap">
                        <div class="savingit"></div>
                        <?php echo form_open("$url_index/save", array('id' => 'formsit')); ?>
                        <?php if (!empty($dt)) { ?>
                            <input type="hidden" name="id" value="<?php echo $dt->war_id ?>"/>
                        <?php } ?>
                        <div class="row">   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="row">
                                        <div class='col-xs-6'>
                                            <div style="overflow: hidden; height: 135px; border: 3px solid grey; width: 96%; margin-left: 15px; margin-bottom: 15px;">
                                                <a class="fancybox-buttons fancybox-photo" data-fancybox-group="button" href="<?php echo (!empty($dt->war_icon) ? (file_exists($dt->war_icon) ? (base_url($dt->war_icon)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">
                                                    <img id="preview-photo" style="width: 100%; min-height: 100%; margin-top: 0px; margin-left: 0px" src="<?php echo (!empty($dt->war_icon) ? (file_exists($dt->war_icon) ? (base_url($dt->war_icon)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">    
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <span class="app__user-notif mt-20">
                                                <div class="row" style="border-left: 3px dotted black; height:95px;">
                                                    <label for="photo-input" style="font-size:12px; margin-left: 20px;">
                                                        <i class="fa fa-cloud-upload mr-10" style="font-size:35px; cursor: pointer"></i>
                                                        <span>Upload icon .png *<br/><small><i>Compress your icon</i></small></span>
                                                    </label>
                                                </div>
                                                <input type="file" id="photo-input"/>
                                                <input type="hidden" name="file_header" value='<?php echo (!empty($dt->war_icon) ? base64_encode_image(base_url($dt->war_icon)) : null) ?>'/>
                                            </span>
                                            <div class="row">
                                                <span class="msg-photo col-xs-12"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='col-xs-12 mg-t-md'>
                                        <div class="form-group">
                                            <label>Warranty Name *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                <input type="text" name="war_name" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->war_name) ?>" class="form-control" placeholder="Warranty Name">
                                            </div>                    
                                        </div>
                                    </div>              
                                    <div class='col-xs-12 mg-t-md'>
                                        <div class="form-group">
                                            <label>Warranty Caption *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                <input type="text" name="war_caption" maxlength="150" value="<?php echo empty($dt) ? null : $dt->war_caption ?>" class="form-control" placeholder="Caption">
                                            </div>                    
                                        </div>
                                    </div>
                                    <div class='col-xs-12 mg-t-md'>
                                        <div class="form-group">
                                            <label>Warranty Position *</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                                <input type="text" onkeyup="number(this)" name="war_post" maxlength="150" value="<?php echo empty($dt) ? null : $dt->war_post ?>" class="form-control" placeholder="Position">
                                            </div>                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 mg-t-md">
                                <a role="button" style="cursor: pointer" onclick="close_form()" class="btn btn-danger btn-anim col-xs-12"><i class="fa fa-times mr-10"></i><span class="btn-text"> Cancel</span></a>
                            </div>
                            <div class="col-xs-6 mg-t-md">
                                <button type="submit" class="btn btn-success btn-anim col-xs-12"><i class="icon-rocket"></i><span class="btn-text"> Save</span></button>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("photo-input").onchange = function () {
        var input = this;
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];
            var imageSize = imageFile.size / 1048576;
            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                if (imageSize > 0.5) {
                    $("input[name=file_header]").val('');
                    $(".msg-photo").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Image size can not exceed 500 KB !</i></p>');
                    return false;
                } else {
                    fileReader.readAsDataURL(imageFile);
                    fileReader.onload = function (e) {
                        $('a.fancybox-photo').attr("href", e.target.result);
                        $('#preview-photo').attr("src", e.target.result);
                        $("input[name=file_header]").val(e.target.result);
                        $(".msg-photo").html('');
                    }
                }
            } else {
                $("input[name=file_header]").val('');
                $(".msg-photo").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Allowed image formats only jpg / png !</i></p>');
                return false;
            }
        }
    };
    function rePreview() {
        $(".preview-upload").html("");
        $("input[name=file_header]").val('');
    }
    $("#formsit").submit(function () {
        $('input').attr('readonly', 'readonly');
        $('textarea').attr('readonly', 'readonly');
        $(".savingit").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mr-10"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#formsit").attr('action'),
            data: $("#formsit").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".savingit").html(json.msg);
                } else {
                    $(".saving_notif").html(json.msg);
                    $("#load-form").load('<?php echo base_url("$url_index") ?>/form');
                    $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
                }
                $('input').removeAttr('readonly', 'readonly');
                $('textarea').removeAttr('readonly', 'readonly');
            }
        });
        return false;

    });
    function close_form(){
         $("#load-form").load('<?php echo base_url("$url_index") ?>/form');
    }
</script>
<style>
    .app__user-notif > label{
        cursor: pointer;
    }
    .app__user-notif > input{
        display: none;
    }
</style>