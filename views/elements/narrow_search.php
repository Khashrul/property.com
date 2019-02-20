<?php
    /**
     * narrow_search.php
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

<!-- Narrow Search Begins -->
<div class="sidebar<?=isset($left) ? ($left ? '-left' : '') : '' ?>">
    <h3 class="sidebar-title <?=isset($margin_top) ? 'margin-top-'.$margin_top : '' ?>"><?=isset($heading) ? $heading : 'narrow search' ?><span class="special-color">.</span></h3>
    <div class="title-separator-primary"></div>
    <?php $form = ActiveForm::begin(['action'=>Yii::$app->urlManager->createUrl(array('search-result')),'method' => 'get']); ?>
        <div class="sidebar-select-cont">
            <!-- Property Type -->
            <select name="prop_id" class="bootstrap-select" title="Property:" id="prop_id" required>
                <option value="1" <?=isset($property_type) ? ($property_type == 1 ? 'selected' : '') : ''?>>Apartment</option>
                <option value="2" <?=isset($property_type) ? ($property_type == 2 ? 'selected' : '') : ''?>>House</option>
                <option value="3" <?=isset($property_type) ? ($property_type == 3 ? 'selected' : '') : ''?>>Commercial</option>
                <option value="4" <?=isset($property_type) ? ($property_type == 4 ? 'selected' : '') : ''?>>Land</option>
            </select>
            <!-- Transaction Type -->
            <select name="transaction<?=isset($property_type) ? $property_type : '1' ?>" class="bootstrap-select" title="Transaction:" id="narrow_transaction">
                <option value="Sale" <?=isset($transaction_type) ? ($transaction_type === 'Sale' ? 'selected' : '') : '' ?>>For sale</option>
                <option value="Rent" <?=isset($transaction_type) ? ($transaction_type === 'Rent' ? 'selected' : '') : '' ?>>For rent</option>
            </select>
            <!-- Country -->
            <select name="country<?=isset($property_type) ? $property_type : '1' ?>" class="bootstrap-select" title="Country:" id="narrow_country">
                <option value="<?=$country->id?>" selected><?=$country->name?></option>
            </select>
            <!-- City -->
            <select name="city<?=isset($property_type) ? $property_type : '1' ?>" class="bootstrap-select" title="City:" data-actions-box="true" id="narrow_city">
                <?php
                foreach($cities as $city) {
                    ?>
                    <option value="<?=$city->id?>" <?=isset($searched_city) ? ($city->id === $searched_city ? 'selected' : '') : '' ?>><?=$city->name?></option>
                    <?php
                }
                ?>
            </select>
            <!-- Location -->
            <!--
            <select name="location<?=isset($property_type) ? $property_type : '1' ?>" class="bootstrap-select" title="Location:" data-actions-box="true" id="narrow_location">
                <option>Some location 1</option>
                <option>Some location 2</option>
                <option>Some location 3</option>
                <option>Some location 4</option>
            </select>
            -->
            <div style="margin-top: 8%;">
                <input id="narrow_location" onFocus="geolocate()" name="location<?=isset($property_type) ? $property_type : '1' ?>" type="text" style="color: #000;font-family:Arial, FontAwesome;padding: 5%;" class="input-full main-input" placeholder="Location:"/>
            </div>
            <!-- Types -->
            <div id="narrow_commercial_type">
                <select name="type3" class="bootstrap-select" title="Type:" data-actions-box="true">
                    <option value="shop">Shop/service</option>
                    <option value="factory">Factory</option>
                    <option value="wearhouse">Warehouse</option>
                    <option value="office">Office</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div id="narrow_land_type">
                <select name="type4" class="bootstrap-select" title="Type:" data-actions-box="true">
                    <option value="field">Field</option>
                    <option value="recreation">Recreational</option>
                    <option value="orchard">Orchard</option>
                    <option value="forest">Forest</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
        <!-- Price -->
        <div class="adv-search-range-cont">
            <label for="slider-range-price-sidebar-value" class="adv-search-label">Price:</label>
            <span>&#2547;</span>
            <input type="text" name="price<?=isset($property_type) ? $property_type : '1' ?>" id="slider-range-price-sidebar-value" readonly class="adv-search-amount">
            <div class="clearfix"></div>
            <div id="slider-range-price-sidebar" data-min="0" data-max="300000" class="slider-range"></div>
        </div>
        <!-- Area -->
        <div class="adv-search-range-cont">
            <label for="slider-range-area-sidebar-value" class="adv-search-label">Area:</label>
            <span id="unit">sft</span>
            <input type="text" name="area<?=isset($property_type) ? $property_type : '1' ?>" id="slider-range-area-sidebar-value" readonly class="adv-search-amount">
            <div class="clearfix"></div>
            <div id="slider-range-area-sidebar" data-min="0" data-max="500" class="slider-range"></div>
        </div>

        <!-- Apartment-House Bedrooms -->
        <div class="adv-search-range-cont" id="apartment_house_bed">
            <label for="slider-range-bedrooms-sidebar-value" class="adv-search-label">Bedrooms:</label>
            <input type="text" name="bed1" id="slider-range-bedrooms-sidebar-value" readonly class="adv-search-amount">
            <div class="clearfix"></div>
            <div id="slider-range-bedrooms-sidebar" data-min="1" data-max="10" class="slider-range"></div>
        </div>
        <!-- Apartment-House Bathrooms -->
        <div class="adv-search-range-cont" id="apartment_house_bath">
            <label for="slider-range-bathrooms-sidebar-value" class="adv-search-label">Bathrooms:</label>
            <input type="text" name="bath1" id="slider-range-bathrooms-sidebar-value" readonly class="adv-search-amount">
            <div class="clearfix"></div>
            <div id="slider-range-bathrooms-sidebar" data-min="1" data-max="4" class="slider-range"></div>
        </div>

        <!-- Commercial Rooms -->
        <div class="adv-search-range-cont" id="commercial_room">
            <label for="slider-range-bedrooms-sidebar-value" class="adv-search-label">Rooms:</label>
            <input type="text" name="room3" id="slider-range-bedrooms3-sidebar-value" readonly class="adv-search-amount">
            <div class="clearfix"></div>
            <div id="slider-range-bedrooms3-sidebar" data-min="1" data-max="10" class="slider-range"></div>
        </div>

        <!-- Search button -->
        <div class="sidebar-search-button-cont">
            <button type="submit" class="button-primary">
                <span>search</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-search"></i></div>
            </button>
        </div>
    <?php ActiveForm::end(); ?>
</div>
<!-- Narrow Search Ends -->
