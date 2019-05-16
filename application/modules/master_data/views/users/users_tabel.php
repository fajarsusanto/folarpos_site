<?php echo $this->session->flashdata('pesan') ?>
    <table class="table table-hover table-bordered" >
        <thead class="bg-default" style="color: white">
            <tr>
                <th class="text-center" style="width: 50px; vertical-align: middle">NO</th>
                <th class="text-center" style="width: 130px; vertical-align: middle">USERS</th>
                <th class="text-center" style="width: 100px; vertical-align: middle">EMAIL</th>
                <?php //if ($sess['users']->roles_id == 1) { ?>
                <th class="text-center perubahan" style="width: 100px; vertical-align: middle"><i class=" fa fa-gears"></i></th>
                <?php //} ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($show as $number => $row) : ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle"><?php echo $nom_started++; ?>
                    <td style="vertical-align: middle;">
                        <?php echo ucwords($row->users_fullname); ?>                      
                    </td>                    
                    <td style="vertical-align: middle" <?php echo empty($row->users_mail) ? "class='text-center'" : null; ?>><?php echo!empty($row->users_mail) ? strtolower($row->users_mail) : "-"; ?></td>
                    <td style="vertical-align: middle" <?php echo empty($row->users_usersname) ? "class='text-center'" : null; ?>><?php echo!empty($row->users_mail) ? strtolower($row->users_mail)."&nbsp;".($row->users_status == 2 ? "<span class='label label-success'>Aktif</span>" : "<span class='label label-danger'>NonAktif</span>" ) : "-"; ?></td>
                    <?php //if ($sess['users']->roles_id == 1) { ?>
                        <td class="text-center" style="width: 70px; vertical-align: middle">
                            <div class="btn-group btn-group-justified">
                                <a role="button" class="btn btn-primary btn-icon-anim btn-square btn-sm" onclick="actionCtrMaster('detail', '<?php echo md5($row->users_id); ?>')"  data-toggle="modal" data-target=".bs-example-modal-md" title="Detail User"><i class="fa fa-search"></i></a>
                                <a role="button" class="btn btn-icon-anim btn-square btn-sm <?php echo $row->users_status == 1 ? "btn-default" : "btn-success" ?>" onclick="actionCtrMaster('status', '<?php echo md5($row->users_id); ?>',<?php echo $row->users_status == 2 ? 1 : 2 ?>)" title="<?php echo $row->users_status == 2 ? "Aktif" : "Non Aktif" ?> <?php echo strtolower($tit_param) ?>"><i class="fa <?php echo $row->users_status == 2 ? "fa-times" : "fa-check" ?> "></i></a>
                                <a role="button" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-warning btn-icon-anim btn-square btn-sm" onclick="actionCtrMaster('edit', '<?php echo md5($row->users_id); ?>')" data-toggle="tooltip" data-placement="left" title="" title="Edit user"><i class="fa fa-edit"></i></a>
                                <a  onclick="actionCtrMaster('delete', '<?php echo md5($row->users_id); ?>')" role="button" class="btn btn-danger btn-icon-anim btn-square btn-sm <?php echo !empty($row->count_c) ? ($row->count_c > 0 ? 'disabled' : null ) : null?> <?php echo !empty($row->count_cs) ? ($row->count_cs > 0 ? 'disabled' : null ) : null?> <?php echo !empty($row->count_te) ? ($row->count_te > 0 ? 'disabled' : null ) : null?> <?php echo !empty($row->count_w) ? ($row->count_w > 0 ? 'disabled' : null ) : null?>" data-toggle="tooltip" data-placement="left" title="" title="Delete user"><i class="fa fa-trash-o"></i></a>
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
    function actionCtrMaster(el, param, status) {
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
                confirmButtonText: "Yes, "+(status == 2 ? "Aktifkan" : "Nonaktif")+" Me!",
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
            $(".modal-lg .modal-body").load("<?php echo base_url($url_index) ?>/form");
        }
        if (el == 'position_add') {
            $(".modal-lg #mySmallModalLabel").html('<i class="fa fa-spin fa-refresh mr-10"></i>Loading form please wait... !');
            $(".modal-lg .modal-body").html(' ');
            $(".modal-lg .modal-body").load("<?php echo base_url($url_index_position) ?>");
        }
    }
</script>