<table class="table table-bordered table-striped" style="min-width: 560px">
        <thead class="bg-default" >
            <tr>
                <th class="text-center" style="width: 5%; vertical-align: middle" >NO</th>
                <th class="text-center" style="width: 40%; vertical-align: middle" >TITLE</th>                
                <th class="text-center" style="width: 30%; vertical-align: middle" >DATE</th>
                <th class="text-center" style="width: 25%; vertical-align: middle" ><i class=" fa fa-gears"></i></th>
            </tr>           
        </thead>
        <tbody>
            <?php
            foreach ($show as $number => $row) :
                ?>
                <tr class="idc_<?php echo $row->cont_id; ?>">     
                    <td class="text-center"><?php echo $nom_started++ ; ?></td>
                    <td>
                        <i><?php echo ucwords($row->cont_title); ?></i>                        
                    </td>
                    <td>
                        <i><?php echo indo_date($row->cont_date,1,1); ?></i>                        
                    </td>
                    <td class="text-center">                        
                        <div class="btn-group btn-group-justified"> 
                            <a role="button" class="label <?php echo $row->cont_status == 1 ? "label-default disabled" : "label-primary" ?>" href="<?php echo site_url("detail_blog/".$row->cont_url) ?>" target="blank_" title="Detail <?php echo strtolower($tit_param) ?>"><i class="fa fa-search"></i></a>
                            <a role="button" class="label  <?php echo $row->cont_status == 1 ? "label-default" : "label-success" ?>" onclick="action_control('status', '<?php echo md5($row->cont_id); ?>',<?php echo $row->cont_status == 2 ? 1 : 2 ?>)" title="<?php echo $row->cont_status == 2 ? "Aktif" : "Non Aktif" ?> <?php echo strtolower($tit_param) ?>"><i class="fa <?php echo $row->cont_status == 2 ? "fa-times" : "fa-check" ?> "></i></a>
                            <a role="button" class="label label-warning" onclick="action_control('edit', '<?php echo md5($row->cont_id); ?>')"  data-placement="left" title="Edit <?php echo strtolower($tit_param) ?>"><i class="fa fa-edit"></i></a>
                            <a onclick="action_control('delete', '<?php echo md5($row->cont_id); ?>')" role="button" class="label label-danger" data-toggle="tooltip" data-placement="left" title="" title="Delete <?php echo strtolower($tit_param) ?>"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </td>
                </tr>        
            <?php endforeach; ?>
        </tbody>
    </table>
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
                                            sorProd();
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
                                        $("#load-data").load('<?php echo base_url("dash-manage/mg-blog/data") ?>');
                                    }, 3000);
                                }
                            });
                        }

                    });
        }
    }
</script>