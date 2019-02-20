<?php
use yii\widgets\ActiveForm;
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

                                <div class="inner">
                                    <div class="basic-card">
                                        <h3>Please choose a payment method</h3>
                                        <div class="inner border">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-8">
                                                        <?php $form = ActiveForm::begin(['id' => 'payment-confirmation-form','options' => ['enctype'=>'multipart/form-data']]); ?>
                                                        <div class="form-group">
                                                            <label for="credit_card"><input type="radio" name="payment" id="credit_card" value="1"> <img src="/images/credit-card-logo.png" height="54"> </label><br>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="marketing_representative"><input type="radio" name="payment" id="marketing_representative" value="3"> <img src="/images/cod_logo.jpg" height="52"> </label><br>
                                                            <div class="form-group" id="direct_payment_block" style="display: none">
                                                                <br>
                                                                <div class="">
                                                                    <input class="form-input input-full main-input" type="text" id="seller_id" name="seller_id" placeholder="Type your saler Id" style="width: 60%">
                                                                </div>
                                                                <br>
                                                                <div class="">
                                                                    <input class="form-input number_input input-full main-input" type="text" id="advanced_payment" name="advanced_payment" placeholder="Enter deposit amount" style="width: 60%">
                                                                </div>
                                                            </div>

                                                        </div><br>
<!--                                                        <input type="checkbox" id="agreeIndividual" name="agree" required checked/> <label for="agreeIndividual">I agree all the <a href="--><?php //echo Yii::$app->urlManager->createUrl('/terms-&-conditions');?><!--" target="_blank">Terms & Conditions</a></label>-->
                                                        <div class="form-group">

                                                        </div>
                                                        <div align="left" id="update_name_status"></div>
                                                        <input type="hidden" name="plan_id" id="plan_id" value="<?= $plan ?>">
                                                        <button type="submit" class="button-primary button-shadow button-full" id="payment-selection-submit" style="width: 200px;">
                                                            <span>Submit</span>
                                                            <div class="button-triangle"></div>
                                                            <div class="button-triangle2"></div>
                                                            <div class="button-icon"><i class="fa fa-user"></i></div>
                                                        </button>
                                                    <?php ActiveForm::end(); ?>
                                                </div>
                                                <div class="col-xs-12 col-md-4 billing-info">
                                                    <div class="form-group">
                                                        <h3 style="text-align: center;text-decoration: underline;color: #FE9C00">Billing Information</h3>
                                                    </div>
                                                    <?php if($user_details->user_type == 2) { ?>
                                                    <div class="form-group bill-info">
                                                        <h5 style="color: #0083c9"><?=strtoupper('sdfdsa')?></h5>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="form-group bill-info">
                                                        <span><?=strtoupper($user_details->name)?></span>
                                                    </div>
                                                    <div class="form-group bill-info">
                                                        <span><?=$user_details->address ?></span>
                                                    </div>
                                                    <div class="form-group bill-info">
                                                        <span><?=$user_details->phone ?></span>
                                                    </div>
                                                    <div class="form-group bill-info">

                                                        <span><?=strtoupper($plan_details->name)?> / <?=strtoupper($plan_details->duration)?></span>
                                                    </div>

                                                    <div class="form-group bill-info">
                                                        <span>&#2547; <?=$plan_details->price ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--basic-card-->

                                </div>
                    </div>
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
                    <!--
                    <div class="sidebar-left">
                        <h3 class="sidebar-title margin-top-60">Your offers<span class="special-color">.</span></h3>
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
                            'heading'=>'Your Offers',
                            'left'=> true,
                            'margin_top'=> 60
                        ));
                        /*echo $this->render('../elements/narrow_search');*/
                    ?>
                </div>
            </div>
        </div>
    </section>

</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaFb-9fPEhBUj2YvbstHFTDm9qwOGMmgg&amp;libraries=places"></script>