<?php
use app\components\Generic;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'lanoyo.com';

$base_url = Url::home(true);
?>

<div id="wrapper">

    <section class="section-dark no-padding">
        <!-- Slider main container -->
        <div id="swiper-gallery" class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php foreach($images as $image){?>
                <div class="swiper-slide">
                    <div class="slide-bg swiper-lazy" data-background="<?=$image?>"></div>
                    <!-- Preloader image -->
                    <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-9 col-lg-8 slide-desc-col animated fadeInUp gallery-slide-desc-1">
                                <div class="gallery-slide-cont">
                                    <div class="gallery-slide-cont-inner">
                                        <div class="gallery-slide-title pull-right">
                                            <h5 class="subtitle-margin"><?php echo Generic::propertyType($property_details['property_type'])?> for <?=$property_details['transaction_type']?></h5>
                                            <h3><?=$property_details['location']?><span class="special-color">.</span></h3>
                                        </div>
                                        <div class="gallery-slide-estate pull-right hidden-xs">
                                            <i class="fa fa-home"></i>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="gallery-slide-desc-price pull-right">
                                        &#2547; <?=$property_details['price']?>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>

            <div class="slide-buttons slide-buttons-center">
                <a href="#" class="navigation-box navigation-box-next slide-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                <div id="slide-more-cont"></div>
                <a href="#" class="navigation-box navigation-box-prev slide-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
            </div>

        </div>

    </section>
    <section class="thumbs-slider section-both-shadow">
        <div class="container">
            <div class="row">
                <div class="col-xs-1">
                    <a href="#" class="thumb-box thumb-prev pull-left"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
                </div>
                <div class="col-xs-10">
                    <!-- Slider main container -->
                    <div id="swiper-thumbs" class="swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach($images as $image){?>
                            <div class="swiper-slide">
                                <img class="slide-thumb" src="<?=$image?>" alt="" width="107" height="80">
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1">
                    <a href="#" class="thumb-box thumb-next pull-right"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                </div>
            </div>
        </div>
    </section>
    <section class="section-light no-bottom-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="row">
                        <!-- Body -->
                        <div class="col-xs-12 col-sm-7 col-md-8">
                            <div class="details-image pull-left hidden-xs">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="details-title pull-left">
                                <h5 class="subtitle-margin"><?php echo Generic::propertyType($property_details['property_type'])?> for <?=$property_details['transaction_type']?></h5>
                                <h3><?=$property_details['location']?><span class="special-color">.</span></h3>
                            </div>
                            <div class="clearfix"></div>
                            <div class="title-separator-primary"></div>
                            <p class="details-desc"><?=$property_details['description']?></p>
                        </div>
                        <!-- Card -->
                        <div class="col-xs-12 col-sm-5 col-md-4">
                            <div class="details-parameters-price">
                                &#2547; <?=$property_details['price']?>
                                <?=$property_details['transaction_type'] === 'Rent' ? '<small style="color:#00b3ee;font-size: medium;">/Per Month</small>' : ''?>
                            </div>
                            <div class="details-parameters">
                                <div class="details-parameters-cont">
                                    <div class="details-parameters-name">area</div>
                                    <div class="details-parameters-val"><?=$property_details['area']?><?=Generic::propertyUnit($property_details['property_type'])?></div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php if($property_details['property_type'] == 1 || $property_details['property_type'] == 2){?>
                                    <div class="details-parameters-cont">
                                        <div class="details-parameters-name">bedrooms</div>
                                        <div class="details-parameters-val"><?=$property_details['bedrooms']?></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="details-parameters-cont">
                                        <div class="details-parameters-name">bathrooms</div>
                                        <div class="details-parameters-val"><?=$property_details['bathrooms']?></div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } elseif($property_details['property_type'] == 3){?>
                                    <div class="details-parameters-cont">
                                        <div class="details-parameters-name">rooms</div>
                                        <div class="details-parameters-val"><?=$property_details['rooms']?></div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- Features -->
                    <div class="row margin-top-45">
                        <div class="col-xs-6 col-sm-4">
                            <ul class="details-ticks">
                                <?php if($property_meta['air_conditioning'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Air conditioning</li>
                                <?php } if($property_meta['internet'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Internet</li>
                                <?php } if($property_meta['cable_tv'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Cable TV</li>
                                <?php } if($property_meta['balcony'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Balcony</li>
                                <?php } if($property_meta['roof_terrace'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Roof Terrace</li>
                                <?php } if($property_meta['terrace'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Terrace</li>
                                <?php } if($property_meta['lift'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Lift</li>
                                <?php } if($property_meta['garage'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Garage</li>
                                <?php } if($property_meta['security'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Security</li>
                                <?php } if($property_meta['high_standard'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>High standard</li>
                                <?php } if($property_meta['city_center'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>City center</li>
                                <?php } if($property_meta['furniture'] == 1){?>
                                    <li><i class="jfont">&#xe815;</i>Furniture</li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="row margin-top-45">
                        <div class="col-xs-12 apartment-tabs">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tab-map" aria-controls="tab-map" role="tab" data-toggle="tab">
                                        <span>Map</span>
                                        <div class="button-triangle2"></div>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab-street-view" aria-controls="tab-street-view" role="tab" data-toggle="tab">
                                        <span>Street view</span>
                                        <div class="button-triangle2"></div>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tab-map">
                                    <div id="estate-map" class="details-map"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="tab-street-view">
                                    <div id="estate-street-view" class="details-map"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="row margin-top-60">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-9">
                                    <h3 class="title-negative-margin">contact the agent<span class="special-color">.</span></h3>
                                </div>
                                <div class="col-xs-3">
                                    <a href="#report-modal" data-toggle="modal" class="btn btn-danger pull-right" title="Report This Property">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
                                    </a>
                                </div>
                            </div>
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>
                    <div class="row margin-top-60">
                        <div class="col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-0">
                            <h5 class="subtitle-margin">manager</h5>
                            <h3 class="title-negative-margin"><?=$agent->name ? $agent->name : 'Guest' ?><span class="special-color">.</span></h3>
                            <a href="<?=$base_url?>agency-details/<?=$agent->id?>" class="agent-photo">
                                <img src="<?=$agent->photo ? $agent->photo : $base_url.'images/no-image.jpg' ?>" alt="" class="img-responsive" />
                            </a>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <div class="agent-social-bar">
                                <div class="pull-left">
									<span class="agent-icon-circle">
										<i class="fa fa-phone"></i>
									</span>
                                    <span class="agent-bar-text">
                                        <?=$agent->phone ? $agent->phone : 'Not Available' ?>
                                    </span>
                                </div>
                                <div class="pull-left">
									<span class="agent-icon-circle">
										<i class="fa fa-envelope fa-sm"></i>
									</span>
                                    <span class="agent-bar-text">
                                        <a href="mailto:<?=$agent->email ? $agent->email : 'admin@lanoyo.com' ?>?Subject=Lanoyo.com:%20Response%20To%20<?=Generic::propertyType($property_details['property_type'])?>%20For%20<?=ucfirst($property_details['transaction_type'])?>" target="_top">Send Your Message</a>
                                    </span>
                                </div>
                                <div class="pull-right">
                                    <div class="pull-right">
                                        <a class="agent-icon-circle" href="<?=$social_link->facebook_url ? $social_link->facebook_url : '#' ?>">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="agent-icon-circle icon-margin" href="<?=$social_link->twitter_url ? $social_link->twitter_url : '#' ?>">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="agent-icon-circle icon-margin" href="<?=$social_link->google_url ? $social_link->google_url : '#' ?>">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="agent-icon-circle icon-margin" href="<?=$social_link->skype_url ? $social_link->skype_url : '#' ?>">
                                            <i class="fa fa-skype"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <!-- Message Form -->
                            <!--<form name="contact-from" action="#">-->
                            <?php $form = ActiveForm::begin(['id' => 'contact-from']); ?>
                                <input name="name" id="name" type="text" class="input-short main-input" placeholder="Your name" />
                                <input name="phone" id="phone" type="text" class="input-short pull-right main-input" placeholder="Your phone" />
                                <input name="email" id="email" type="email" class="input-full main-input" placeholder="Your email" />
                                <!-- Hidden -->
                                <input name="receiver" id="receiver" type="hidden" value="<?=$property_details['user_id'] ? $property_details['user_id'] : '' ?>" />
                                <input name="property_id" id="property_id" type="hidden" value="<?=$property_details['id'] ? $property_details['id'] : '' ?>" />
                                <textarea name="message" id="message" class="input-full agent-textarea main-input" placeholder="Your message"></textarea>
                                <div class="form-submit-cont">
                                    <a href="javascript:void(0)" class="button-primary pull-right" id="msg-form-submit">
                                        <span>send</span>
                                        <div class="button-triangle"></div>
                                        <div class="button-triangle2"></div>
                                        <div class="button-icon"><i class="fa fa-paper-plane"></i></div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                            <?php ActiveForm::end(); ?>
                            <br>
                            <div id="form-result"></div>
                            <!-- Message Form -->

                        </div>
                    </div>
                    <!-- Contact -->

                    <!-- New Listing -->
                    <div class="row margin-top-90">
                        <div class="col-xs-12 col-sm-9">
                            <h5 class="subtitle-margin">hot</h5>
                            <h1>new listings<span class="special-color">.</span></h1>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <a href="#" class="navigation-box navigation-box-next" id="short-offers-owl-next"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div></a>
                            <a href="#" class="navigation-box navigation-box-prev" id="short-offers-owl-prev"><div class="navigation-triangle"></div><div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div></a>
                        </div>
                        <div class="col-xs-12">
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>
                    <div class="short-offers-container">
                        <div class="owl-carousel" id="short-offers-owl">
                            <?php
                            $counter = 1;
                            foreach($all_property as $property){
                                $location = str_replace([' '], '-', $property['location']);
                                ?>
                            <div class="grid-offer-col">
                                <div class="grid-offer">
                                    <div class="grid-offer-front">

                                        <div class="grid-offer-photo">
                                            <img src="<?php echo json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg';?>" alt="" width="262" height="177"/>
                                            <div class="type-container">
                                                <div class="estate-type"><?php echo Generic::propertyType($property['property_type'])?></div>
                                                <div class="transaction-type"><?=$property['transaction_type']?></div>
                                            </div>
                                        </div>
                                        <div class="grid-offer-text">
                                            <i class="fa fa-map-marker grid-offer-localization"></i>
                                            <div class="grid-offer-h4">
                                                <div class="croptext" style="height: 38px;">
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
                                                <img src="<?=$base_url?>images/area-icon.png" alt="" width="17" height="17"/><?=$property['area']?><?=Generic::propertyUnit($property['property_type'])?>
                                            </div>
                                            <?php if($property['property_type'] == 1 || $property['property_type'] == 2){?>
                                                <div class="grid-rooms">
                                                    <img src="<?=$base_url?>images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['bedrooms']?>
                                                </div>
                                                <div class="grid-baths">
                                                    <img src="<?=$base_url?>images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$property['bathrooms']?>
                                                </div>
                                            <?php } elseif ($property['property_type'] == 3){?>
                                                <div class="grid-rooms">
                                                    <img src="<?=$base_url?>images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['rooms']?>
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
                    <div class="margin-top-45"></div>
                    <!-- New Listing -->
                </div>

                <div class="col-xs-12 col-md-3">
                    <?php
                        #Narrow Search
                        echo $this->render('../elements/narrow_search',array(
                            'heading'=> 'Narrow Search',
                            'transaction_type'=> $property_details['transaction_type'] ? $property_details['transaction_type'] : '',
                            'property_type'=> $property_details['property_type'] ? $property_details['property_type'] : '',
                            'searched_city'=> $property_details['city'] ? (int)$property_details['city'] : ''
                        ));

                        /*echo $this->render('../elements/narrow_search');*/
                    ?>
                    <div class="sidebar">
                        <div class="sidebar-title-cont">
                            <h4 class="sidebar-title">featured offers<span class="special-color">.</span></h4>
                            <div class="title-separator-primary"></div>
                        </div>
                        <div class="sidebar-featured-cont">
                            <?php foreach($featured_property as $property){
                                $location = str_replace([' '], '-', $property['location']);
                                ?>
                            <div class="sidebar-featured">
                                <a class="sidebar-featured-image" href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>">
                                    <img src="<?php echo json_decode($property['image'])[0]?>" alt="" />
                                </a>
                                <div class="sidebar-featured-title"><a href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>"><?=$property['location']?></a></div>
                                <div class="sidebar-featured-price">&#2547; <?=$property['price']?></div>
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

<!-- Report modal -->
<div class="modal fade apartment-modal" id="report-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title">
                    <h4>
                        <i class="fa fa-exclamation-triangle"></i>
                        Report This <?php echo Generic::propertyType($property_details['property_type'])?>
                        <span class="special-color">.</span>
                    </h4>
                    <div class="short-title-separator"></div>
                </div>
                <h4 class="signup_info"></h4>

                <?php $form = ActiveForm::begin(['id' => 'report-form']); ?>
                <div id="report-result"></div>
                <input name="report_name" id="report_name" type="text" class="input-full main-input" placeholder="Your Name" value="" />
                <input name="report_email" id="report_email" type="email" class="input-full main-input" placeholder="Your Email" value="" />
                <input name="report_phone" id="report_phone" type="text" class="input-full main-input" placeholder="Your Phone" value="" />
                <input name="report_property_id" id="report_property_id" type="hidden" value="<?=$property_details['id'] ? $property_details['id'] : '' ?>" />
                <textarea name="report_reason" id="report_reason" class="input-full agent-textarea main-input" placeholder="What's Wrong ?"></textarea>

                <a href="javascript:void(0)" class="button-primary button-shadow button-full" id="report-button">
                    <span>Report</span>
                    <div class="button-triangle"></div>
                    <div class="button-triangle2"></div>
                    <div class="button-icon"><i class="fa fa-exclamation-triangle"></i></div>
                </a>
                <?php ActiveForm::end(); ?>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        mapInit(<?=$property_details['latitude']?>,<?=$property_details['longitude']?>,"estate-map","<?=$base_url?><?php Generic::propertyMapMarkerImage($property_details['property_type'])?>", true);
        streetViewInit(<?=$property_details['latitude']?>,<?=$property_details['longitude']?>,"estate-street-view");

        <?php
         $counter = 1;
         foreach($all_property as $property){?>
        mapInit(<?=$property['latitude']?>,<?=$property['longitude']?>,"grid-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($property['property_type'])?>", false);
        <?php
         $counter++;
         } ?>
    }
</script>