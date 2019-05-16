<?php echo $this->session->flashdata('pesan') ?>
<!--<div class="row">
    <div class="col-xs-12">-->
<?php
if (count($show) > 0) {
    $nomor = 0;
    ?>
    <?php
    foreach ($show as $number => $row) {
        $nomor++;
        ?>
        <div class="col-md-3 col-sm-4 col-xs-12" style="margin-bottom: 5px;">
            <div class="col-xs-12 mg-b-sm bg-primary" style="padding: 5px">
                <?php echo!empty(($show_dt[$number]->gal_dt_photo)) ? file_exists($show_dt[$number]->gal_dt_photo) ? '<a><div style="overflow: hidden; height: 150px;"><img style="min-width:100%; min-height:100%" src="' . base_url() . $show_dt[$number]->gal_dt_photo . '"></div></a>' : '<div style="overflow: hidden; height: 150px;"><img style="width:100%; height: 100%" src="http://via.placeholder.com/1200x800"></div>' : '<div style="overflow: hidden; height: 150px;"><img style="width:100%; height: 100%" src="http://via.placeholder.com/1200x800"></div>'; ?>                                                        
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-group btn-group-justified">
                        <a role="button" class="btn btn-warning  btn-outline btn-anim btn-ms" data-toggle="modal" data-target=".bs-example-modal-md" onclick="actionM('detail', '<?php echo md5($row->gal_id); ?>')"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-search"></span></a>
                        <a role="button" class="btn <?php echo $row->gal_status == 1 ? "btn-default" : "btn-success" ?> btn-outline btn-anim btn-ms" onclick="actionM('status', '<?php echo md5($row->gal_id); ?>',<?php echo $row->gal_status == 2 ? 1 : 2 ?>)"><i class="fa <?php echo $row->gal_status == 2 ? "fa-times" : "fa-check" ?>"></i><span class="btn-text fa <?php echo $row->gal_status == 2 ? "fa-times" : "fa-check" ?>"></span></a>
                        <a role="button" class="btn btn-warning btn-outline btn-anim btn-ms" data-toggle="modal" data-target=".bs-example-modal-lg" onclick="actionM('edit', '<?php echo md5($row->gal_id); ?>')"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-pencil-square"></span></a>
                        <a role="button" class="btn btn-danger  btn-outline btn-anim btn-ms" onclick="actionM('delete', '<?php echo md5($row->gal_id); ?>')"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-trash-o"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
<?php } ?>
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
            $(".modal-lg .modal-body").load("<?php echo base_url() ?>dash-manage/mg-gallery/form");
        }
    }
</script>