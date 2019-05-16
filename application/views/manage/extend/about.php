<div class="modal-body">
    <div class="col-xs-12 mg-b-lg">
        <div class="col-xs-6 col-xs-offset-3">
            <img class="pull-right" src="<?php echo base_url() ?>assets-ds/folarium/folarium.png" style="height: 80px; margin-top: 10px"/>
        </div>
    </div>
    <table class="table">
        <tr>
            <td class="text-center"><b><?php echo strtoupper($this->config->item("config_company")); ?></b></td>
        </tr>
        <tr>
            <td class="text-center"><?php echo $this->config->item("config_company_phone") ?></td>
        </tr>
        <tr>
            <td class="text-center"><a href="mailto:<?php echo $this->config->item("config_company_mail") ?>" target="_blank"><?php echo $this->config->item("config_company_mail") ?></a></td>
        </tr>
        <tr>
            <td class="text-center"><a href="http://<?php echo $this->config->item("config_company_site") ?>" target="_blank"><?php echo $this->config->item("config_company_site") ?></a></td>
        </tr>
    </table>
    <h5 style="color:  gray"><i>History Release</i></h5>
    <table class="table">
        <?php foreach ($this->config->item("config_release") as $release => $vers) { ?>
            <tr>
                <td>Vs. <?php echo $vers['version'] ?></td>
                <td><?php echo $vers['date'] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
<script type="text/javascript">
    $(".modal-title").html('<b><?php echo strtoupper($this->config->item("config_app_name")); ?> </b><br/>( <i><?php echo ucwords($this->config->item("config_app_desc")); ?></i> )<br/><small>V.<?php echo $this->config->item("config_release")[(count($this->config->item("config_release")) - 1)]['version'] ?> <?php echo $this->config->item("config_release")[(count($this->config->item("config_release")) - 1)]['date'] ?></small>');
</script>

