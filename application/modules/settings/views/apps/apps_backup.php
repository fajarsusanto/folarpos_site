<link rel="stylesheet" href="<?php echo base_url() ?>assets/jquery-select2.min.css">
<script src="<?php echo base_url() ?>assets/jquery-select2/select2.min.js"></script>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            <div id="notif"></div>
            <?php echo form_open('secret-apps-save', array('class' => 'form-horizontal row', 'id' => 'form-apps-secret')); ?>
            <div class="col-xs-12 mg-b-md">
                <label>Security Key</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" maxlength="10" placeholder="Security Key" class="form-control" name="secretkey" value="<?php echo strtolower($sess['system']->apps_secretkey) ?>"/>
                </div>
            </div>
            <div class="col-xs-6">
                <button type="submit" class="btn btn-md btn-primary col-xs-12"><i class="fa fa-check mg-r-sm"></i>Simpan</button>
            </div>
            <div class="col-xs-6">
                <button type="button" onclick="backupApps()" class="btn btn-md btn-danger col-xs-12"><i class="fa fa-download mg-r-xs"></i>Backup DB</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="col-xs-12 mg-t-sm">
            <hr class="divider visible-xs"/>
            <b><i>Perhatian :</i></b>
            <ul>
                <li><i class="fa fa-chevron-right mg-r-sm mg-t-sm"></i>Mohon untuk tidak memberitahukan <b>Security Key</b>, demi keamanan sistem</li>
                <li><i class="fa fa-chevron-right mg-r-sm mg-t-sm"></i>Panjang karakter maksimal <b>Security Key</b> adalah <b>10 karakter</b></li>
                <li><i class="fa fa-chevron-right mg-r-sm mg-t-sm"></i>Pastikan hanya menggunakan karakter <b>Huruf & Angka</b></li>
                <li><i class="fa fa-chevron-right mg-r-sm mg-t-sm"></i>Lakukan secara rutin Backup Database (<i>Disarankan Setiap Minggu</i>)</li>
            </ul>
        </div>
    </div>
</div>
<script>
    $(".modal-title").html('<i class="fa fa-key mg-r-sm"></i>APPS SECURITY');
    $("select.form-select2").select2();
    $("#form-apps-secret").submit(function () {
        $.ajax({
            url: $("#form-apps-secret").attr('action'),
            data: $("#form-apps-secret").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                $("#notif").html(json.notif);
            }
        });
        return false;
    });
    function backupApps() {
        window.location.href = "<?php echo base_url('apps-db-backup') ?>";
    }
</script>
<script src="<?= base_url() ?>assets/js/datatables.js"></script>