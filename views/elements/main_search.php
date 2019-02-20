<?php
    /**
     * main_search.php
     */
    use yii\widgets\ActiveForm;
    use app\components\Generic;
    use app\helpers\CountryCityHelper;
    use app\helpers\UserHelper;

    //Determine Country
    Generic::determineCountry();
    $region_token = Yii::$app->session->get('region_token');
    $user_helper = new UserHelper();
    $country = $user_helper->getUserCountry($region_token);

    //Determine cities
    $data = new CountryCityHelper();
    $cities = $data->getCity($country->id);
?>
<section class="adv-search-section no-padding">
    <div id="offers-map"></div>
    <!-- <form class="adv-search-form" action="#"> -->
    <?php $form = ActiveForm::begin(['class' => 'adv-search-form','action'=>Yii::$app->urlManager->createUrl(array('search-result')),'method' => 'get']); ?>
    <div class="adv-search-cont">
        <!-- Navigation -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-11 adv-search-icons">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs adv-search-tabs" role="tablist">
                        <li role="presentation" class="<?= isset($prop_type) ? ($prop_type == 1 ? 'active' : '') : '' ?>" data-toggle="tooltip" data-placement="top" title="apartments">
                            <a href="#apartments" aria-controls="apartments" role="tab" data-toggle="tab" id="adv-search-tab1" onclick="prop_identify(1)">
                                <i class="fa fa-building"></i>
                            </a>
                        </li>
                        <li role="presentation" class="<?= isset($prop_type) ? ($prop_type == 2 ? 'active' : '') : '' ?>" data-toggle="tooltip" data-placement="top" title="houses">
                            <a href="#houses" aria-controls="houses" role="tab" data-toggle="tab" id="adv-search-tab2" onclick="prop_identify(2)">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li role="presentation" class="<?= isset($prop_type) ? ($prop_type == 3 ? 'active' : '') : '' ?>" data-toggle="tooltip" data-placement="top" title="commercials">
                            <a href="#commercials" aria-controls="commercials" role="tab" data-toggle="tab" id="adv-search-tab3" onclick="prop_identify(3)">
                                <i class="fa fa-industry"></i>
                            </a>
                        </li>
                        <li role="presentation" class="<?= isset($prop_type) ? ($prop_type == 4 ? 'active' : '') : '' ?>" data-toggle="tooltip" data-placement="top" title="lands">
                            <a href="#lands" aria-controls="lands" role="tab" data-toggle="tab" id="adv-search-tab4" onclick="prop_identify(4)">
                                <i class="fa fa-tree"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-1 visible-lg">
                    <a id="adv-search-hide" href="#"><i class="jfont">&#xe801;</i></a>
                </div>
            </div>
        </div>
        <!-- Fields -->
        <div class="container">
            <div class="row tab-content">
                <input type="hidden" value="<?= isset($prop_type) ? $prop_type : 1 ?>" id="property_identifier" name="prop_id">
                <!-- Apartments -->
                <div role="tabpanel" class="col-xs-12 adv-search-outer tab-pane fade <?= isset($prop_type) ? ($prop_type == 1 ? 'in active' : '') : '' ?>" id="apartments">
                    <div class="row">
                        <!-- Transaction -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="transaction1" class="bootstrap-select" title="Transaction:">
                                <option value="Sale" <?=isset($transaction_type) ? ($transaction_type == 'Sale' ? 'selected' : '') : '' ?>>For sale</option>
                                <option value="Rent" <?=isset($transaction_type) ? ($transaction_type == 'Rent' ? 'selected' : '') : '' ?>>For rent</option>
                            </select>
                        </div>
                        <!-- Country -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="country1" class="bootstrap-select" title="Country:" data-actions-box="true">
                                <option value="<?=$country->id?>" selected><?=$country->name?></option>
                            </select>
                        </div>
                        <!-- City -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="city1" class="bootstrap-select cities" title="City:" data-actions-box="true">
                                <?php
                                foreach($cities as $city) {
                                    ?>
                                    <option value="<?=$city->id?>" <?= isset($searched_city) ? ($city->id == $searched_city ? 'selected' : '') : '' ?>><?=$city->name?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Location -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <!--
                            <select name="location1" class="bootstrap-select" title="Location:" data-actions-box="true">
                                <option value="lc1">Some location 1</option>
                                <option value="lc2">Some location 2</option>
                                <option value="lc3">Some location 3</option>
                                <option value="lc4">Some location 4</option>
                            </select>
                            -->
                            <div style="margin-top: 18%;">
                                <input id="autocomplete1" onFocus="geolocate()" name="location1" type="text" style="color: #000;font-family:Arial, FontAwesome" class="input-full main-input" placeholder="&#xf041; Location:" value="<?=isset($searched_city) ? (isset($prop_location) ? $prop_location : '') : '' ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Price -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-price1-value" class="adv-search-label">Price:</label>
                                <span>&#2547;</span>
                                <input type="text" name="price1" id="slider-range-price1-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-price1" data-min="0" data-max="300000" class="slider-range"></div>
                            </div>
                        </div>
                        <!-- Area -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-area1-value" class="adv-search-label">Area:</label>
                                <span>sft</span>
                                <input type="text" name="area1" id="slider-range-area1-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-area1" data-min="0" data-max="2000" class="slider-range"></div>
                            </div>
                        </div>
                        <!-- Bed Rooms -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-bedrooms1-value" class="adv-search-label">Bedrooms:</label>
                                <input type="text" name="bed1" id="slider-range-bedrooms1-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-bedrooms1" data-min="1" data-max="10" class="slider-range"></div>
                            </div>
                        </div>
                        <!-- Bath Rooms -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-bathrooms1-value" class="adv-search-label">Bathrooms:</label>
                                <input type="text" name="bath1" id="slider-range-bathrooms1-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-bathrooms1" data-min="1" data-max="4" class="slider-range"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Houses -->
                <div role="tabpanel" class="col-xs-12 adv-search-outer tab-pane fade <?= isset($prop_type) ? ($prop_type == 2 ? 'in active' : '') : '' ?>" id="houses">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="transaction2" class="bootstrap-select" title="Transaction:">
                                <option value="Sale" <?=isset($transaction_type) ? ($transaction_type == 'Sale' ? 'selected' : '') : '' ?>>For sale</option>
                                <option value="Rent" <?=isset($transaction_type) ? ($transaction_type == 'Rent' ? 'selected' : '') : '' ?>>For rent</option>
                            </select>
                        </div>
                        <!-- Country -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="country2" class="bootstrap-select" title="Country:" data-actions-box="true">
                                <option value="<?=$country->id?>" selected><?=$country->name?></option>
                            </select>
                        </div>
                        <!-- City -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="city2" class="bootstrap-select cities" title="City:" data-actions-box="true">
                                <?php
                                foreach($cities as $city) {
                                    ?>
                                    <option value="<?=$city->id?>" <?= isset($searched_city) ? ($city->id == $searched_city ? 'selected' : '') : '' ?>><?=$city->name?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <!--
                            <select name="location1" class="bootstrap-select" title="Location:" data-actions-box="true">
                                <option value="lc1">Some location 1</option>
                                <option value="lc2">Some location 2</option>
                                <option value="lc3">Some location 3</option>
                                <option value="lc4">Some location 4</option>
                            </select>
                            -->
                            <div style="margin-top: 18%;">
                                <input id="autocomplete2" onFocus="geolocate()" name="location2" type="text" style="color: #000;font-family:Arial, FontAwesome" class="input-full main-input" placeholder="&#xf041; Location:" value="<?=isset($searched_city) ? (isset($prop_location) ? $prop_location : '') : '' ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-price2-value" class="adv-search-label">Price:</label>
                                <span>&#2547;</span>
                                <input type="text" name="price2" id="slider-range-price2-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-price2" data-min="0" data-max="300000" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-area2-value" class="adv-search-label">Area:</label>
                                <span>sft</span>
                                <input type="text" name="area2" id="slider-range-area2-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-area2" data-min="0" data-max="2000" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-bedrooms2-value" class="adv-search-label">Bedrooms:</label>
                                <input type="text" name="bed2" id="slider-range-bedrooms2-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-bedrooms2" data-min="1" data-max="10" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-bathrooms2-value" class="adv-search-label">Bathrooms:</label>
                                <input type="text" name="bath2" id="slider-range-bathrooms2-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-bathrooms2" data-min="1" data-max="4" class="slider-range"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Commercials -->
                <div role="tabpanel" class="col-xs-12 adv-search-outer tab-pane fade <?= isset($prop_type) ? ($prop_type == 3 ? 'in active' : '') : '' ?>" id="commercials">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="transaction3" class="bootstrap-select" title="Transaction:">
                                <option value="Sale" <?=isset($transaction_type) ? ($transaction_type == 'Sale' ? 'selected' : '') : '' ?>>For sale</option>
                                <option value="Rent" <?=isset($transaction_type) ? ($transaction_type == 'Rent' ? 'selected' : '') : '' ?>>For rent</option>
                            </select>
                        </div>
                        <!-- Country -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="country3" class="bootstrap-select" title="Country:" data-actions-box="true">
                                <option value="<?=$country->id?>" selected><?=$country->name?></option>
                            </select>
                        </div>
                        <!-- City -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="city3" class="bootstrap-select cities" title="City:" data-actions-box="true">
                                <?php
                                foreach($cities as $city) {
                                    ?>
                                    <option value="<?=$city->id?>" <?= isset($searched_city) ? ($city->id == $searched_city ? 'selected' : '') : '' ?>><?=$city->name?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <!--
                            <select name="location1" class="bootstrap-select" title="Location:" data-actions-box="true">
                                <option value="lc1">Some location 1</option>
                                <option value="lc2">Some location 2</option>
                                <option value="lc3">Some location 3</option>
                                <option value="lc4">Some location 4</option>
                            </select>
                            -->
                            <div style="margin-top: 18%;">
                                <input id="autocomplete3" onFocus="geolocate()" name="location3" type="text" style="color: #000;font-family:Arial, FontAwesome" class="input-full main-input" placeholder="&#xf041; Location:" value="<?=isset($searched_city) ? (isset($prop_location) ? $prop_location : '') : '' ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="type3" class="bootstrap-select short-margin" title="Type:">
                                <option value="shop">Shop/service</option>
                                <option value="factory">Factory</option>
                                <option value="wearhouse">Warehouse</option>
                                <option value="office">Office</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-price3-value" class="adv-search-label">Price:</label>
                                <span>&#2547;</span>
                                <input type="text" name="price3" id="slider-range-price3-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-price3" data-min="0" data-max="300000" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-area3-value" class="adv-search-label">Area:</label>
                                <span>m<sup>2</sup></span>
                                <input type="text" name="area3" id="slider-range-area3-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-area3" data-min="0" data-max="180" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-bedrooms3-value" class="adv-search-label">Rooms:</label>
                                <input type="text" name="room3" id="slider-range-bedrooms3-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-bedrooms3" data-min="1" data-max="10" class="slider-range"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lands -->
                <div role="tabpanel" class="col-xs-12 adv-search-outer tab-pane fade <?= isset($prop_type) ? ($prop_type == 4 ? 'in active' : '') : '' ?>" id="lands">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="transaction4" class="bootstrap-select" title="Transaction:">
                                <option value="Sale" <?=isset($transaction_type) ? ($transaction_type == 'Sale' ? 'selected' : '') : '' ?>>For sale</option>
                                <option value="Rent" <?=isset($transaction_type) ? ($transaction_type == 'Rent' ? 'selected' : '') : '' ?>>For rent</option>
                            </select>
                        </div>
                        <!-- Country -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="country4" class="bootstrap-select" title="Country:" data-actions-box="true">
                                <option value="<?=$country->id?>" selected><?=$country->name?></option>
                            </select>
                        </div>
                        <!-- City -->
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="city4" class="bootstrap-select cities" title="City:" data-actions-box="true">
                                <?php
                                foreach($cities as $city) {
                                    ?>
                                    <option value="<?=$city->id?>" <?= isset($searched_city) ? ($city->id == $searched_city ? 'selected' : '') : '' ?>><?=$city->name?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <!--
                            <select name="location1" class="bootstrap-select" title="Location:" data-actions-box="true">
                                <option value="lc1">Some location 1</option>
                                <option value="lc2">Some location 2</option>
                                <option value="lc3">Some location 3</option>
                                <option value="lc4">Some location 4</option>
                            </select>
                            -->
                            <div style="margin-top: 18%;">
                                <input id="autocomplete4" onFocus="geolocate()" name="location4" type="text" style="color: #000;font-family:Arial, FontAwesome" class="input-full main-input" placeholder="&#xf041; Location:" value="<?=isset($searched_city) ? (isset($prop_location) ? $prop_location : '') : '' ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <select name="type4" class="bootstrap-select short-margin" title="Type:">
                                <option value="field">Field</option>
                                <option value="recreation">Recreational</option>
                                <option value="orchard">Orchard</option>
                                <option value="forest">Forest</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-price4-value" class="adv-search-label">Price:</label>
                                <span>&#2547;</span>
                                <input type="text" name="price4" id="slider-range-price4-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-price4" data-min="0" data-max="300000" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">
                            <div class="adv-search-range-cont">
                                <label for="slider-range-area4-value" class="adv-search-label">Area:</label>
                                <span>ha</span>
                                <input type="text" name="area4" id="slider-range-area4-value" readonly class="adv-search-amount">
                                <div class="clearfix"></div>
                                <div id="slider-range-area4" data-min="0" data-max="500" class="slider-range"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-3">

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Search Button -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-3 col-md-offset-6 col-lg-offset-9 adv-search-button-cont">
                    <button type="submit" class="button-primary pull-right">
                        <span>search</span>
                        <div class="button-triangle"></div>
                        <div class="button-triangle2"></div>
                        <div class="button-icon"><i class="fa fa-search"></i></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</section>