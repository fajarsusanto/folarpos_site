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
        <h6 class="panel-title txt-dark"><b style="margin: 0px"><i class='fa <?php echo $act == 'EDIT' ? 'fa-pencil' : 'fa-plus'; ?> mr-10'></i> <?php echo $act; ?> Help</b></h6>
    </div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-wrap">
                        <div class="savingit"></div>
                        <?php echo form_open("$url_index/save", array('id' => 'formsit')); ?>
                        <div class="row">   
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class=""></span>
                                        <textarea id="elm1" class="form-control" name="apps_help" placeholder="Description"><?php echo empty($sess['app']->apps_help) ? null : ucwords($sess['app']->apps_help); ?></textarea>
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
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
                    $("#load-form").load('<?php echo base_url("dash-manage/mg-help/form") ?>');
                }
                $('input').removeAttr('readonly', 'readonly');
                $('textarea').removeAttr('readonly', 'readonly');
            }
        });
        return false;

    });
    function close_form() {
        $("#load-form").load('<?php echo base_url("dash-manage/mg-help/form") ?>');
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