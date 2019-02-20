<?php
    use yii\helpers\Url;
    use app\components\Generic;

    $this->title = 'lanoyo.com';

    $base_url = Url::home(true);
?>

<div class="site-index">

    <div id="wrapper">
        <?php
            #Main Search
            echo $this->render('../elements/main_search',array(
                'prop_type' =>  1,
            ));
        ?>

        <section class="section-light top-padding-45 bottom-padding-45">
            <div class="container">
                <div class="row count-container">
                    <div class="col-xs-6 col-lg-3">
                        <div class="number" id="number1">
                            <a href="<?=$base_url?>apartment">
                            <div class="number-img">
                                <i class="fa fa-building"></i>
                            </div>
                            <span class="number-label text-color2">APARTMENTS</span>
<!--                            <span class="number-big text-color3 count" data-from="0" data-to="--><?//=count(Generic::getApartmentProperty())?><!--" data-speed="2000"></span>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-lg-3 number_border">
                        <div class="number" id="number2">
                            <a href="<?=$base_url?>house">
                            <div class="number-img">
                                <i class="fa fa-home"></i>
                            </div>
                            <span class="number-label text-color2">HOUSES</span>
<!--                            <span class="number-big text-color3 count" data-from="0" data-to="--><?//=count(Generic::getHouseProperty())?><!--" data-speed="2000"></span>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-lg-3 number_border3">
                        <div class="number" id="number3">
                            <a href="<?=$base_url?>commercial">
                            <div class="number-img">
                                <i class="fa fa-industry"></i>
                            </div>
                            <span class="number-label text-color2">COMMERCIAL</span>
<!--                            <span class="number-big text-color3 count" data-from="0" data-to="--><?//=count(Generic::getCommercialProperty())?><!--" data-speed="2000"></span>-->
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-lg-3 number_border">
                        <div class="number" id="number4">
                            <a href="<?=$base_url?>land">
                            <div class="number-img">
                                <i class="fa fa-tree"></i>
                            </div>
                            <span class="number-label text-color2">LAND</span>
