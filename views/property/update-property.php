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

        <?php $form = ActiveForm::begin(['id' => 'update-property-form','action' => 'javascript:void(0)']); ?>
        <input type="hidden" name="property_id" id="property_id" value="<?=$property_id?>">
        <input type="hidden" name="meta_id" id="meta_id" value="<?=$property_details['meta_id']?>">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <h3 class="title-negative-margin">Listing details<span class="special-color">.</span></h3>
                    <div class="title-separator-primary"></div>
                    <div class="dark-col margin-top-60">
                        <div class="row">

                            <div class="col-xs-12 col-sm-6">
                                <select id="property_type" name="property_type" class="bootstrap-select" title="Property type:" required>
                                    <option value="1"  <?php echo ($property_details['property_type'] == '1')?"selected":"" ?>>Apartment</option>
                                    <option value="2" <?php echo ($property_details['property_type'] == '2')?"selected":"" ?>>House</option>
                                    <option value="3" <?php echo ($property_details['property_type'] == '3')?"selected":"" ?>>Commercial</option>
                                    <option value="4" <?php echo ($property_details['property_type'] == '4')?"selected":"" ?>>Land</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 margin-top-xs-15">
                                <select id="transaction_type" name="transaction_type" class="bootstrap-select" title="Transaction:" required>
                                    <option value="Sale" <?php echo ($property_details['transaction_type'] == 'Sale')?"selected":"" ?>>For sale</option>
                                    <option value="Rent" <?php echo ($property_details['transaction_type'] == 'Rent')?"selected":"" ?>>For rent</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 margin-top-15">
                                <input id="price" name="price" type="text" class="input-full main-input" placeholder="Price" value="<?=$property_details['price']?>" required/>
                            </div>
                            <div class="col-xs-12 col-sm-6 margin-top-15 margin-top-xs-0">
                                <input id="area" name="area" type="text" class="input-full main-input" placeholder="Area" value="<?=$property_details['area']?>" required/>
                            </div>
                            <div id="bedrooms_block" class="col-xs-12 col-sm-6">
                                <input id="bedrooms" name="bedrooms" type="text" class="input-full main-input" placeholder="Bedrooms" value="<?=$property_details['bedrooms']?>" />
                            </div>
                            <div id="bathrooms_block" class="col-xs-12 col-sm-6">
                                <input id="bathrooms" name="bathrooms" type="text" class="input-full main-input" placeholder="Bathrooms" value="<?=$property_details['bathrooms']?>" />
                            </div>
                            <div id="rooms_block" class="col-xs-12 col-sm-6" style="display: none">
                                <input id="rooms" name="rooms" type="text" class="input-full main-input" placeholder="rooms" value="<?=$property_details['rooms']?>" />
                            </div>

                            <div id="commercial" class="col-xs-12 col-sm-6" style="display: none">
                                <select id="commercial_type" name="commercial_type" class="bootstrap-select short-margin" title="Type:">
                                    <option value="shop" <?php echo ($property_details['commercial_type'] == 'shop')?"selected":"" ?>>Shop/service</option>
                                    <option value="factory" <?php echo ($property_details['commercial_type'] == 'factory')?"selected":"" ?>>Factory</option>
                                    <option value="warehouse" <?php echo ($property_details['commercial_type'] == 'warehouse')?"selected":"" ?>>Warehouse</option>
                                    <option value="office" <?php echo ($property_details['commercial_type'] == 'office')?"selected":"" ?>>Office</option>
                                    <option value="other" <?php echo ($property_details['commercial_type'] == 'other')?"selected":"" ?>>Other</option>
                                </select>
                            </div>

                            <div id="land" class="col-xs-12 col-sm-6" style="display: none;margin-bottom: 15px">
                                <select id="land_type" name="land_type" class="bootstrap-select short-margin" title="Type:">
                                    <option value="field" <?php echo ($property_details['land_type'] == 'field')?"selected":"" ?>>Field</option>
                                    <option value="recreational" <?php echo ($property_details['land_type'] == 'recreational')?"selected":"" ?>>Recreational</option>
                                    <option value="orchard" <?php echo ($property_details['land_type'] == 'orchard')?"selected":"" ?>>Orchard</option>
                                    <option value="forest" <?php echo ($property_details['land_type'] == 'forest')?"selected":"" ?>>Forest</option>
                                    <option value="other" <?php echo ($property_details['land_type'] == 'other')?"selected":"" ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <textarea id="description" name="description" class="input-full main-input property-textarea" placeholder="Description" required><?=$property_details['description']?></textarea>
                        <div id="property_meta" class="row">
                            <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                <input type="checkbox" id="c1" name="air_condition" class="main-checkbox" value="1" <?php echo($property_meta['air_conditioning']==1)?'checked':'';?>/>
                                <label for="c1"><span></span>Air Conditioning</label><br/>
                                <input type="checkbox" id="c2" name="internet" class="main-checkbox" value="1" <?php echo($property_meta['internet']==1)?'checked':'';?>/>
                                <label for="c2"><span></span>Internet</label><br/>
                                <input type="checkbox" id="c3" name="cable_tv" class="main-checkbox" value="1" <?php echo($property_meta['cable_tv']==1)?'checked':'';?>/>
                                <label for="c3"><span></span>Cable TV</label><br/>
                                <input type="checkbox" id="c4" name="balcony" class="main-checkbox" value="1" <?php echo($property_meta['balcony']==1)?'checked':'';?>/>
                                <label for="c4"><span></span>Balcony</label><br/>
                                <input type="checkbox" id="c5" name="roof_terrace" class="main-checkbox" value="1" <?php echo($property_meta['roof_terrace']==1)?'checked':'';?>/>
                                <label for="c5"><span></span>Roof Terrace</label><br/>
                                <input type="checkbox" id="c6" name="terrace" class="main-checkbox" value="1" <?php echo($property_meta['terrace']==1)?'checked':'';?>/>
                                <label for="c6"><span></span>Terrace</label>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                <input type="checkbox" id="c7" name="lift" class="main-checkbox" value="1" <?php echo($property_meta['lift']==1)?'checked':'';?>/>
                                <label for="c7"><span></span>Lift</label><br/>
                                <input type="checkbox" id="c8" name="garage" class="main-checkbox" value="1" <?php echo($property_meta['garage']==1)?'checked':'';?>/>
                                <label for="c8"><span></span>Garage</label><br/>
                                <input type="checkbox" id="c9" name="security" class="main-checkbox" value="1" <?php echo($property_meta['security']==1)?'checked':'';?>/>
                                <label for="c9"><span></span>Security</label><br/>
                                <input type="checkbox" id="c10" name="high_standard" class="main-checkbox" value="1" <?php echo($property_meta['high_standard']==1)?'checked':'';?>/>
                                <label for="c10"><span></span>High Standard</label><br/>
                                <input type="checkbox" id="c11" name="city_center" class="main-checkbox" value="1" <?php echo($property_meta['city_center']==1)?'checked':'';?>/>
                                <label for="c11"><span></span>City Centre</label><br/>
                                <input type="checkbox" id="c12" name="furniture" class="main-checkbox" value="1" <?php echo($property_meta['furniture']==1)?'checked':'';?>/>
                                <label for="c12"><span></span>Furniture</label>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-6 col-lg-4 margin-top-15">
                                <input type="checkbox" id="c13" name="another_option_1" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_1']==1)?'checked':'';?>/>
                                <label for="c13"><span></span>Another Option</label><br/>
                                <input type="checkbox" id="c14" name="another_option_2" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_2']==1)?'checked':'';?>/>
                                <label for="c14"><span></span>Another Option</label><br/>
                                <input type="checkbox" id="c15" name="another_option_3" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_3']==1)?'checked':'';?>/>
                                <label for="c15"><span></span>Another Option</label><br/>
                                <input type="checkbox" id="c16" name="another_option_4" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_4']==1)?'checked':'';?>/>
                                <label for="c16"><span></span>Another Option</label><br/>
                                <input type="checkbox" id="c17" name="another_option_5" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_5']==1)?'checked':'';?>/>
                                <label for="c17"><span></span>Another Option</label><br/>
                                <input type="checkbox" id="c18" name="another_option_6" class="main-checkbox" value="1" <?php echo($property_meta['custom_option_6']==1)?'checked':'';?>/>
                                <label for="c18"><span></span>Another Option</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 margin-top-xs-60 margin-top-sm-60">
                    <h3 class="title-negative-margin">Localization<span class="special-color">.</span></h3>
                    <div class="title-separator-primary"></div>
                    <div class="dark-col margin-top-60">
                        <input id="geocomplete" name="geocomplete" type="text" class="input-full main-input" placeholder="Localization" value="<?=$property_details['location']?>"/>
                        <p class="negative-margin bold-indent">Or drag the marker to property position<p>
                        <div id="submit-property-map" class="submit-property-map"></div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 margin-top-15">
                                <input id="lng" name="lng" type="text" class="input-full main-input input-last" placeholder="Longitude" readonly="readonly" value="<?=$property_details['longitude']?>" required />
                            </div>
                            <div class="col-xs-12 col-sm-6 margin-top-15">
                                <input id="lat" name="lat" type="text" class="input-full main-input input-last" placeholder="Latitude" readonly="readonly" value="<?=$property_details['latitude']?>" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 margin-top-60">
                    <h3 class="title-negative-margin">gallery<span class="special-color">.</span></h3>
                    <div class="title-separator-primary"></div>
                </div>
                <div class="col-xs-12 margin-top-60 image-file-input">
                    <input type="file" name="files[]" id="filer_input2" multiple="multiple">
                    <input type="hidden" name="image_file" value="<?=$image_file?>" id="image_file" >
                    <input type="hidden" name="delete_image_file" id="delete_image_file" />
                    <ul class="image_block" style="float: left;">
                        <?php
                        foreach ($images as $image) {
                            ?>
                            <li>
                                <img src="<?php echo $image
                                ; ?>" />
                                                    <span class="icon-jfi-trash" data-icon="<?php echo $image ?>">
                                                    </span>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div style="clear: both;"></div>
                </div>

                <div class="col-xs-12" style="margin-top: 40px">
<!--                    <h3>Do you want to make your property featured? </h3>-->
<!--                    <input class="checkbox" type="checkbox" id="featured" name="featured" value="--><?php //echo ($property_details['is_featured'] == 1)? 1 : 0;?><!--" --><?php //echo ($property_details['is_featured'] == 1)? 'checked': '';?><!--/>-->
<!--                    <label for="featured"></label>-->
                    <div class="center-button-cont margin-top-60">
                        <button type="submit" id="property-update" class="button-primary button-shadow property-submit-btn">
                            <span>Update property</span>
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
