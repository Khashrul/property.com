<?php
use yii\widgets\ActiveForm;
$this->title = 'lanoyo.com';
?>

<div id="wrapper">

    <section class="short-image no-padding blog-short-title">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-12 short-image-title">
                    <h5 class="subtitle-margin second-color">add listing</h5>
                    <h1 class="second-color">my account</h1>
                    <div class="short-title-separator"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-light section-top-shadow">

            <?php $form = ActiveForm::begin(['id' => 'offer-form','action' => 'javascript:void(0)']); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <h3 class="title-negative-margin">Listing details<span class="special-color">.</span></h3>
                        <div class="title-separator-primary"></div>
                        <div class="dark-col margin-top-60">
                            <div class="row">

                                <div class="col-xs-12 col-sm-6">
                                    <select id="property_type" name="property_type" class="bootstrap-select" title="Property type:" required>
                                        <option value="1">Apartment</option>
                                        <option value="2">House</option>
                                        <option value="3">Commercial</option>
                                        <option value="4">Land</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-6 margin-top-xs-15">
                                    <select id="transaction_type" name="transaction_type" class="bootstrap-select" title="Transaction:" required>
                                        <option value="Sale">For sale</option>
                                        <option value="Rent">For rent</option>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-6 margin-top-15">
                                    <input id="price" name="price" type="text" class="input-full main-input number_input" placeholder="Price" required/>
                                </div>
                                <div class="col-xs-12 col-sm-6 margin-top-15 margin-top-xs-0">
                                    <input id="area" name="area" type="text" class="input-full main-input number_input" placeholder="Area" required/>
                                </div>
                                <div id="bedrooms_block" class="col-xs-12 col-sm-6">
                                    <input id="bedrooms" name="bedrooms" type="text" class="input-full main-input number_input" placeholder="Bedrooms" />
                                </div>
                                <div id="bathrooms_block" class="col-xs-12 col-sm-6">
                                    <input id="bathrooms" name="bathrooms" type="text" class="input-full main-input number_input" placeholder="Bathrooms" />
                                </div>
                                <div id="rooms_block" class="col-xs-12 col-sm-6" style="display: none">
                                    <input id="rooms" name="rooms" type="text" class="input-full main-input number_input" placeholder="rooms" />
                                </div>

                                <div id="commercial" class="col-xs-12 col-sm-6" style="display: none">
                                    <select id="commercial_type" name="commercial_type" class="bootstrap-select short-margin" title="Type:">
                                        <option value="shop">Shop/service</option>
                                        <option value="factory">Factory</option>
                                        <option value="warehouse">Warehouse</option>
                                        <option value="office">Office</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div id="land" class="col-xs-12 col-sm-6" style="display: none;margin-bottom: 15px">
                                    <select id="land_type" name="land_type" class="bootstrap-select short-margin" title="Type:">
                                        <option value="field">Field</option>
                                        <option value="recreational">Recreational</option>
                                        <option value="orchard">Orchard</option>
                                        <option value="forest">Forest</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <textarea id="description" name="description" class="input-full main-input property-textarea" placeholder="Description" required></textarea>
                            <div id="property_meta" class="row">
                                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                    <input type="checkbox" id="c1" name="air_condition" class="main-checkbox" value="1"/>
                                    <label for="c1"><span></span>Air Conditioning</label><br/>
                                    <input type="checkbox" id="c2" name="internet" class="main-checkbox" value="1"/>
                                    <label for="c2"><span></span>Internet</label><br/>
                                    <input type="checkbox" id="c3" name="cable_tv" class="main-checkbox" value="1"/>
                                    <label for="c3"><span></span>Cable TV</label><br/>
                                    <input type="checkbox" id="c4" name="balcony" class="main-checkbox" value="1"/>
                                    <label for="c4"><span></span>Balcony</label><br/>
                                    <input type="checkbox" id="c5" name="roof_terrace" class="main-checkbox" value="1"/>
                                    <label for="c5"><span></span>Roof Terrace</label><br/>
                                    <input type="checkbox" id="c6" name="terrace" class="main-checkbox" value="1"/>
                                    <label for="c6"><span></span>Terrace</label>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                    <input type="checkbox" id="c7" name="lift" class="main-checkbox" value="1"/>
                                    <label for="c7"><span></span>Lift</label><br/>
                                    <input type="checkbox" id="c8" name="garage" class="main-checkbox" value="1"/>
                                    <label for="c8"><span></span>Garage</label><br/>
                                    <input type="checkbox" id="c9" name="security" class="main-checkbox" value="1"/>
                                    <label for="c9"><span></span>Security</label><br/>
                                    <input type="checkbox" id="c10" name="high_standard" class="main-checkbox" value="1"/>
                                    <label for="c10"><span></span>High Standard</label><br/>
                                    <input type="checkbox" id="c11" name="city_center" class="main-checkbox" value="1"/>
                                    <label for="c11"><span></span>City Centre</label><br/>
                                    <input type="checkbox" id="c12" name="furniture" class="main-checkbox" value="1"/>
                                    <label for="c12"><span></span>Furniture</label>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                    <input type="checkbox" id="c13" name="another_option_1" class="main-checkbox" value="1"/>
                                    <label for="c13"><span></span>Another Option</label><br/>
                                    <input type="checkbox" id="c14" name="another_option_2" class="main-checkbox" value="1"/>
                                    <label for="c14"><span></span>Another Option</label><br/>
                                    <input type="checkbox" id="c15" name="another_option_3" class="main-checkbox" value="1"/>
                                    <label for="c15"><span></span>Another Option</label><br/>
                                    <input type="checkbox" id="c16" name="another_option_4" class="main-checkbox" value="1"/>
                                    <label for="c16"><span></span>Another Option</label><br/>
                                    <input type="checkbox" id="c17" name="another_option_5" class="main-checkbox" value="1"/>
                                    <label for="c17"><span></span>Another Option</label><br/>
                                    <input type="checkbox" id="c18" name="another_option_6" class="main-checkbox" value="1"/>
                                    <label for="c18"><span></span>Another Option</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 margin-top-xs-60 margin-top-sm-60">
                        <h3 class="title-negative-margin">Localization<span class="special-color">.</span></h3>
                        <div class="title-separator-primary"></div>
                        <div class="dark-col margin-top-60">
                            <input id="geocomplete" name="geocomplete" type="text" class="input-full main-input" placeholder="Localization" />
                            <p class="negative-margin bold-indent">Or drag the marker to property position<p>
                            <div id="submit-property-map" class="submit-property-map"></div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 margin-top-15">
                                    <input id="lng" name="lng" type="text" class="input-full main-input input-last" placeholder="Longitude" readonly="readonly" required />
                                </div>
                                <div class="col-xs-12 col-sm-6 margin-top-15">
                                    <input id="lat" name="lat" type="text" class="input-full main-input input-last" placeholder="Latitude" readonly="readonly" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 margin-top-60">
                        <h3 class="title-negative-margin">gallery<span class="special-color">.</span></h3>
                        <div class="title-separator-primary"></div>
                    </div>
                    <div class="col-xs-12 margin-top-60">
                        <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                        <input type="hidden" name="image_file" value="" id="image_file" >
<!--                        <input id="file-upload" name="files[]" type="file" multiple>-->
                    </div>

                    <div class="col-xs-12" style="margin-top: 40px">
<!--                        --><?php //if($subscribed_plan->price == 0){ ?>
<!--                        <h3>Do you want to make your property featured? </h3>-->
<!--                        <input class="checkbox" type="checkbox" id="featured" name="featured" value="0"/>-->
<!--                        <label for="featured"></label>-->
<!--                        --><?php //} ?>
                        <div class="center-button-cont margin-top-60">
                            <button type="submit" id="property-submit" class="button-primary button-shadow property-submit-btn">
                                <span>submit property</span>
                                <div class="button-triangle"></div>
                                <div class="button-triangle2"></div>
                                <div class="button-icon"><i class="fa fa-lg fa-home"></i></div>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <?php ActiveForm::end(); ?>
    </section>

</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaFb-9fPEhBUj2YvbstHFTDm9qwOGMmgg&amp;libraries=places"></script>
