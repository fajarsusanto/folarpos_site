<form role="form" id="form-profile" method="post" action="<?php echo base_url($url . '/up-to-date') ?>">
    <div class="form-body overflow-hide">
        <div class="form-group">
            <label class="control-label mb-10" for="exampleInputuname_01">Name *</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="icon-user"></i></div>
                <input type="text" name="fullname" class="form-control" id="exampleInputuname_01" value="<?php echo (!empty($sess['users']->users_fullname)) ? $sess['users']->users_fullname : null; ?>" placeholder="Nama">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label mb-10" for="exampleInputEmail_01">Email address *</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                <input type="email" name="email" class="form-control" id="exampleInputEmail_01" value="<?php echo (!empty($sess['users']->users_mail)) ? $sess['users']->users_mail : null; ?>" placeholder="Email Address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label mb-10" for="exampleInputContact_01">Contact number *</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="icon-phone"></i></div>
                <input name="phone" type="number" class="form-control" id="exampleInputContact_01" value="<?php echo (!empty($sess['users']->users_phone)) ? $sess['users']->users_phone : null; ?>" placeholder="Contact Number">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="icon-lock"></i></div>
                <input type="password" name="password" class="form-control" id="exampleInputpwd_01" value="" placeholder="Password" >
            </div>
        </div>
    </div>
    <div class="form-actions mt-10">			
        <button type="submit" class="btn btn-success mr-10 mb-30">Update profile</button>
    </div>				
</form>

<script>
    $up("#form-profile").submit(function () {
        $up(".saving-profile").html('<div class="loader mg-t"><i class="fa fa-spin fa-refresh mg-r-md"></i> Loading saving. Please wait... !</div>');
        $up.ajax({
            url: $up("#form-profile").attr('action'),
            data: $up("#form-profile").serialize(),
            type: "POST",
            dataType: "JSON",
            success: function (json) {
                $up(".saving-profile").html(json.msg);
                if (json.status == 1) {
                    $up("#load_form").load("<?php echo base_url($url); ?>/form");
                }
            }
        });
        return false;
    });
</script>