<?php
use yii\helpers\Url;
use app\components\Generic;

$this->title = 'Search Results';

$base_url = Url::home(true);

$prop_type = $searched_city = $transaction_type = $prop_location = '';
#Searched Terms (array)
$prop_type = $terms[0];
$transaction_type = $terms[1];
$searched_city = $terms[3];
$prop_location = $terms[4];
?>

<div id="wrapper">

    <?php
    #Main Search
    echo $this->render('../elements/main_search',array(
        'prop_type' =>  $prop_type,
        'transaction_type' => $transaction_type,
        'searched_city' => $searched_city,
        'prop_location' => $prop_location
    ));
    ?>

    <section class="section-light section-top-shadow">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-9">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <h5 class="subtitle-margin">
                                <?= $prop_type ? Generic::propertyType($prop_type) : 'Search' ?>
                                <?=$transaction_type ? 'For '.$transaction_type : 'In' ?>
                                <?=$city_name ? ($prop_location ? ', '.$prop_location : ''): '' ?>
                                <?=$city_name ? ', '.$city_name.', ' : '' ?>
                                <?=$country->name ? $country->name : '' ?>
                            </h5>
                            <h1 style="margin-left: -6px;">
                                <?=count($properties)?>
                                <?= $prop_type ? Generic::propertyType($prop_type).(count($properties) > 1 ? 's' : '') : 'Property' ?> found.
                                <span class="special-color">.</span>
                            </h1>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="view-icons-container">
                                <a class="view-box" href="<?=$base_url?><?php switch($prop_type){case 1:echo 'apartment';break; case 2:echo 'house';break; case 3: echo 'commercial';break; case 4: echo 'land';break;} ?>">
                                    <img src="images/grid-icon.png" alt=""/>
                                </a>
                                <a class="view-box view-box-active">
                                    <img src="images/list-icon.png" alt=""/>
                                </a>
                            </div>
                            <div class="order-by-container">
                                <select name="sort" class="bootstrap-select" title="Order By:" onchange="window.location=this.value">
                                    <?php
                                    if($prop_type == 1){
                                        ?>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'apartment','filter' => 'price_low_to_high'))?>">Price low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'apartment','filter' => 'price_high_to_low'))?>">Price high to low</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'apartment','filter' => 'area_low_to_high'))?>">Area low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'apartment','filter' => 'area_high_to_low'))?>">Area high to low</option>
                                        <?php
                                    }
                                    elseif($prop_type == 2){
                                        ?>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'house','filter' => 'price_low_to_high'))?>">Price low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'house','filter' => 'price_high_to_low'))?>">Price high to low</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'house','filter' => 'area_low_to_high'))?>">Area low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'house','filter' => 'area_high_to_low'))?>">Area high to low</option>
                                        <?php
                                    }
                                    elseif($prop_type == 3){
                                        ?>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'commercial','filter' => 'price_low_to_high'))?>">Price low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'commercial','filter' => 'price_high_to_low'))?>">Price high to low</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'commercial','filter' => 'area_low_to_high'))?>">Area low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'commercial','filter' => 'area_high_to_low'))?>">Area high to low</option>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'land','filter' => 'price_low_to_high'))?>">Price low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'land','filter' => 'price_high_to_low'))?>">Price high to low</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'land','filter' => 'area_low_to_high'))?>">Area low to high</option>
                                        <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => 'land','filter' => 'area_high_to_low'))?>">Area high to low</option>
                                        <?php
                                    }
                                    ?>
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
                            if($properties){
                                $counter = 1;
                                foreach($properties as $property){ ?>
                                    <div class="list-offer">
                                        <div class="list-offer-left">
                                            <div class="list-offer-front">
                                                <div class="list-offer-photo">
                                                    <!--<img src="images/grid-offer1.jpg" alt="" />-->
                                                    <img src="<?= json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'?>" alt="Image" width="262" height="177" />
                                                    <div class="type-container">
                                                        <div class="estate-type">
                                                            <?php echo Generic::propertyType($property->property_type); ?>
                                                        </div>
                                                        <div class="transaction-type"><?=$property->transaction_type ? $property->transaction_type : '' ?></div>
                                                    </div>
                                                </div>
                                                <div class="list-offer-params">
                                                    <div class="list-area">
                                                        <img src="/images/area-icon.png" alt="" width="17" height="17"/>
                                                        <?=$property->area?><?=Generic::propertyUnit($property->property_type)?>
                                                    </div>
                                                    <div class="list-rooms">
                                                        <img src="/images/rooms-icon.png" alt="" width="21" height="17"/>
                                                        <?=$property->bedrooms ? $property->bedrooms : '' ?>
                                                        <?=$property->rooms ? $property->rooms : '' ?>
                                                    </div>
                                                    <div class="list-baths">
                                                        <img src="/images/bathrooms-icon.png" alt="" width="22" height="21"/>
                                                        <?=$property->bathrooms ? $property->bathrooms : '' ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="list-offer-back">
                                                <div id="list-map<?=$counter?>" class="list-offer-map"></div>
                                            </div>
                                        </div>
                                        <a class="list-offer-right-large" href="<?=$base_url?><?php echo Generic::propertyType($property->property_type)?>/<?=$property->id."--".str_replace([','], '', $property->location)?>">
                                            <div class="list-offer-text">
                                                <i class="fa fa-map-marker list-offer-localization hidden-xs"></i>
                                                <div class="list-offer-h4">
                                                    <div class="croptext" style="height: 48px;">
                                                        <h4 class="list-offer-title">
                                                            <?=$property->location ? $property->location.', ' : '' ?><?=$city_name ? $city_name.', ' : '' ?><?=$country->name ? $country->name : '' ?>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <?=$property->description ? substr($property->description, 0, 120).'...' : '' ?>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="price-list-cont">
                                                <div class="list-price">
                                                    &#2547; <?=$property->price ? $property->price : '' ?>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    $counter++;
                                }
                            }
                            else{
                                ?>
                                <div class="list-offer">
                                    <div class="list-offer-text">
                                        <div class="list-offer-h4">
                                            <h4 class="list-offer-title">No <?= $prop_type ?  Generic::propertyType($prop_type) : 'Property' ?> Found :( </h4>
                                            <h4 class="list-offer-title"><?= empty($transaction_type) ? 'Please Choose A Transaction Type !' : '' ?></h4>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="clearfix"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Pagination currently turned off -->
                    <!--
                    <div class="offer-pagination margin-top-30">
                        <a href="#" class="prev"><i class="jfont">&#xe800;</i></a><a class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#" class="next"><i class="jfont">&#xe802;</i></a>
                        <div class="clearfix"></div>
                    </div>
                    -->
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="sidebar">
                        <div class="sidebar-title-cont">
                            <h4 class="sidebar-title">featured offers<span class="special-color">.</span></h4>
                            <div class="title-separator-primary"></div>
                        </div>
                        <div class="sidebar-featured-cont">
                            <?php foreach($featured_property as $property) { ?>
                                <div class="sidebar-featured">
                                    <a class="sidebar-featured-image" href="estate-details-right-sidebar.html">
                                        <img src="<?php echo json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'; ?>" alt="" />
                                        <div class="sidebar-featured-type">
                                            <div class="sidebar-featured-estate"><?php \app\components\Generic::propertyTypeAlias($property['property_type']); ?></div>
                                            <div class="sidebar-featured-transaction"><?php if($property['transaction_type'] == 'Rent') { echo "R"; }else { echo "S"; } ?></div>
                                        </div>
                                    </a>
                                    <div class="sidebar-featured-title"><a href="estate-details-right-sidebar.html"><?php echo $property['location'] ?></a></div>
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
            <?php foreach($properties as $property){
            $location = str_replace([' '], '-', $property->location);?>
            [<?=$property->latitude?>,<?=$property->longitude?>, "<?=$base_url?><?php Generic::propertyMapMarkerImage($property->property_type)?>", "<?=$base_url?><?php echo Generic::propertyType($property->property_type)?>/<?=$property->id."--".str_replace([','], '', $location)?>", "<?php echo json_decode($property['image'])[0]?>", "<?=$property->location?>", "&#2547; <?=$property->price?>"],
            <?php  } ?>
        ];
        offersMapInit("offers-map",locations);

        <?php
         $counter = 1;
            foreach($properties as $property){
        ?>
        mapInit(<?=$property->latitude?>,<?=$property->longitude?>,"list-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($property->property_type)?>", false);
        <?php
                $counter++;
            }
        ?>
    }
</script>