<!--                            <span class="number-big text-color3 count" data-from="0" data-to="--><?//=count(Generic::getLandProperty())?><!--" data-speed="2000"></span>-->
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-offers parallax">

            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h5 class="subtitle-margin second-color">highly recommended</h5>
                        <h1 class="second-color">featured offers<span class="special-color">.</span></h1>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <a href="#" class="navigation-box navigation-box-next" id="featured-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                        <a href="#" class="navigation-box navigation-box-prev" id="featured-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
                    </div>
                    <div class="col-xs-12">
                        <div class="title-separator-secondary"></div>
                    </div>
                </div>
            </div>
            <div class="featured-offers-container">
                <div class="owl-carousel" id="featured-offers-owl">
                    <?php
                    $counter = 1;
                    foreach($featured_property as $featured){
                        $location = str_replace([' '], '-', $featured['location']);
                        ?>
                    <div class="featured-offer-col">
                        <div class="featured-offer-front">
                            <div class="featured-offer-photo">
                                <?php $image_helper->getScaledImageFromCloudinary(json_decode($featured['image'])[0] ? json_decode($featured['image'])[0] : $base_url.'images/no-image.jpg',$featured_image_size) ?>
                                <div class="type-container">
                                    <div class="estate-type"><?php echo Generic::propertyType($featured['property_type'])?></div>
                                    <div class="transaction-type"><?=$featured['transaction_type']?></div>
                                </div>
                            </div>
                            <div class="featured-offer-text">
                                <div class="croptext">
                                    <h4 class="featured-offer-title"><?=$featured['location']?></h4>
                                </div>
                                <p><?php if(strlen($featured['description']) > 40) $featured['description'] = substr($featured['description'], 0, 40).'...'; echo $featured['description'];?></p>
                            </div>
                            <div class="featured-offer-params">
                                <div class="featured-area">
                                    <img src="/images/area-icon.png" alt="" width="17" height="17"/><?=$featured['area']?><?=Generic::propertyUnit($featured['property_type'])?>
                                </div>
                                <?php if($featured['property_type'] == 1 || $featured['property_type'] == 2){?>
                                    <div class="featured-rooms">
                                        <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$featured['bedrooms']?>
                                    </div>
                                    <div class="featured-baths">
                                        <img src="/images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$featured['bathrooms']?>
                                    </div>
                                <?php } elseif ($featured['property_type'] == 3){?>
                                    <div class="featured-rooms">
                                        <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$featured['rooms']?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="featured-price">
                                &#2547; <?=$featured['price']?>
                            </div>
                        </div>
                        <div class="featured-offer-back">
                            <div id="featured-map<?=$counter?>" class="featured-offer-map"></div>
                            <div class="button">
                                <a href="<?=$base_url?><?php echo Generic::propertyType($featured['property_type'])?>/<?=$featured['id']."--".str_replace([','], '', $location)?>" class="button-primary">
                                    <span>read more</span>
                                    <div class="button-triangle"></div>
                                    <div class="button-triangle2"></div>
                                    <div class="button-icon"><i class="fa fa-search"></i></div>
                                </a>
                            </div>
                        </div>

                    </div>
                    <?php
                    $counter++;
                    } ?>
                </div>
            </div>
        </section>

        <section class="team section-light section-both-shadow">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h5 class="subtitle-margin">meet our</h5>
                        <h1>Agency List<span class="special-color">.</span></h1>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <a href="#" class="navigation-box navigation-box-next" id="team-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                        <a href="#" class="navigation-box navigation-box-prev"  id="team-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
                    </div>
                    <div class="col-xs-12">
                        <div class="title-separator-primary"></div>
                    </div>
                </div>
            </div>
            <div class="team-container">
                <div class="owl-carousel" id="team-owl">
                    <?php foreach($all_agency as $agency) {
                        $social_link = Generic::getSocialLinks($agency['social_link']);
                        ?>
                    <div class="team-member-cont">
                        <div class="team-member">
                            <div class="team-photo">
                                <?php $image_helper->getScaledImageFromCloudinary($agency['photo'] ? $agency['photo'] : $base_url.'images/no-image.jpg',$agent_image_size) ?>
                                <div class="big-triangle"></div>
                                <div class="big-triangle2"></div>
                                <a class="big-icon big-icon-plus" href="<?=$base_url?>agency-details/<?php echo $agency['company'] ?>"><i class="jfont">&#xe804;</i></a>
                                <div class="team-description">
                                    <div>
                                        <div class="team-desc-line">
										<span class="team-icon-circle">
											<i class="fa fa-phone"></i>
										</span>
                                            <span><?=$agency['phone']?></span>
                                        </div>
                                        <div class="team-desc-line">
										<span class="team-icon-circle">
											<i class="fa fa-envelope fa-sm"></i>
										</span>
                                            <span><?=$agency['email']?></span>
                                        </div>
                                        <div class="team-social-cont">
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?=$social_link['facebook_url']?>">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?=$social_link['twitter_url']?>">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?=$social_link['google_url']?>">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="team-icon-circle" href="<?=$social_link['skype_url']?>">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <p class="team-text">
                                            <?=$agency['description']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="team-name">
                                <h5>agent</h5>
                                <h4><?=$agency['name']?><span class="special-color">.</span></h4>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <section class="section-light no-bottom-padding section-top-shadow">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-9">
                        <h5 class="subtitle-margin">hot</h5>
                        <h1>new listings<span class="special-color">.</span></h1>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <a href="#" class="navigation-box navigation-box-next" id="grid-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                        <a href="#" class="navigation-box navigation-box-prev" id="grid-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
                    </div>
                    <div class="col-xs-12">
                        <div class="title-separator-primary"></div>
                    </div>
                </div>
            </div>
            <div class="grid-offers-container">
                <div class="owl-carousel" id="grid-offers-owl">
                    <?php
                    $counter = 1;
                    foreach($all_property as $property){
                        $location = str_replace([' '], '-', $property['location']);?>
                    <div class="grid-offer-col">
                        <div class="grid-offer">
                            <div class="grid-offer-front">
                                <div class="grid-offer-photo">
                                    <?php $image_helper->getScaledImageFromCloudinary(json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg',$new_property_image_size) ?>
                                    <div class="type-container">
                                        <div class="estate-type"><?php echo Generic::propertyType($property['property_type'])?></div>
                                        <div class="transaction-type"><?=$property['transaction_type']?></div>
                                    </div>
                                </div>
                                <div class="grid-offer-text">
                                    <i class="fa fa-map-marker grid-offer-localization"></i>
                                    <div class="grid-offer-h4">
                                        <div class="croptext" style="height: 38px; overflow: hidden; text-overflow: ellipsis">
                                            <h4 class="grid-offer-title"><?=$property['location']?></h4>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p><?php if(strlen($property['description']) > 60) $property['description'] = substr($property['description'], 0, 60).'...'; echo $property['description'];?></p>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="price-grid-cont">
                                    <div class="grid-price-label pull-left">Price:</div>
                                    <div class="grid-price pull-right">
                                        &#2547; <?=$property['price']?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="grid-offer-params">
                                    <div class="grid-area">
                                        <img src="/images/area-icon.png" alt="" width="17" height="17"/><?=$property['area']?><?=Generic::propertyUnit($property['property_type'])?>
                                    </div>
                                    <?php if($property['property_type'] == 1 || $property['property_type'] == 2){?>
                                        <div class="grid-rooms">
                                            <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['bedrooms']?>
                                        </div>
                                        <div class="grid-baths">
                                            <img src="/images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$property['bathrooms']?>
                                        </div>
                                    <?php } elseif ($property['property_type'] == 3){?>
                                        <div class="grid-rooms">
                                            <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['rooms']?>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="grid-offer-back">
                                <div id="grid-map<?=$counter?>" class="grid-offer-map"></div>
                                <div class="button">
                                    <a href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>" class="button-primary">
                                        <span>read more</span>
                                        <div class="button-triangle"></div>
                                        <div class="button-triangle2"></div>
                                        <div class="button-icon"><i class="fa fa-search"></i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $counter++;
                    } ?>
                </div>
            </div>
        </section>

        <!-- Welcome modal -->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">
            <div class="modal-dialog" id="welcome_modal">
                <!-- Modal content-->
                <div class="modal-content" style="/*background-image: url('<?=$base_url?>images/grand-opening.jpg');*/ background-color: #FBF5DD;padding: 0px;">
                    <!--
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i>Your title goes here</h4>
                    </div>
                    -->
                    <div class="modal-body" style="text-align: center;margin: 0px;padding: 0px;">
                        <button type="button" class="close" data-dismiss="modal" style="position: absolute; right: -20px; color: #FFFFFF; background-color: #000;width: 20px;height: 20px;text-align: center;vertical-align: middle;"><i class="fa fa-scissors fa-rotate-180" aria-hidden="true"></i></button>
                        <img src="<?=$base_url?>images/grand-opening.jpg" class="img-rounded" alt="Grand Opening" width="600" height="600">
                    </div>
                    <!--
                    <div class="modal-footer">
                        <a href="#" class="button-primary button-shadow button-full" id="" data-dismiss="modal" style="margin-right: 45%;">
                            <span>Open</span>
                            <div class="button-triangle"></div>
                            <div class="button-triangle2"></div>
                            <div class="button-icon"><i class="fa fa-scissors"></i></div>
                        </a>
                    </div>
                    -->
                </div>

            </div>
        </div>

    </div>
</div>


<script>
    var autocomplete1,autocomplete2,autocomplete3,autocomplete4;

    function initAutocomplete() {
        autocomplete1 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete1')),
            {types: ['geocode']}
        );
        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete2')),
            {types: ['geocode']}
        );
        autocomplete3 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete3')),
            {types: ['geocode']}
        );
        autocomplete4 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('autocomplete4')),
            {types: ['geocode']}
        );
    }
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaFb-9fPEhBUj2YvbstHFTDm9qwOGMmgg&amp;libraries=places&amp;callback=initAutocomplete"></script>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        var locations = [
            <?php foreach($all_property as $property){
            $location = str_replace([' '], '-', $property['location']);?>
            [<?=$property['latitude']?>,<?=$property['longitude']?>, "<?=$base_url?><?php Generic::propertyMapMarkerImage($property['property_type'])?>", "<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>", "<?php echo json_decode($property['image'])[0]?>", "<?=$property['location']?>", "&#2547; <?=$property['price']?>"],
            <?php  } ?>
        ];

        <?php
        $counter = 1;
        foreach($featured_property as $featured){?>
        offersMapInit("offers-map",locations);

        mapInit(<?=$featured['latitude']?>,<?=$featured['longitude']?>,"featured-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($featured['property_type'])?>", false);
        <?php
         $counter++;
         } ?>

        <?php
         $counter = 1;
         foreach($all_property as $property){?>

        mapInit(<?=$property['latitude']?>,<?=$property['longitude']?>,"grid-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($property['property_type'])?>", false);

        <?php
         $counter++;
         } ?>
    }
</script>