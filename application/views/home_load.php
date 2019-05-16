<div class="listing listing--grid">
    <?php if (!empty($favorite)) { ?>
        <?php foreach ($favorite as $ls_nom => $ls_row) { ?>
    <div class="listing__item">
                <div class="properties properties--grid" style="background: grey">
                    <div class="properties__thumb">
                        <a style="overflow: hidden; height: 130px; width: 100%" href="<?php echo base_url("apt-achieve/$ls_row->apartment_url/$ls_row->list_url") ?>" class="item-photo">
                            <div style="overflow: hidden; height: 130px; width: 100%">
                                <img style="width: 100%; min-height: 110%" src="<?php echo base_url(!empty($ls_row->list_header) ? $ls_row->list_header : "assets/media-demo/properties/554x360/02.jpg") ?>" alt=""/>
                            </div>
                            <figure class="item-photo__hover item-photo__hover--params"><span class="properties__intro"><?php echo shortext($ls_row->list_desc, 80) ?></span></figure>
                        </a>
                        <span class="properties__ribon"><?php echo $ls_row->list_sell_price > 0 ? "SELL" : null ?> <?php echo $ls_row->list_rent_price > 0 ? " / RENT" : null ?></span>
                    </div>
                    <div class="properties__details">
                        <div class="properties__info" style="background: #f6f6f6 none repeat scroll 0 0">
                            <div class="properties__offer">
                                <a href="<?php echo base_url("apt-achieve/$ls_row->apartment_url/$ls_row->list_url") ?>" class="properties__address" style="background: none">
                                    <span class="properties__address-street"><?php echo $ls_row->list_title ?></span>
                                    <span class="properties__address-city"><i class="fa fa-map-marker mg-r-sm"></i><small><?php echo $ls_row->location_name ?></small></span>
                                </a>
                                <div class="properties__params--mob"><a href="<?php echo base_url("apt-achieve/$ls_row->apartment_url/$ls_row->list_url") ?>" class="properties__more">View details</a></div>
                                <div class="properties__offer-column">
                                    <div class="properties__offer-value"><i style="color:#ffc53f;" class="fa fa-star mg-r-sm"></i><small>Premium</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <center><i class="fa fa-info-circle text-info mg-r-sm"></i><i>Content Not Available !</i></center>
            <?php } ?>
</div>