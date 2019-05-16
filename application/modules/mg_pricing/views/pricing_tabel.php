<?php echo $this->session->flashdata('pesan') ?>
<table class="table table-hover table-bordered" >
    <thead class="bg-default" style="color: white">
        <tr>
            <th class="text-center" style="width: 50px; vertical-align: middle">NO</th>
            <th class="text-center" style="width: 130px; vertical-align: middle">PRICING</th>
            <th class="text-center" style="width: 100px; vertical-align: middle">CURRENCY</th>
            <th class="text-center" style="width: 100px; vertical-align: middle">NOMINAL</th>
            <?php //if ($sess['users']->roles_id == 1) { ?>
            <th class="text-center perubahan" style="width: 50px; vertical-align: middle"><i class=" fa fa-gears"></i></th>
            <?php //} ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($show as $number => $row) : ?>
            <tr>
                <td class="text-center" style="vertical-align: middle"><?php echo $nom_started++; ?>
                <td style="vertical-align: middle;">
                    <?php echo ucwords($row->pric_name); ?>                      
                </td>                    
                <td style="vertical-align: middle" <?php echo empty($row->pric_curency) ? "class='text-center'" : null; ?>><?php echo!empty($row->pric_curency) ? strtolower($row->pric_curency) : "-"; ?></td>
                <td style="vertical-align: middle" <?php echo empty($row->pric_nominal) ? "class='text-center'" : null; ?>><?php echo!empty($row->pric_nominal) ? strtolower($row->pric_nominal) . "&nbsp;" . ($row->pric_status == 2 ? "<span class='label label-success'>Aktif</span>" : "<span class='label label-danger'>NonAktif</span>" ) : "-"; ?></td>
                <?php //if ($sess['users']->roles_id == 1) { ?>
                <td class="text-center" style="width: 70px; vertical-align: middle">
                    <div class="btn-group btn-group-justified">
                        <a role="button" class="btn <?php echo $row->pric_status == 1 ? "btn-default" : "btn-primary" ?> btn-icon-anim btn-square btn-sm" <?php if($row->pric_status == 2) { ?> onclick="actionM('detail', '<?php echo md5($row->pric_id); ?>')" data-toggle="modal" data-target=".bs-example-modal-md" <?php } ?> title="Detail pricing"><i class="fa fa-search"></i></a>
                        <a role="button" class="btn btn-icon-anim btn-square btn-sm <?php echo $row->pric_status == 1 ? "btn-default" : "btn-success" ?>" onclick="actionM('status', '<?php echo md5($row->pric_id); ?>',<?php echo $row->pric_status == 2 ? 1 : 2 ?>)" title="<?php echo $row->pric_status == 2 ? "Aktif" : "Non Aktif" ?> <?php echo strtolower($tit_param) ?>"><i class="fa <?php echo $row->pric_status == 2 ? "fa-times" : "fa-check" ?> "></i></a>
                        <a role="button" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-warning btn-icon-anim btn-square btn-sm" onclick="actionM('edit', '<?php echo md5($row->pric_id); ?>')" data-toggle="tooltip" data-placement="left" title="Edit pricing" title="Edit user"><i class="fa fa-edit"></i></a>
                        <a  onclick="actionM('delete', '<?php echo md5($row->pric_id); ?>')" role="button" class="btn btn-danger btn-icon-anim btn-square btn-sm" data-toggle="tooltip" data-placement="left" title="Delete pricing" title="Delete"><i class="fa fa-trash-o"></i></a>
                    </div>
                </td>
                <?php //} ?>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>
<nav class="listing__pagination">
    <?php echo $halaman ?> <!--Memanggil variable pagination-->
</nav>
<script type="text/javascript">
    $(".loadertab").hide();
    $(".deliksek").removeAttr('style', 'display:none;');
    $("#loading_search").attr("class", "fa fa-search text-white");
    $("#loading_search_role").attr("class", "fa fa-search text-white");
    $("#count-usr").html(<?php echo rupiah($count_usr) ?>);
    function actionM(el, param, status) {
        if (el == 'edit') {
            $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-spin fa-refresh mr-10"></i>Loading form please wait... !');
            $(".modal-lg .modal-body").html(' ');
            $(".modal-lg .modal-body").load('<?php echo base_url($url_index) ?>/form/' + param);
        }
        if (el == 'delete') {
            $(".alert").hide();
            $("#pesan").hide();
            swal({
                title: "<?php echo $title; ?>",
                text: "Are you sure you want to delete it ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Delete Me!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
                    function (result) {
                        if (result == true) {
                            $(".loadertab").hide();
                            $.ajax({
                                url: "<?php echo base_url($url_index) ?>/delete/" + param,
                                dataType: "JSON",
                                success: function (json) {
                                    setTimeout(function () {
                                        swal.close();
                                        sorUs();
                                    }, 3000);

                                }
                            });
                        }
                    });
        }
        if (el == "status") {
            $(".alert").hide();
            $("#pesan").hide();
            swal({
                title: "<?php echo $title; ?>",
                text: "Apakah anda yakin akan " + (status == 2 ? "mengaktifkan" : "menonaktifkan") + " <?php echo $tit_param ?> ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, " + (status == 2 ? "Aktifkan" : "Nonaktif") + " Me!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
                    function (result) {
                        if (result == true) {
                            $(".loadertab").hide();
                            $.ajax({
                                url: "<?php echo base_url($url_index) ?>/" + (status == 2 ? "enabled" : "suspend") + "/" + param,
                                dataType: "JSON",
                                success: function (json) {
                                    setTimeout(function () {
                                        swal.close();
                                        sorUs();
                                    }, 3000);
                                }
                            });
                        }

                    });
        }
        if (el == 'detail') {
            $(".modal-md #mySmallModalLabel").html('<i class="fa fa-spin fa-refresh mr-10"></i>Loading form please wait... !');
            $(".modal-md .modal-body").html(' ');
            $(".modal-md .modal-body").load("<?php echo base_url($url_index) ?>/detail/" + param);
        }
        if (el == 'add') {
            $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-spin fa-refresh mr-10"></i>Loading form please wait... !');
            $(".modal-lg .modal-body").html(' ');
            $(".modal-lg .modal-body").load("<?php echo base_url() ?>dash-manage/mg-pricing/form");
        }
    }
</script>