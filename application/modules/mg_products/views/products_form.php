<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
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
<div class="panel-body">
    <?php echo form_open_multipart("$url_index/save", array('class' => 'form-horizontal', 'id' => 'form-users')); ?>
    <?php if (!empty($dt)) { ?>
        <input type="hidden" name="id" value="<?php echo $dt->prod_id ?>"/>
    <?php } ?>
    <div class="row">
        <div class='col-xs-12'>
            <div class="saving"></div>               
        </div>
        <div class="row">
            <div class='col-xs-6'>
                <div style="overflow: hidden; height: 135px; border: 3px solid grey; width: 96%; margin-left: 15px; margin-bottom: 15px;">
                    <a class="fancybox-buttons fancybox-photo" data-fancybox-group="button" href="<?php echo (!empty($dt->prod_icon) ? (file_exists($dt->prod_icon) ? (base_url($dt->prod_icon)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">
                        <img id="preview-photo" style="width: 100%; min-height: 100%; margin-top: 0px; margin-left: 0px" src="<?php echo (!empty($dt->prod_icon) ? (file_exists($dt->prod_icon) ? (base_url($dt->prod_icon)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">    
                    </a>
                </div>
            </div>
            <div class="col-xs-6">
                <span class="app__user-notif mt-20">
                    <div class="row" style="border-left: 3px dotted black; height:95px;">
                        <label for="photo-input" style="font-size:12px; margin-left: 20px;">
                            <i class="fa fa-cloud-upload mr-10" style="font-size:35px; cursor: pointer"></i>
                            <span>Upload Icon .jpg *<br/><small><i>Compress your icon *</i></small></span>
                        </label>
                    </div>
                    <input type="file" id="photo-input"/>
                    <input type="hidden" name="file_header" value='<?php echo (!empty($dt->prod_icon) ? base64_encode_image(base_url($dt->prod_icon)) : null) ?>'/>
                </span>
                <div class="row">
                    <span class="msg-photo col-xs-12"></span>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                <label>Name *</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input type="text" name="prod_name" maxlength="150" value="<?php echo empty($dt) ? null : ucwords($dt->prod_name) ?>" class="form-control" placeholder="Products Name">
                </div>
            </div>
        </div>
        <div class="col-md-6">                 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Caption *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="prod_caption" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->prod_caption) ?>" class="form-control" placeholder="Caption">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                    <label>Demo *</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="prod_demo" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->prod_demo) ?>" class="form-control" placeholder="Demo">
                    </div>
                </div>
                <div class='col-xs-12'>
                    <div class="form-group">
                        <label>Features *</label>
                        <div class="input-group">
                            <span class=""></span>
                            <textarea id="elm1" class="form-control" name="prod_features" placeholder="Features"><?php echo empty($dt) ? null : ucwords($dt->prod_features); ?></textarea>
                        </div>                    
                    </div>
                </div>
        </div>
        <div class="col-md-6">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                <label>Keyword *</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input type="text" name="prod_keyword" maxlength="150" value="<?php echo empty($dt) ? null : strtolower($dt->prod_keyword) ?>" class="form-control" placeholder="Keyword">
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                <label>Position *</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                    <input type="text" onkeydown="number(this)" name="prod_post" value="<?php echo empty($dt) ? null : ucwords($dt->prod_post) ?>" class="form-control" placeholder="Position">
                </div>
            </div>
            <div class='col-xs-12'>
                <div class="form-group">
                    <label>Description *</label>
                    <div class="input-group">
                        <span class=""></span>
                        <textarea id="elm1" class="form-control" name="prod_desc" placeholder="Description"><?php echo empty($dt) ? null : ucwords($dt->prod_desc); ?></textarea>
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
    $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-user mr-10"></i>FORM <?php echo $act; ?> PRODUCTS');
    function close_formum() {
        $(".modal-lg .modal-body").html("");
        $('.modal').modal('hide');
        return false;
    }

    document.getElementById("photo-input").onchange = function () {
        var input = this;
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];
            var imageSize = imageFile.size / 1048576;
            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                if (imageSize > 0.8) {
                    $("input[name=file_header]").val('');
                    $(".msg-photo").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Image size can not exceed 800 KB !</i></p>');
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
    .notif-today {
        animation: blink-animation 1s steps(9, start) infinite;
        -webkit-animation: blink-animation 1s steps(9, start) infinite;
    }
    @keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
    @-webkit-keyframes blink-animation {
        to {
            visibility: hidden;
        }
    }
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
        font-size: 60px;
        float: left;
    }
    .app__user-notif > input{
        display: none;
    }
</style>
