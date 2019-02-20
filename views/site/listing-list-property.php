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
                                <a class="view-box" href="<?=$base_url.$property_type?>"><img src="<?=$base_url?>images/grid-icon.png" alt=""/></a>
                                <a class="view-box view-box-active"><img src="<?=$base_url?>images/list-icon.png" alt=""/></a>
                            </div>
                            <div class="order-by-container">
                                <select name="sort" class="bootstrap-select" title="Order By:" onchange="window.location=this.value">
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => $property_type,'filter' => 'price_low_to_high'))?>">Price low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => $property_type,'filter' => 'price_high_to_low'))?>">Price high to low</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => $property_type,'filter' => 'area_low_to_high'))?>">Area low to high</option>
                                    <option value="<?=Url::base().Yii::$app->urlManager->createUrl(array('filter-list','property_type' => $property_type,'filter' => 'area_high_to_low'))?>">Area high to low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>
                    <div class="row list-offer-row">
                        <div class="col-xs-12 col-md-9">
                            <?php
                            $counter = 1;
                            foreach($all_property as $property){
                                $location = str_replace([' '], '-', $property['location']);?>
                            <div class="list-offer">
                                <div class="list-offer-left">
                                    <div class="list-offer-front">

                                        <div class="list-offer-photo">
                                            <img src="<?= json_decode($property['image'])[0] ? json_decode($property['image'])[0] : $base_url.'images/no-image.jpg'?>" alt="Image" width="262" height="177"/>
                                            <div class="type-container">
                                                <div class="estate-type"><?php echo Generic::propertyType($property['property_type'])?></div>
                                                <div class="transaction-type"><?=$property['transaction_type']?></div>
                                            </div>
                                        </div>
                                        <div class="list-offer-params">
                                            <div class="list-area">
                                                <img src="<?=$base_url?>images/area-icon.png" alt="" width="17" height="17"/><?=$property['area']?><?=Generic::propertyUnit($property['property_type'])?>
                                            </div>
                                            <div class="list-rooms">
                                                <img src="<?=$base_url?>images/rooms-icon.png" alt="" width="21" height="17"/><?=$property['bedrooms']?>
                                            </div>
                                            <div class="list-baths">
                                                <img src="<?=$base_url?>images/bathrooms-icon.png" alt="" width="22" height="21"/><?=$property['bathrooms']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-offer-back">
                                        <div id="list-map<?=$counter?>" class="list-offer-map"></div>
                                    </div>
                                </div>
                                <a class="list-offer-right-large" href="<?=$base_url?><?php echo Generic::propertyType($property['property_type'])?>/<?=$property['id']."--".str_replace([','], '', $location)?>">
                                    <div class="list-offer-text">
                                        <i class="fa fa-map-marker list-offer-localization hidden-xs"></i>
                                        <div class="list-offer-h4">
                                            <div class="croptext">
                                                <h4 class="list-offer-title"><?=$property['location']?></h4>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <?php if(strlen($property['description']) > 240) $property['description'] = substr($property['description'], 0, 240).'...'; echo $property['description'];?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="price-list-cont">
                                        <div class="list-price">
                                            &#2547; <?=$property['price']?>
                                        </div>
                                    </div>
                                </a>
                                <div class="clearfix"></div>
                            </div>
                            <?php
                            $counter++;
                            } ?>

                            <div class="clearfix"></div>

                        </div>
                        <div class="col-xs-12 col-md-3">
                            <?php
                            #Narrow Search
                            echo $this->render('../elements/narrow_search',array(
                                'heading'=>'Narrow Search',
                                'margin_top' => 30,
                            ));
                            /*echo $this->render('../elements/narrow_search');*/
                            ?>
                        </div>
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
    var autocomplete,autocomplete1,autocomplete2,autocomplete3,autocomplete4;

    function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('narrow_location')),
            {types: ['geocode']}
        );
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
        offersMapInit("offers-map",locations);

        <?php
         $counter = 1;
         foreach($all_property as $property){?>

        mapInit(<?=$property['latitude']?>,<?=$property['longitude']?>,"list-map<?=$counter?>","<?=$base_url?><?php Generic::propertyMapMarkerImage($property['property_type'])?>", false);

        <?php
         $counter++;
         } ?>
    }
</script>