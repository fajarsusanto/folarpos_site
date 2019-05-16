<div class="panel-body">
    <?php echo form_open_multipart("$url_index/save_upload", array('class' => 'form-horizontal', 'id' => 'form-users')); ?>
    <?php if (!empty($dt)) { ?>
        <input type="hidden" name="id" value="<?php echo $dt->prod_id ?>"/>
    <?php } ?>
    <div class="row">
        <div class='col-xs-12'>
            <div class="saving"></div>               
        </div>
        <div class="col-md-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-10">
                <span class="">
                    <label>
                        <i class="fa fa-cloud-upload mg-r-sm"></i>
                        <span>Upload proposal (.pdf)</span>
                    </label>
                    <input type="file" name="userfile" />
                </span>
            </div>
        </div>

    </div>
    <div class="row mt-20">
        <?php if (!empty($dt)) { ?>
            <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
                <a role="button" style="cursor: pointer" onclick="close_form()" class="btn btn-danger btn-anim col-xs-12"><i class="fa  fa-times"></i><span class="btn-text"> Cancel</span></a>
            </div>
        <?php } ?>
        <div class="<?php echo!empty($dt) ? 'col-xs-6' : 'col-xs-12' ?>">
            <button type="submit" class="btn btn-success btn-anim col-xs-12"><i class="icon-rocket"></i><span class="btn-text"> Save</span></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(".modal-md #mySmallModalLabel").html('<i class="fa fa-upload mr-10"></i>FORM UPLOAD');
    function close_form() {
        $(".modal-md .modal-body").html("");
        $('.modal').modal('hide');
        return false;
    }
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