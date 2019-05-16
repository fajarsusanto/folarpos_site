<link rel="stylesheet" href="<?php echo base_url() ?>assets-ds/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets-ds/jquery-select2/select2.min.js"></script>
<div class="modal-body">
    <div class="row">
        <?php echo form_open('dash-v/set-signature/save', array('class' => 'form-horizontal', 'id' => 'form-head-set')); ?>

        <div class="col-xs-8">
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped   ">
                        <tr>
                            <th style="width: 200px">POSITION</th>
                            <th>USERS / EMPLOYEE</th>
                        </tr>
                        <?php foreach ($head as $t_nom => $t_row) { ?>
                            <tr>
                                <td style="vertical-align: middle">
                                    <?php echo $t_row->signature_name ?>
                                    <input type="hidden" name="signature_id[<?php echo $t_nom ?>]" value="<?php echo $t_row->signature_id ?>"/>
                                </td>
                                <td>
                                    <select name="users_id[<?php echo $t_nom ?>]" placeholder="Pilih Kepala" class="form-control form-select2 ">
                                        <option></option>
                                        <?php foreach ($pegawai as $x => $row) { ?>
                                            <option value="<?php echo $row->users_id ?>" <?php echo!empty($t_row) ? $t_row->users_id == $row->users_id ? "selected" : null : null ?>><?php echo ucwords($row->users_name) ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="col-xs-6 mg-t-xs">
                    <button type="button" onclick="closeForm()" class="btn btn-md btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i>Cancel</button>
                </div>
                <div class="col-xs-6 mg-t-xs">
                    <button type="submit" class="btn btn-md btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i>Save</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="col-xs-4">
            <b><i>Keterangan :</i></b>
            <ul>
                <li><i class="fa fa-chevron-right mg-r-sm mg-t-sm"></i>Pilih users sebagai kepala</li>
            </ul>
        </div>
    </div>
</div>
<script>
    $('select.form-select2').select2();
    $(".modal-title").html('<i class="fa fa-gears mg-r-sm"></i>SET SIGNATURE');
    $("#form-head-set").submit(function () {
        $.ajax({
            url: $("#form-head-set").attr('action'),
            data: $("#form-head-set").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                closeForm();
            }
        });
        return false;
    });
    function closeForm() {
        $("#modal-contentS").html('');
        $('.modal').modal('hide');
        return false;
    }
</script>