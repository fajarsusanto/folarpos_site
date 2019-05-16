<?php
if (count($show) > 0) {
    $nomor = 0;
    ?>
    <?php
    foreach ($show as $number => $row) {
        $nomor++;
        ?>
        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 5px;">
            <div class="col-xs-12 mg-b-sm bg-primary" style="padding: 5px">
                <?php echo !empty(($row->testi_photo)) ? file_exists($row->testi_photo) ? '<a><div style="overflow: hidden; height: 150px;"><img style="width:70%;" src="' . base_url() . $row->testi_photo . '"></div></a>' : '<div style="overflow: hidden; height: 150px;"><img style="width:50%; height: 50%" src="http://via.placeholder.com/1200x800"></div>' : '<div style="overflow: hidden; height: 150px;"><img style="width:100%; height: 100%" src="http://via.placeholder.com/1200x800"></div>'; ?>                                                        
            </div>
            <div class="col-xs-12 mg-b-sm bg-primary" style="padding: 5px">
                <?php echo !empty($row->testi_name) ? $row->testi_name : '-'; ?> (<?php echo !empty($row->testi_date) ? indo_date($row->testi_date,1,1) : '-'; ?>)                                                        
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-group btn-group-justified">
                        <a role="button" class="btn btn-warning  btn-outline btn-anim btn-ms" onclick="action_control('detail', '<?php echo md5($row->testi_id); ?>')"  data-toggle="modal" data-target=".bs-example-modal-lg" title="Detail"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-search"></span></a>
                        <a role="button" class="btn <?php echo $row->testi_status == 1 ? "btn-default" : "btn-success" ?> btn-outline btn-anim btn-ms" onclick="action_control('status', '<?php echo md5($row->testi_id); ?>',<?php echo $row->testi_status == 2 ? 1 : 2 ?>)" title="Status"><i class="fa <?php echo $row->testi_status == 2 ? "fa-times" : "fa-check" ?>"></i><span class="btn-text fa <?php echo $row->testi_status == 2 ? "fa-times" : "fa-check" ?>"></span></a>
                        <a role="button" class="btn btn-warning btn-outline btn-anim btn-ms" onclick="action_control('edit', '<?php echo md5($row->testi_id); ?>')"  data-placement="left" title="Edit"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-pencil-square"></span></a>
                        <a role="button" class="btn btn-danger btn-outline btn-anim btn-ms" onclick="action_control('delete', '<?php echo md5($row->testi_id); ?>')" title="Delete"><i class="fa fa-check-circle-o"></i><span class="btn-text fa fa-trash-o"></span></a>                  
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
    function action_control(el, param, status) {
        if (el == 'edit') {
            $("#load-form").load('<?php echo base_url($url_index) ?>/form/' + param).show();
        } else if (el == 'delete') {
            $(".alert").hide();
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
                                    if (json.status == 1) {
                                        setTimeout(function () {
                                            swal.close();
                                            $(".saving_data").html(json.msg);
                                            $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
                                        }, 3000);                                        
                                    } else {
                                        $(".saving_data").html(json.msg);
                                    }
                                }
                            });
                        }
                    });
         
        } else if (el == 'detail') {
            $(".modal-lg .modal-body").html(' ');
            $(".modal-lg .modal-body").load("<?php echo base_url($url_index) ?>/detail/" + param);
        } else if (el == "status") {
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
                                    if (json.status == 1) {
                                        setTimeout(function () {
                                            swal.close();
                                            $(".saving_data").html(json.msg);
                                            $("#load-data").load('<?php echo base_url("$url_index") ?>/data');
                                        }, 3000);
                                    } else {
                                        $(".saving_data").html(json.msg);
                                    }
                                }
                            });
                        }

                    });            
        }
    }
</script>