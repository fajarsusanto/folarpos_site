<?php if ($this->session->flashdata('message')) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check mg-r-sm"></i> <?php echo $this->session->flashdata('message'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="saving"></div>
<section class="panel panel-dark">
    <header class="panel-heading"><h4 style="margin: 0px"><i class='fa fa-plus mg-r-sm'></i></h4></header>
    <div class="panel-body">
        <form role="form" id="forms" method="post" enctype="multipart/form-data" action="<?php echo base_url('bank-master/save') ?>">
            <input type="hidden" name="id" value=""/>
        <div class="row">            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>ID BANK</label>
                    <div class="input-group mg-b-md">
                        <span class="input-group-addon"><i class="fa fa-adjust"></i></span>
                        <input type="text" name="bank_id" maxlength="150" value="" class="form-control" placeholder="ID Bank">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>NAMA BANK</label>
                    <input type="text" name="bank_name" maxlength="150" value="" class="form-control" placeholder="Nama BANK">
                </div>
            </div>

        </div>
        <div class="row">
            <?php if (!empty($show)) { ?>
                <div class="<?php echo!empty($show) ? 'col-xs-6' : 'col-xs-12' ?>">
                    <a role="button" style="cursor: pointer" onclick="close_form()" class="btn btn-danger col-xs-12"><i class="fa fa-times mg-r-sm"></i>BATAL</a>
                </div>
            <?php } ?>
            <div class="<?php echo!empty($show) ? 'col-xs-6' : 'col-xs-12' ?>">
                <button type="submit" class="btn btn-info col-xs-12"><i class="fa fa-check mg-r-sm"></i>SIMPAN</button>
            </div>
        </div>
        </form>
    </div>
</section>

<section class="panel panel-dark">
    <header class="panel-heading"><h4 style="margin: 0px"><i class="fa fa-list mg-r-md"></i>DATA BANK </h4>
    </header>
    <div class="panel-body" >
        <div class="table-responsive no-border">
            <table class="table table-bordered table-striped datatable" style="min-width: 560px">
                <thead class="bg-dark" style="color: white">
                    <tr>
                        <th class="text-center" style="min-width: 40px">Nomor</th>
                        <th class="text-center" style="min-width: 40px">Nomor ID</th>
                        <th class="text-center" style="min-width: 80px">Nama Bank</th>
                            <th class="text-center" style="width: 120px"><i class=" fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                 <?php if (count($show) > 0) : ?>
                 <?php  foreach ($show as $number => $row) : ?>
                <tr>
                    <td class="text-center"><?php echo $number + 1 ; ?></td>
                    <td><?php echo ucfirst($row->bank_id); ?></td>
                    <td><?php echo ucfirst($row->bank_name); ?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-justified">
                                            <a role="button" class="btn btn-warning btn-xs" onclick="action_control('edit', '<?php echo md5($row->bank_id); ?>')" data-toggle="tooltip" data-placement="left" title="" data-original-title="Edit menu"><i class="fa fa-edit"></i></a>

                                              <a  onclick="action_control('delete', '<?php echo md5($row->bank_name); ?>')" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Delete menu"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</section>

<script type="text/javascript">

    $("#forms").submit(function () {
        $('input').attr('readonly', 'readonly');
        $.ajax({
            url: $("#forms").attr('action'),
            data: $("#forms").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                if (json.status == 0) {
                    $(".saving").html(json.msg);
                } else {
                    $("#menushow").load('<?php echo base_url() ?>member-master/form').show();
                    $(".loadmenu").load("<?php echo base_url() ?>member-master/data");
                }
                $('input').removeAttr('readonly', 'readonly');
                $('select').removeAttr('readonly', 'readonly');
                $('textarea').removeAttr('readonly', 'readonly');
            }
        });
        return false;
    });
</script>
