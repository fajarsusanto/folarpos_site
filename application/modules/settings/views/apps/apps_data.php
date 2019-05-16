<script src="<?php echo base_url() ?>assets-ds/select-master/dist/js/standalone/selectize.js"></script>
<script src="<?php echo base_url() ?>tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: "textarea#elm1",
        theme: "modern",
        height: 100,
        menubar: false,
        plugins: [
            'advlist autolink lists link  anchor',
            ' code',
            'contextmenu paste'
        ],
        toolbar: 'bold italic | styleselect | alignleft aligncenter alignright alignjustify | bullist numlist | link | code ',
        content_css: "css/content.css",
        style_formats: [
            {title: 'H1', block: 'h1'},
            {title: 'H2', block: 'h2'},
            {title: 'H3', block: 'h3'},
            {title: 'H4', block: 'h4'},
            {title: 'H5', block: 'h5'},
        ]
    });
</script>
<div class="row">
    <div>
        <div class="saving-sys"><?php echo $this->session->flashdata('msgsys'); ?></div>
        <form role="form" id="form-sys" method="post" action="<?php echo base_url('dash-v/apps-update') ?>">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <div class="row">
                        <div class="col-sm-12 mb-10 ">
                            <div class="row">
                                <div class='col-xs-6'>
                                    <div>
                                        <a class="fancybox-buttons fancybox-logo" data-fancybox-group="button" href="<?php echo (!empty($sess['app']->apps_logo) ? (file_exists($sess['app']->apps_logo) ? (base_url($sess['app']->apps_logo)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">
                                            <img id="preview-logo" style="height: 250px; border-right: 3px grey dotted; padding-bottom: 20px; padding-left: 20px; padding-right: 30px" src="<?php echo (!empty($sess['app']->apps_logo) ? (file_exists($sess['app']->apps_logo) ? (base_url($sess['app']->apps_logo)) : base_url("assets-ds/square.jpg")) : base_url("assets-ds/square.jpg")) ?>">    
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <span class="app__user-notif mt-20">
                                        <div class="row">
                                            <label for="logo-input" style="font-size:12px">
                                                <i class="fa fa-cloud-upload mr-10" style="font-size:35px; cursor: pointer"></i>
                                                <span>Upload Logo .png *<br/><small><i>Compress your logo</i></small></span>
                                            </label>
                                        </div>
                                        <input type="file" id="logo-input"/>
                                        <input type="hidden" name="logo" value='<?php echo (!empty($sess['app']->apps_logo) ? base64_encode_image(base_url($sess['app']->apps_logo)) : null) ?>'/>
                                    </span>
                                    <div class="row">
                                        <span class="msg-logo col-xs-12"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Apps Name *</label>
                            <input type="text" maxlength="24" name="apps_name" value="<?php echo (!empty($sess['app']->apps_name)) ? $sess['app']->apps_name : null; ?>" class="form-control" placeholder="Nama Sistem. Max 24 Character ">
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Apps Head *</label>
                            <input type="text" name="apps_head" value="<?php echo (!empty($sess['app']->apps_head)) ? $sess['app']->apps_head : null; ?>" class="form-control" placeholder="Apps Head ">
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Apps Caption *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
                                <textarea class="form-control" name="apps_caption" placeholder="Caption"><?php echo (!empty($sess['app']->apps_caption)) ? $sess['app']->apps_caption : null; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Address *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                <textarea class="form-control" name="apps_address" rows="4" placeholder="Address"><?php echo (!empty($sess['app']->apps_address)) ? $sess['app']->apps_address : null; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=''>
                                <div style="overflow: hidden; height: 150px; border: 3px solid grey; width: 100%">
                                    <a class="fancybox-buttons fancybox-bg" data-fancybox-group="button" href="<?php echo (!empty($sess['app']->apps_bg) ? (file_exists($sess['app']->apps_bg) ? (base_url($sess['app']->apps_bg)) : base_url("assets-ds/landscape.jpg")) : base_url("assets-ds/landscape.jpg")) ?>">
                                        <img id="preview-bg" style="min-width: 100%; min-height: 100%" src="<?php echo (!empty($sess['app']->apps_bg) ? (file_exists($sess['app']->apps_bg) ? (base_url($sess['app']->apps_bg)) : base_url("assets-ds/landscape.jpg")) : base_url("assets-ds/landscape.jpg")) ?>">    
                                    </a>
                                </div>
                            </div>
                            <span class="app__user-notif col-xs-12 mt-10">
                                <label for="bg-input" style="font-size:12px">
                                    <i class="fa fa-cloud-upload mr-10" style="font-size:35px"></i>
                                    <span>Upload Background .jpg *<br/></span>
                                    <small style="font-weight: normal"><i>Use Resolution 1200 X 800 with max 1MB size for best view</i></small>
                                </label>
                                <input type="file" id="bg-input"/>
                                <input type="hidden" name="bg" value='<?php echo (!empty($sess['app']->apps_bg) ? base64_encode_image(base_url($sess['app']->apps_bg)) : null) ?>'/>
                            </span>
                            <div class="row">
                                <span class="msg-bg col-xs-12"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 mb-10 text-right">
                            <h4><i class="fa fa-phone mr-10"></i><i>Data Contacts</i></h4>
                            <hr style="margin: 0px; padding: 0px; border-top: 1px solid grey"/>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Handphone</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" maxlength="14" name="apps_phone" value="<?php echo (!empty($sess['app']->apps_phone)) ? $sess['app']->apps_phone : null; ?>" class="form-control" placeholder="Handphone. Max 14 Character">
                            </div>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Email *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="apps_mail" value="<?php echo (!empty($sess['app']->apps_mail)) ? $sess['app']->apps_mail : null; ?>" class="form-control" placeholder="Email. ex: name@domain.com">
                            </div>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Facebook *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
                                <input type="text" name="apps_fb" value="<?php echo (!empty($sess['app']->apps_fb)) ? $sess['app']->apps_fb : null; ?>" class="form-control" placeholder="Facebook">
                            </div>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Instagram *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                <input type="text" name="apps_ig" value="<?php echo (!empty($sess['app']->apps_ig)) ? $sess['app']->apps_ig : null; ?>" class="form-control" placeholder="Instagram">
                            </div>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Linkedin *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <input type="text" name="apps_ln" value="<?php echo (!empty($sess['app']->apps_ln)) ? $sess['app']->apps_ln : null; ?>" class="form-control" placeholder="Linkedin">
                            </div>
                        </div>
                        <div class="col-xs-6 mb-10">
                            <label>Youtube *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-youtube-play"></i></span>
                                <input type="text" name="apps_youtube" value="<?php echo (!empty($sess['app']->apps_youtube)) ? $sess['app']->apps_youtube : null; ?>" class="form-control" placeholder="Youtube">
                            </div>
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Apps Keyword *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
                                <textarea class="form-control" maxlength="150" name="apps_keyword" placeholder="Keyword"><?php echo (!empty($sess['app']->apps_keyword)) ? $sess['app']->apps_keyword : null; ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-10">
                            <label>Apps Meta Keyword *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
                                <textarea class="form-control" name="apps_meta_keyword" placeholder="Meta Data Keyword"><?php echo (!empty($sess['app']->apps_meta_keyword)) ? $sess['app']->apps_meta_keyword : null; ?></textarea>
                            </div>
                        </div> 
                        <div class="col-md-12 mb-10">
                            <label>Apps Meta Description *</label>
                            <div class="input-group input-group-md">
                                <span class="input-group-addon"><i class="fa fa-pencil-square"></i></span>
                                <textarea class="form-control" name="apps_meta_description" placeholder="Meta Data Description"><?php echo (!empty($sess['app']->apps_meta_description)) ? $sess['app']->apps_meta_description : null; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 mt-20">
                    <button type="submit" class="subt btn btn-primary col-lg-12 col-xs-12"><i class="fa fa-check mr-10"></i> Update PROFILE</button>
                </div>
                <div class="col-xs-6 mt-20">
                    <button class="btn btn-warning col-lg-12 col-xs-12" data-toggle="modal" data-target=".bs-example-modal-md" onclick="updateCatalog('<?php echo md5($sess['app']->apps_id); ?>')" title="Upload Proposal"><i class="fa fa-check mr-10"></i> Update CATALOG</button>
                </div>
            </div>
        </form>
    </div>

