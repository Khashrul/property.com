<?php
use app\components\Generic;
use yii\helpers\Url;

$base_url = Url::home(true);
?>
<div id="wrapper">

    <section class="short-image no-padding agency">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 short-image-title">
                    <h5 class="subtitle-margin second-color">more</h5>
                    <h1 class="second-color">about us</h1>
                    <div class="short-title-separator"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-light section-top-shadow no-bottom-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="details-title pull-left">
                                <h3 class="title-negative-margin"><?php echo $agency->name ?><span class="special-color">.</span></h3>
                                <div class="details-agency-address">
                                    <i class="fa fa-map-marker"></i>
                                    <span><?php echo $agency->location ?></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="title-separator-primary"></div>

                            <div class="row margin-top-60">
                                <div class="col-xs-12 col-sm-6 col-lg-4">
                                    <img src="<?php echo $agency->logo ?>" alt="" width="260" />
                                    <div class="details-parameters agency-details margin-top-60">
                                        <div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-phone"></i>
											</span>
                                            <span><?php echo $agency->phone1 ?></span>
                                        </div>
                                        <div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-phone"></i>
											</span>
                                            <span><?php echo $agent_information->phone2 ?></span>
                                        </div>
                                        <div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-envelope fa-sm"></i>
											</span>
                                            <span><a href="#"><?php echo $agency->email ?></a></span>
                                        </div>
                                        <div class="team-desc-line">
											<span class="agent-icon-circle">
												<i class="fa fa-globe"></i>
											</span>
                                            <span><a href="<?php echo $agent_information->website_url ?>" target="_blank"><?php echo $agent_information->website_url ?></a></span>
                                        </div>
                                        <div class="team-social-cont">
                                            <div class="team-social">
                                                <a class="agent-icon-circle" href="<?php echo $agency->facebook_link ?>">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="agent-icon-circle" href="<?php echo $agency->twitter_link ?>">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="agent-icon-circle" href="<?php echo $agency->gmail_link ?>">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </div>
                                            <div class="team-social">
                                                <a class="agent-icon-circle" href="<?php echo $agency->skype_link ?>">
                                                    <i class="fa fa-skype"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-8">
                                    <?php echo $agency->description ?>
                                </div>
                            </div>
                            <div class="row margin-top-60">
                                <div class="col-xs-12 col-sm-6">
                                    <div id="agency-map" class="agency-map"></div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <form name="contact-from" action="#">
                                        <input name="name" type="text" class="input-full main-input" placeholder="Your name" />
                                        <input name="phone" type="text" class="input-full main-input" placeholder="Your phone" />
                                        <input name="mail" type="email" class="input-full main-input" placeholder="Your email" />
                                        <textarea name="message" class="input-full agent-textarea main-input" placeholder="Your question"></textarea>
                                        <div class="form-submit-cont">
                                            <a href="#" class="button-primary pull-right">
                                                <span>send</span>
                                                <div class="button-triangle"></div>
                                                <div class="button-triangle2"></div>
                                                <div class="button-icon"><i class="fa fa-paper-plane"></i></div>
                                            </a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row margin-top-90">
                        <div class="col-xs-12 col-sm-9">
                            <h5 class="subtitle-margin">TOP</h5>
                            <h1>AGENCY OFFERS<span class="special-color">.</span></h1>
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
                            <?php foreach($agency_offers as $offer){ ?>
                            <div class="grid-offer-col">
                                <div class="grid-offer">
                                    <div class="grid-offer-front">

                                        <div class="grid-offer-photo">
                                            <img src="<?php echo json_decode($offer->image)[0] ? json_decode($offer->image)[0] : $base_url.'images/no-image.jpg'  ?>" alt="" />
                                            <div class="type-container">
                                                <div class="estate-type"><?php echo \app\components\Generic::propertyType($offer->property_type) ?></div>
                                                <div class="transaction-type"><?php echo $offer->transaction_type ?></div>
                                            </div>
                                        </div>
                                        <div class="grid-offer-text">
                                            <i class="fa fa-map-marker grid-offer-localization"></i>
                                            <div class="grid-offer-h4"><h4 class="grid-offer-title"><?php echo $offer->location ?></h4></div>
                                            <div class="clearfix"></div>
                                            <?php if(strlen($offer->description) > 40) $offer->description = substr($offer->description, 0, 40).'...'; echo $offer->description;?>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="price-grid-cont">
                                            <div class="grid-price-label pull-left">Price:</div>
                                            <div class="grid-price pull-right">
                                                $ <?php echo $offer->price ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="grid-offer-params">
                                            <div class="grid-area">
                                                <img src="/images/area-icon.png" alt="" width="17" height="17"/><?=$offer->area?>m<sup>2</sup>
                                            </div>
                                            <?php if($offer->property_type == 1 || $offer->property_type == 2){?>
                                                <div class="grid-rooms">
                                                    <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$offer->bedrooms?>
                                                </div>
                                                <div class="grid-baths">
                                                    <img src="/images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$offer->bathrooms?>
                                                </div>
                                            <?php } elseif ($offer->property_type == 3){?>
                                                <div class="grid-rooms">
                                                    <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$offer->rooms?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                    </div>
                                    <div class="grid-offer-back">
                                        <div id="grid-map1" class="grid-offer-map"></div>
                                        <div class="button">
                                            <a href="<?=$base_url?><?php echo Generic::propertyType($offer->property_type)?>/<?=$offer->id."--".str_replace([','], '', $offer->location)?>" class="button-primary">
                                                <span>read more</span>
                                                <div class="button-triangle"></div>
                                                <div class="button-triangle2"></div>
                                                <div class="button-icon"><i class="fa fa-search"></i></div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>


                </div>
                <div class="col-xs-12 col-md-3">
                    <!--
                    <div class="sidebar">
                        <h3 class="sidebar-title">narrow search<span class="special-color">.</span></h3>
                        <div class="title-separator-primary"></div>

                        <div class="sidebar-select-cont">
                            <select name="transaction1" class="bootstrap-select" title="Transaction:" multiple>
                                <option>For sale</option>
                                <option>For rent</option>
                            </select>
                            <select name="conuntry1" class="bootstrap-select" title="Country:" multiple data-actions-box="true">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Mexico</option>
                            </select>
                            <select name="city1" class="bootstrap-select" title="City:" multiple data-actions-box="true">
                                <option>New York</option>
                                <option>Los Angeles</option>
                                <option>Chicago</option>
                                <option>Houston</option>
                                <option>Philadelphia</option>
                                <option>Phoenix</option>
                                <option>Washington</option>
                                <option>Salt Lake Cty</option>
                                <option>Detroit</option>
                                <option>Boston</option>
                            </select>
                            <select name="location1" class="bootstrap-select" title="Location:" multiple data-actions-box="true">
                                <option>Some location 1</option>
                                <option>Some location 2</option>
                                <option>Some location 3</option>
                                <option>Some location 4</option>
                            </select>
                        </div>
                        <div class="adv-search-range-cont">
                            <label for="slider-range-price-sidebar-value" class="adv-search-label">Price:</label>
                            <span>$</span>
                            <input type="text" id="slider-range-price-sidebar-value" readonly class="adv-search-amount">
                            <div class="clearfix"></div>
                            <div id="slider-range-price-sidebar" data-min="0" data-max="300000" class="slider-range"></div>
                        </div>
                        <div class="adv-search-range-cont">
                            <label for="slider-range-area-sidebar-value" class="adv-search-label">Area:</label>
                            <span>m<sup>2</sup></span>
                            <input type="text" id="slider-range-area-sidebar-value" readonly class="adv-search-amount">
                            <div class="clearfix"></div>
                            <div id="slider-range-area-sidebar" data-min="0" data-max="180" class="slider-range"></div>
                        </div>
                        <div class="adv-search-range-cont">
                            <label for="slider-range-bedrooms-sidebar-value" class="adv-search-label">Bedrooms:</label>
                            <input type="text" id="slider-range-bedrooms-sidebar-value" readonly class="adv-search-amount">
                            <div class="clearfix"></div>
                            <div id="slider-range-bedrooms-sidebar" data-min="1" data-max="10" class="slider-range"></div>
                        </div>
                        <div class="adv-search-range-cont">
                            <label for="slider-range-bathrooms-sidebar-value" class="adv-search-label">Bathrooms:</label>
                            <input type="text" id="slider-range-bathrooms-sidebar-value" readonly class="adv-search-amount">
                            <div class="clearfix"></div>
                            <div id="slider-range-bathrooms-sidebar" data-min="1" data-max="4" class="slider-range"></div>
                        </div>
                        <div class="sidebar-search-button-cont">
                            <a href="#" class="button-primary">
                                <span>search</span>
                                <div class="button-triangle"></div>
                                <div class="button-triangle2"></div>
                                <div class="button-icon"><i class="fa fa-search"></i></div>
                            </a>
                        </div>
                    </div>
                    -->
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
                                $location = str_replace([' '], '-', $property['location']);
                                ?>
                                <div class="sidebar-featured">
                                    <a class="sidebar-featured-image" href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>">
                                        <img src="<?php echo json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'; ?>" alt="" height="95" />
                                        <div class="sidebar-featured-type">
                                            <div class="sidebar-featured-estate"><?php \app\components\Generic::propertyTypeAlias($property['property_type']); ?></div>
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

<!-- google maps initialization -->
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        mapInit(<?php echo $agency->latitude ?>,<?php echo $agency->longitude ?>,"agency-map","images/pin-house.png", true);
    }
</script>