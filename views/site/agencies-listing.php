<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
use app\components\Generic;

$this->title = 'lanoyo.com';

$base_url = Url::home(true);
?>

<div id="wrapper">

    <section class="short-image no-padding agencies">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 short-image-title">
                    <h5 class="subtitle-margin second-color">our</h5>
                    <h1 class="second-color">Agencies</h1>
                    <div class="short-title-separator"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-light section-top-shadow">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <h5 class="subtitle-margin">LOCALIZATION: ALL</h5>
                            <h1><?php echo count($agencies) ?> agencies found<span class="special-color">.</span></h1>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="order-by-container">
                                <select name="transaction1" class="bootstrap-select" title="Localization:">
                                    <option>Localization 1</option>
                                    <option>Localization 2</option>
                                    <option>Localization 3</option>
                                    <option>Some Long Localization 4</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>
                    <div class="row list-agency-row">
                        <div class="col-xs-12">
                            <?php foreach($agencies as $agency) {
                                $image = json_decode($agency->logo);
                                ?>
                            <div class="list-agency">
                                <div class="list-agency-left">
                                    <img src="<?php echo $image[0] ?>" alt="" />
                                    <div class="list-agency-description">
                                        <?php if(isset($agency->phone1)): ?>
                                        <div class="team-desc-line">
												<span class="team-icon-circle">
													<i class="fa fa-phone"></i>
												</span>
                                            <span><?php echo $agency->phone1 ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(isset($agency->phone2)): ?>
                                        <div class="team-desc-line">
												<span class="team-icon-circle">
													<i class="fa fa-phone"></i>
												</span>
                                            <span><?php echo $agency->phone2 ?></span>
                                        </div>
                                        <?php endif; ?>
                                        <div class="team-desc-line">
												<span class="team-icon-circle">
													<i class="fa fa-envelope fa-sm"></i>
												</span>
                                            <span><a href="#"><?php echo $agency->email ?></a></span>
                                        </div>
                                        <div class="team-social-cont">
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?php echo $agency->facebook_link ?>">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?php echo $agency->twitter_link ?>">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?php echo $agency->gmail_link ?>">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?php echo $agency->skype_link ?>">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a class="list-agency-right" href="<?=$base_url?>agency-details/<?php echo $agency->id ?>">
                                    <div class="list-agency-text">
                                        <h3 class="list-agency-title"><?php echo $agency->name ?></h3>
                                        <i class="fa fa-map-marker"></i>
                                        <span class="list-agency-address"><?php echo $agency->location ?></span>
                                        <div class="list-agency-separator"></div>
                                        <?php echo $agency->description ?>
                                    </div>
                                </a>
                                <div class="small-triangle"></div>
                                <div class="small-triangle2"></div>
                                <a class="small-icon" href="<?=$base_url?>agency-details/<?php echo $agency->id ?>"><i class="jfont fa-2x">&#xe804;</i></a>
                            </div>
                            <?php } ?>

                        </div>
                    </div>


<!--                    <div class="offer-pagination margin-top-15">-->
<!--                        <a href="#" class="prev"><i class="jfont">&#xe800;</i></a><a class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#" class="next"><i class="jfont">&#xe802;</i></a>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
                </div>
                <div class="col-xs-12 col-md-3">
                    <?php
                        #Narrow Search
                        echo $this->render('../elements/narrow_search',array(
                            'heading'=>'narrow search',
                        ));
                        /*echo $this->render('../elements/narrow_search');*/
                    ?>
                    <div class="sidebar">
                        <div class="sidebar-title-cont">
                            <h4 class="sidebar-title">featured offers<span class="special-color">.</span></h4>
                            <div class="title-separator-primary"></div>
                        </div>
                        <div class="sidebar-featured-cont">
                            <?php foreach($featured_property as $property) {
                                $location = str_replace([' '], '-', $property['location']);?>
                            <div class="sidebar-featured">
                                <a class="sidebar-featured-image" href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>">
                                    <img src="<?php echo json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'; ?>" alt="" height="95" />
                                    <div class="sidebar-featured-type">
                                        <div class="sidebar-featured-estate"><?php Generic::propertyTypeAlias($property['property_type']); ?></div>
                                        <div class="sidebar-featured-transaction"><?php if($property['transaction_type'] == 'Rent') { echo "R"; }else { echo "S"; } ?></div>
                                    </div>
                                </a>
                                <div class="sidebar-featured-title"><a href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>"><?php echo $property['location'] ?></a></div>
                                <div class="sidebar-featured-price">$ <?php echo $property['price'] ?></div>
                                <div class="clearfix"></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    var autocomplete;

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('narrow_location')),
            {types: ['geocode']}
        );
    }
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaFb-9fPEhBUj2YvbstHFTDm9qwOGMmgg&amp;libraries=places&amp;callback=initAutocomplete"></script>