</div>

<script>
    $('.reseter-option').selectize();
    document.getElementById("bg-input").onchange = function () {
        var input = this;
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];
            var imageSize = imageFile.size / 1048576;
            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                if (imageSize > 0.8) {
                    $("input[name=bg]").val('');
                    $(".msg-bg").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Image size can not exceed 500 KB !</i></p>');
                    return false;
                } else {
                    fileReader.readAsDataURL(imageFile);
                    fileReader.onload = function (e) {
                        $('a.fancybox-bg').attr("href", e.target.result);
                        $('#preview-bg').attr("src", e.target.result);
                        $("input[name=bg]").val(e.target.result);
                        $(".msg-bg").html('');
                    }
                }
            } else {
                $("input[name=bg]").val('');
                $(".msg-bg").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Allowed image formats only jpg / png !</i></p>');
                return false;
            }
        }
    };
    document.getElementById("logo-input").onchange = function () {
        var input = this;
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];
            var imageSize = imageFile.size / 1048576;
            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                if (imageSize > 0.8) {
                    $("input[name=logo]").val('');
                    $(".msg-logo").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Image size can not exceed 500 KB !</i></p>');
                    return false;
                } else {
                    fileReader.readAsDataURL(imageFile);
                    fileReader.onload = function (e) {
                        $('a.fancybox-logo').attr("href", e.target.result);
                        $('#preview-logo').attr("src", e.target.result);
                        $("input[name=logo]").val(e.target.result);
                        $(".msg-logo").html('');
                    }
                }
            } else {
                $("input[name=logo]").val('');
                $(".msg-logo").html('<p style="color: red; font-size: 10px"><i class="fa fa-warning text-danger mr-10"></i><i>Allowed image formats only jpg / png !</i></p>');
                return false;
            }
        }
    };
    $("#form-sys").submit(function () {

        $(".saving-seo").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i>Loading saving. Please wait... !</div>');
        $.ajax({
            url: $("#form-sys").attr('action'),
            data: $("#form-sys").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving-sys").html(json.msg);
                } else {
                    $("#load-data").load("<?php echo base_url($url_index) ?>-data");
                }
            }
        });
        return false;
    });
    
    function updateCatalog(param) {
            $(".modal-md #mySmallModalLabel").html('<i class="fa fa-spin fa-refresh mr-10"></i>Loading form please wait... !');
            $(".modal-md .modal-body").html(' ');
            $(".modal-md .modal-body").load("<?php echo base_url($url_index) ?>/upload/" + param);
        }
</script>
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
        font-size: 30px;
        float: left;
    }
    .app__user-notif > input{
        display: none;
    }
</style>
