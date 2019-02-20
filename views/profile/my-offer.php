<?php
use yii\helpers\Url;
use app\components\Generic;
$this->title = 'lanoyo.com';
$base_url = Url::home(true);
?>

<div id="wrapper">
    <section class="short-image no-padding blog-short-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 short-image-title">
                    <h5 class="subtitle-margin second-color">dashboard</h5>
                    <h1 class="second-color">my account</h1>
                    <div class="short-title-separator"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-light section-top-shadow">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9 col-md-push-3">
                    <div class="row">
                        <div class="col-xs-12 col-lg-7">
                            <h5 class="subtitle-margin">Your offers</h5>
                            <h1><?=count($user_property);?> estates found<span class="special-color">.</span></h1>
                        </div>
                        <div class="col-xs-12 col-lg-5">
                            <div class="order-by-container">
                                <select name="sort" class="bootstrap-select" title="Order By:" onchange="window.location=this.value">
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('my-offer','filter' => 'price_low_to_high'))?>">Price low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('my-offer','filter' => 'price_high_to_low'))?>">Price high to low</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('my-offer','filter' => 'area_low_to_high'))?>">Area low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('my-offer','filter' => 'area_high_to_low'))?>">Area high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>

                    <div class="row list-offer-row">
                        <div class="col-xs-12">
                            <?php
                            $counter = 1;
                            foreach($user_property as $property){
                                $location = str_replace([' '], '-', $property['location']);?>
                            <div class="list-offer" id="list-offer<?=$property['id']?>">
                                <div class="list-offer-left">
                                    <div class="list-offer-front">

                                        <div class="list-offer-photo">
                                            <img src="<?php echo json_decode($property['image'])[0] ? json_decode($property['image'])[0] : '/images/no-image.jpg' ?>" alt="" width="262" height="177"/>
                                            <div class="type-container">
                                                <div class="estate-type"><?php Generic::propertyType($property['property_type'])?></div>
                                                <div class="transaction-type"><?=$property['transaction_type']?></div>
                                            </div>
                                        </div>
                                        <div class="list-offer-params">
                                            <div class="list-area">
                                                <img src="/images/area-icon.png" alt="" width="17" height="17"/><?=$property['area']?><?=Generic::propertyUnit($property['property_type'])?>
                                            </div>
                                            <?php if($property['property_type'] == 1 || $property['property_type'] == 2){?>
                                                <div class="list-rooms">
                                                    <img src="/images/rooms-icon.png" alt="" width="21" height="17" /><?=$property['bedrooms']?>
                                                </div>
                                                <div class="list-baths">
                                                    <img src="/images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$property['bathrooms']?>
                                                </div>
                                            <?php } elseif ($property['property_type'] == 3){?>
                                                <div class="list-rooms">
                                                    <img src="/images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['rooms']?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="list-offer-back">
                                        <div id="list-map<?=$counter?>" class="list-offer-map"></div>
                                    </div>
                                </div>
                                <div class="list-offer-right">
                                    <div class="list-offer-text">
                                        <i class="fa fa-map-marker list-offer-localization"></i>
                                        <div class="list-offer-h4"><a href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>"><h4 class="list-offer-title"><?=$property['location']?></h4></a></div>
                                        <div class="clearfix"></div>
                                        <a href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>"><?php if(strlen($property['description']) > 200) $property['description'] = substr($property['description'], 0, 200).'...'; echo $property['description'];?></a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="profile-list-footer">
                                        <div class="list-price profile-list-price">
                                            &#2547; <?=$property['price']?>
                                        </div>
                                        <a href="javascript:void(0);" class="profile-list-delete" title="Delete offer" onclick="deleteItem(<?=$property['id']?>)">
                                            <i class="fa fa-trash fa-lg"></i>
                                        </a>
                                        <a href="<?=$base_url?>update-property/<?=$property['id']?>" class="profile-list-edit" title="Edit offer">
                                            <i class="fa fa-pencil fa-lg"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="property-featured <?php echo $property['is_featured'] ? 'selected' : '' ?>" title="<?php echo $property['is_featured'] ? 'Remove from featured list' : 'Mark as featured' ?>" data-item="<?=$property['id']?>">
                                            <i class="fa fa-star fa-lg"></i>
                                        </a>
                                        <div class="profile-list-info hidden-xs">
                                            added: <?php echo date("d/m/Y", strtotime($property['create_datetime']));?>
                                        </div>
                                        <div class="profile-list-info hidden-xs hidden-sm hidden-md">
                                            views: <?php $property_views = Generic::getTotalPropertyView($property['id']);
                                            $view_count = array_sum(array_column($property_views, 'view_count'));
                                            echo $view_count;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php
                            $counter++;
                            } ?>
                        </div>
                    </div>

<!--                    <div class="offer-pagination margin-top-30">-->
<!--                        <a href="#" class="prev"><i class="jfont">&#xe800;</i></a><a class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#" class="next"><i class="jfont">&#xe802;</i></a>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
                </div>
                <div class="col-xs-12 col-md-3 col-md-pull-9">
                    <?php
                        #Top Left
                        echo $this->render('../elements/top_left',array(
                            'left' => true,
                            'heading'=>'Welcome back',
                            'margin_top' => 30,
                            'name' => $user_details->name,
                            'photo' => $user_details->photo,
                            'user_type' => $user_details->user_type
                        ));
                        /*echo $this->render('../elements/top_left');*/
                    ?>
                    <!--<div class="sidebar-left">
                        <h3 class="sidebar-title">Welcome back<span class="special-color">.</span></h3>
                        <div class="title-separator-primary"></div>

                        <div class="profile-info margin-top-60">
                            <div class="profile-info-title negative-margin">Timothy Johnson</div>
                            <img src="images/comment-photo1.jpg" alt="" class="pull-left" />
                            <div class="profile-info-text pull-left">
                                <p class="subtitle-margin">Agent</p>
                                <p class="">42 Estates</p>

                                <a href="#" class="logout-link margin-top-30"><i class="fa fa-lg fa-sign-out"></i>Logout</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="center-button-cont margin-top-30">
                            <a href="my-offers.html" class="button-primary button-shadow button-full">
                                <span>My offers</span>
                                <div class="button-triangle"></div>
                                <div class="button-triangle2"></div>
                                <div class="button-icon"><i class="fa fa-th-list"></i></div>
                            </a>
                        </div>
                        <div class="center-button-cont margin-top-15">
                            <a href="my-profile.html" class="button-primary button-shadow button-full">
                                <span>My profile</span>
                                <div class="button-triangle"></div>
                                <div class="button-triangle2"></div>
                                <div class="button-icon"><i class="fa fa-user"></i></div>
                            </a>
                        </div>
                        <div class="center-button-cont margin-top-15">
                            <a href="submit-property.html" class="button-alternative button-shadow button-full">
                                <span>add property</span>
                                <div class="button-triangle"></div>
                                <div class="button-triangle2"></div>
                                <div class="button-icon"><i class="jfont fa-lg">&#xe804;</i></div>
                            </a>
                        </div>
                    </div>-->
                    <?php
                        #Narrow Search
                        echo $this->render('../elements/narrow_search',array(
                            'heading'=>'Your Offer',
                            'margin_top' => 60,
                            'left' => true
                        ));
                        /*echo $this->render('../elements/narrow_search');*/
                    ?>
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

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        <?php
         $counter = 1;
         foreach($user_property as $property){?>
        mapInit(<?=$property['latitude']?>,<?=$property['longitude']?>,"list-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($property['property_type'])?>", false);
        <?php
        $counter++;
        } ?>
    }
</script>