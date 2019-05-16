					
<!-- Row -->
<div class="row">
    <div class="col-lg-3 col-xs-12">
        <div class="panel panel-default card-view  pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body  pa-0">
                    <div class="profile-box">
                        <div class="profile-cover-pic">
                            <div class="profile-image-overlay"></div>
                        </div>
                        <div class="profile-info text-center">
                            <div class="profile-img-wrap">
                                <img id="preview-upload" class="inline-block mb-10" src="<?php echo base_url(!empty($sess['users']->users_photo) ? $sess['users']->users_photo : "assets-ds/nonuser.png") ?>" alt="user"/>
                                <div class="fileupload btn btn-default">
                                    <span class="btn-text">Upload</span>
                                    <input class="upload" id="file-input" type="file">
                                    <form id="form-upload">
                                        <input type="hidden" name="photo"/>
                                    </form>
                                </div>
                                <div class="msg-username"></div>
                            </div>	
                            <h5 class="block mt-10 mb-5 weight-500 capitalize-font txt-info"><?php echo $sess['users']->users_fullname ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div  class="panel-body pb-0">
                    <div  class="tab-struct custom-tab-1">
                        <ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">
                            <li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>profile</span></a></li>

                        </ul>
                        <div class="tab-content" id="myTabContent_8">
                            <div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
                                <!-- Row -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <div class="col-sm-12 col-xs-12">
                                                        <div class="form-wrap">
                                                            <div class="saving-profile"><?php echo $this->session->flashdata('msg-profile'); ?></div>
                                                            <div id="load_form"></div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
<script>
    var $up = jQuery.noConflict();
    $up("#load_form").load("<?php echo base_url($url); ?>/form");
    document.getElementById("file-input").onchange = function () {
        var input = this;
        if (input.files && input.files[0]) {
            var fileReader = new FileReader();
            var imageFile = input.files[0];
            var imageSize = imageFile.size / 1048576

            if (imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
                if (imageSize > 0.5) {
                    $up("input[name=photo]").val('');
                    $up(".msg-username").html('<p style="margin: -15px 0px 0px 10px; color: red; font-size: 9px; text-align: center"><i class="fa fa-warning text-danger mg-r-sm"></i> Max file size 500kb !</p>');
                    return false;
                } else {
                    fileReader.readAsDataURL(imageFile);
                    fileReader.onload = function (e) {
                        $up('#preview-upload').attr("src", e.target.result);
                        $up('#preview-upload-logo').attr("src", e.target.result);
                        $up("input[name=photo]").val(e.target.result);
                        $up(".msg-username").html("");
                        $up.ajax({
                            url: 'my-profile/photo-upload',
                            data: $up("#form-upload").serialize(),
                            type: "POST",
                            dataType: "JSON",
                            success: function (json) {                             
                                if (json.status == 1) {                                    
                                    $up(".msg-username").html('<p style="margin: -15px 0px 0px 10px; color: green; font-size: 9px; text-align: center"><i class="fa fa-info-circle text-success mg-r-sm"></i> Succesfully uploaded !</p>');
                                    return false;
                                }
                            }
                        });
                    }
                }
            } else {
                $up("input[name=photo]").val('');
                $up(".msg-username").html('<p style="margin: -15px 0px 0px 10px; color: red; font-size: 9px; text-align: center"><i class="fa fa-warning text-danger mg-r-sm"></i> Format files not supported !</p>');
                return false;
            }
        }
    };
    
</script>


