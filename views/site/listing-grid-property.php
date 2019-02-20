<?php
use yii\helpers\Url;
use app\components\Generic;

$this->title = 'lanoyo.com';

$base_url = Url::home(true);
?>

<div id="wrapper">
    <?php
        #Main Search
        echo $this->render('../elements/main_search',array(
            'prop_type' =>  $all_property[0]['property_type']
        ));
    ?>

    <section class="section-light section-top-shadow">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <h5 class="subtitle-margin"><?=$property_type?></h5>
                            <h1><?=count($all_property)?> estates found<span class="special-color">.</span></h1>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <div class="view-icons-container">
                                <a class="view-box view-box-active"><img src="<?=$base_url?>images/grid-icon.png" alt="" /></a>
                                <a class="view-box" href="<?=$base_url.$property_type?>/list"><img src="<?=$base_url?>images/list-icon.png" alt="" /></a>
                            </div>
                            <div class="order-by-container">
                                <select name="sort" class="bootstrap-select" title="Order By:" onchange="window.location=this.value">
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-grid','property_type' => $property_type,'filter' => 'price_low_to_high'))?>">Price low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-grid','property_type' => $property_type,'filter' => 'price_high_to_low'))?>">Price high to low</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-grid','property_type' => $property_type,'filter' => 'area_low_to_high'))?>">Area low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-grid','property_type' => $property_type,'filter' => 'area_high_to_low'))?>">Area high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>
                    <div class="row grid-offer-row">
                        <?php
                        $counter = 1;
                        foreach($all_property as $property){
                            $location = str_replace([' '], '-', $property['location']);?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 grid-offer-col">
                            <div class="grid-offer">
                                <div class="grid-offer-front">

                                    <div class="grid-offer-photo">
                                        <img src="<?= json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'?>" alt="" width="262" height="197" />
                                        <div class="type-container">
                                            <div class="estate-type"><?php echo Generic::propertyType($property['property_type'])?></div>
                                            <div class="transaction-type"><?=$property['transaction_type']?></div>
                                        </div>
                                    </div>
                                    <div class="grid-offer-text">
                                        <i class="fa fa-map-marker grid-offer-localization"></i>
                                        <div class="grid-offer-h4">
                                            <div class="croptext">
                                                <h4 class="grid-offer-title"><?=$property['location']?></h4>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p><?php if(strlen($property['description']) > 40) $property['description'] = substr($property['description'], 0, 40).'...'; echo $property['description'];?></p>
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
<!--                    <div class="offer-pagination margin-top-30">-->
<!--                        <a href="#" class="prev"><i class="jfont">&#xe800;</i></a><a class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#" class="next"><i class="jfont">&#xe802;</i></a>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
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
            <?php foreach($all_property as $property){
            $location = str_replace([' '], '-', $property['location']);?>
                [<?=$property['latitude']?>,<?=$property['longitude']?>, "<?php Generic::propertyMapMarkerImage($property['property_type'])?>", "<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>", "<?php echo json_decode($property['image'])[0]?>", "<?=$property['location']?>", "&#2547; <?=$property['price']?>"],
            <?php  } ?>
        ];
        offersMapInit("offers-map",locations);
        <?php
         $counter = 1;
         foreach($all_property as $property){?>

        mapInit(<?=$property['latitude']?>,<?=$property['longitude']?>,"grid-map<?=$counter?>","<?php Generic::propertyMapMarkerImage($property['property_type'])?>", false);

        <?php
         $counter++;
         } ?>
    }
</script>