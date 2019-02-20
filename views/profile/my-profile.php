<?php
use app\components\Generic;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
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
                        <div class="success_info">
                            <div class="col-xs-12 text-center">
                                <?= Yii::$app->session->getFlash('success-container'); ?>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <h5 class="subtitle-margin">edit</h5>
                            <h1>Profile<span class="special-color">.</span></h1>
                            <div class="title-separator-primary"></div>
                        </div>
                    </div>

                        <div class="row margin-top-60">

                            <div class="col-xs-6 col-xs-offset-3 col-sm-offset-0 col-sm-3 col-md-4">
                                <?php $form = ActiveForm::begin(['id' => 'my-profile-form-image','action' => 'profile/changeagentimage','options' => ['enctype'=>'multipart/form-data']
                                ]); ?>
                                <h4>Profile photo</h4><br>
                                <div class="agent-photos">
                                    <img src="<?php echo $user_details->photo ?  $user_details->photo : '/images/no-image.jpg' ?>" id="agent-profile-photo" class="img-responsive" alt="" />
                                    <div class="change-photo">
                                        <i class="fa fa-pencil fa-lg"></i>
                                        <input type="file" name="agent-photo" id="agent-photo" />
                                    </div>
                                    <input type="text" disabled="disabled" id="agent-file-name" class="main-input" />
                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php if($user_details->user_type == 2){ ?>
                                <br><br>
                                <h4>Company Logo</h4><br>
                                <?php $form = ActiveForm::begin(['id' => 'company-form-image','action' => 'profile/changecompanyimage','options' => ['enctype'=>'multipart/form-data']
                                ]); ?>

                                    <div class="agent-photos">
                                        <img src="<?php echo $company->logo ?  $company->logo : '/images/no-image.jpg' ?>" id="company-profile-logo" class="img-responsive" alt="" />
                                        <div class="change-photo">
                                            <i class="fa fa-pencil fa-lg"></i>
                                            <input type="file" name="company-logo" id="company-logo" />
                                        </div>
                                    </div>

                                <?php ActiveForm::end(); ?>
                                <?php } ?>
                            </div>


                            <?php $form = ActiveForm::begin(['id' => 'my-profile-form','action' => 'javascript:void(0)','options' => ['enctype'=>'multipart/form-data']]); ?>
                            <div class="col-xs-12 col-sm-9 col-md-8">
                                <div class="labelled-input">
                                    <label for="full_name">Full name</label><input id="full_name" name="full_name" type="text" class="input-full main-input" placeholder="" value="<?=$user_details->name?>" readonly/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="labelled-input">
                                    <label for="email">Email</label><input id="email" name="email" type="email" class="input-full main-input" placeholder="" value="<?=$user_details->email?>" readonly/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="labelled-input">
                                    <label for="phone">Phone</label><input id="phone" name="phone" type="tel" class="input-full main-input" placeholder="" value="<?=$user_details->phone?>" readonly/>
                                    <div class="clearfix"></div>
                                </div>
                                <?php if($user_details->user_type == 2){?>
                                <div class="labelled-input">
                                    <label for="mobile">Mobile</label><input id="mobile" name="mobile" type="tel" class="input-full main-input" placeholder="" value="<?=$user_details->phone2?>"/>
                                    <div class="clearfix"></div>
                                </div>

                                <div class="labelled-input">
                                    <label for="website_url">Website Url</label><input id="website_url" name="website_url" type="tel" class="input-full main-input" placeholder="" value="<?=$user_details->website_url?>"/>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                                <div class="labelled-input last">
                                    <label for="address">Address</label><input id="address" name="address" type="text" class="input-full main-input" placeholder="" value="<?=$user_details->address?>"/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="labelled-input last">
                                    <label for="date_of_birth">Date of Birth</label><input id="date_of_birth" name="date_of_birth" type="text" class="input-full main-input" placeholder="" value="<?=$user_details->date_of_birth?>"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-15">
                            <div class="col-xs-12">
                                <div class="labelled-textarea">
                                    <?php if($user_details->user_type == 1){?>
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="input-full main-input"><?=$user_details->description?></textarea>
                                    <?php } else {?>
                                        <label for="about_us">About us</label>
                                        <textarea id="about_us" name="about_us" class="input-full main-input"><?=$user_details->about_us?></textarea>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row margin-top-30">
                            <div class="col-xs-12 col-lg-6">
                                <div class="labelled-input-short">
                                    <label for="facebook">
									<span class="label-icon-circle pull-left">
										<i class="fa fa-facebook"></i>
									</span>
                                        Facebook
                                    </label>
                                    <input id="facebook" name="facebook" type="text" class="input-full main-input" placeholder="" value="<?=Generic::getSocialLinks($user_details->social_link)['facebook_url']?>"/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="labelled-input-short">
                                    <label for="gplus">
									<span class="label-icon-circle pull-left">
										<i class="fa fa-google-plus"></i>
									</span>
                                        Google +
                                    </label>
                                    <input id="gplus" name="gplus" type="text" class="input-full main-input" placeholder="" value="<?=Generic::getSocialLinks($user_details->social_link)['google_url']?>"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-6">
                                <div class="labelled-input-short">
                                    <label for="twitter">
									<span class="label-icon-circle pull-left">
										<i class="fa fa-twitter"></i>
									</span>
                                        Twitter
                                    </label>
                                    <input id="twitter" name="twitter" type="text" class="input-full main-input" placeholder="" value="<?=Generic::getSocialLinks($user_details->social_link)['twitter_url']?>"/>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="labelled-input-short">
                                    <label for="skype">
									<span class="label-icon-circle pull-left">
										<i class="fa fa-skype"></i>
									</span>
                                        Skype
                                    </label>
                                    <input id="skype" name="skype" type="text" class="input-full main-input" placeholder="" value="<?=Generic::getSocialLinks($user_details->social_link)['skype_url']?>"/>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <?php if($user_details->user_type != 1){?>
                        <div class="row margin-top-15">
                            <div class="col-xs-12">
                                <div class="center-button-cont center-button-cont-border">
                                    <div class="labelled-input">
                                        <label for="company_name">Company Name</label><input id="company_name" name="company_name" type="text" class="input-full main-input" placeholder="" value="<?=$company->name?>"/>
                                        <div class="clearfix"></div>
                                    </div>
                                    <input id="geocomplete" name="geocomplete" type="text" class="input-full main-input" value="<?=$company->location?>" placeholder="Localization" />
                                    <p class="negative-margin bold-indent">Or drag the marker to property position<p>
                                    <div id="submit-property-map" class="submit-property-map"></div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 margin-top-15">
                                            <input id="lng" name="lng" type="text" class="input-full main-input input-last" value="<?=$company->longitude?>" placeholder="Longitude" readonly="readonly" required />
                                        </div>
                                        <div class="col-xs-12 col-sm-6 margin-top-15">
                                            <input id="lat" name="lat" type="text" class="input-full main-input input-last" value="<?=$company->latitude?>" placeholder="Latitude" readonly="readonly" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                        <div class="row margin-top-15">
                            <div class="col-xs-12">
                                <div class="center-button-cont center-button-cont-border">
                                    <a href="javascript:void(0);" class="button-primary button-shadow button-full reset-password-link" style="width: 40%;margin-bottom: 30px">
                                        <span>Reset password</span>
                                        <div class="button-triangle"></div>
                                        <div class="button-triangle2"></div>
                                        <div class="button-icon"><i class="fa fa-user"></i></div>
                                    </a>
                                    <div align="center" id="reset_password_sent_status"></div>
                                    <button type="submit" id="profile-update" class="button-primary button-shadow">
                                        <span>save</span>
                                        <div class="button-triangle"></div>
                                        <div class="button-triangle2"></div>
                                        <div class="button-icon"><i class="fa fa-lg fa-floppy-o"></i></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <div class="row margin-top-60"></div>
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

                        #Narrow Search
                        echo $this->render('../elements/narrow_search',array(
                            'heading'=>'Your Offers',
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