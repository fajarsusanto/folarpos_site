<script src="<?php echo base_url() ?>assets-ds/tinymce/tinymce.min.js" type="text/javascript"></script>
<script>
    tinymce.init({
        selector: "textarea#summary",
        theme: "modern",
        height: 240,
        menubar: false,
        subfolder: "content",
        relative_urls: false,
        plugins: [
            "advlist autolink link lists charmap hr pagebreak",
            "wordcount ",
            " contextmenu directionality paste "
        ],
        content_css: "css/content.css",
        image_advtab: false,
        toolbar: "bold italic underline | alignleft aligncenter alignjustify | bullist numlist"
    });
</script>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-6">  
            <?php echo form_open('dash-v/set-rules/save', array('class' => 'form-horizontal', 'id' => 'form-rules-set')); ?>

            <div class="row">
                <input type="hidden" name="rules_id" value="<?php echo!empty($apps) ? $apps->rules_id : null ?>"/>

                <div class="col-xs-12">
                    <label>Rules Description</label>
                    <textarea id="summary" name="desc"><?php echo!empty($apps) ? $apps->rules_desc : null ?></textarea>
                </div>


                <div class="col-xs-6 mg-t-sm">
                    <button type="button" onclick="closeForm()" class="btn btn-md btn-danger mg-t-md col-xs-12"><i class="fa fa-times mg-r-sm"></i>Cancel</button>
                </div>
                <div class="col-xs-6 mg-t-sm">
                    <button type="submit" <?php echo!empty($apps) ? null : "disabled" ?> class="btn btn-md <?php echo!empty($apps) ? "btn-primary" : "btn-default" ?> mg-t-md col-xs-12"><i class="fa fa-check mg-r-sm"></i>Save</button>
                </div>
            </div>

            <?php echo form_close(); ?>
        </div>
        <div class="col-sm-6">
            <?php echo $this->session->flashdata('msgapps'); ?>
            <table class="table table-bordered table-striped">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">TITLE</th>
                    <th class="text-center" style="width: 50px"><i class="fa fa-gears"></i></th>
                </tr>
                <?php
                $no = 1;
                foreach ($rules as $r_nom => $r_row) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $no ?></td>
                        <td><?php echo $r_row->rules_name ?></td>
                        <td class="text-center">
                            <a role="button" onclick="ruleControl('<?php echo md5($r_row->rules_id) ?>')" class="btn btn-xs btn-success"><i class="fa fa-search"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </table>
            <div class="row">
                <div class="col-xs-12 mg-t-sm">
                    <b><i>Keterangan :</i></b>
                    <hr style="margin:0px; padding: 0px"/>
                    <i>Data rules digunakan untuk kebutuhan default print SPK</i>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".modal-title").html('<i class="fa fa-gears mg-r-sm"></i>SET RULES');
    $("#form-rules-set").submit(function () {
        $.ajax({
            url: $("#form-rules-set").attr('action'),
            data: $("#form-rules-set").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                $("#modal-contents").load("<?php echo base_url() ?>dash-v/set-rules");
            }
        });
        return false;
    });
    function ruleControl(el) {
        $("#modal-contents").load("<?php echo base_url() ?>dash-v/set-rules?el=" + el);
    }
    function closeForm() {
        $("#modal-contents").html('');
        $('.modal').modal('hide');
        return false;
    }
</script>