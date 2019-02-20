<?php
use yii\widgets\ActiveForm;
use app\helpers\UserHelper;

$region_token = Yii::$app->session->get('region_token');
$user_helper = new UserHelper();
$country = $user_helper->getUserCountry($region_token);

?>

<footer class="large-cont">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-lg-4">
                <h4 class="second-color">contact us<span class="special-color">.</span></h4>
                <div class="footer-title-separator"></div>
                <address>
                    <span><i class="fa fa-map-marker"></i>Tribune Tower (8th Floor), 2-B kda avenue, Khulna-9100, Bangladesh</span>
                    <div class="footer-separator"></div>
                    <span><i class="fa fa-envelope fa-sm"></i><a href="#">info@lanoyo.com</a></span>
                    <div class="footer-separator"></div>
                    <span><i class="fa fa-phone"></i>041-731839</span>
                </address>
                <div class="clear"></div>
            </div>
            <div class="col-xs-6 col-sm-6 col-lg-4">
                <h4 class="second-color">quick links<span class="special-color">.</span></h4>
                <div class="footer-title-separator"></div>
                <ul class="footer-ul">
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['/']) ?>">Home</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['#']) ?>">Listing</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['agencies-listing']) ?>">Agencies</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['contact-us']) ?>">Contact us</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['submit-property']) ?>">Submit property</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['price-plan']) ?>">Pricing plan</a></li>
                    <li><span class="custom-ul-bullet"></span><a href="<?= Yii::$app->urlManager->createUrl(['terms-&-conditions']) ?>">Terms & Conditions</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-lg-4">
                <h4 class="second-color">newsletter<span class="special-color">.</span></h4>
                <div class="footer-title-separator"></div>
                <p class="footer-p">Subscribe with your email to get regular updates.</p>
                <form class="form-inline footer-newsletter">
                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="enter your email">
                    <button type="submit" class="btn"><i class="fa fa-lg fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</footer>
<footer class="small-cont">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6 small-cont">
                <img src="/images/logo-light.png" alt="" class="img-responsive footer-logo" width="152" height="80"/>
            </div>
            <div class="col-xs-12 col-md-6 footer-copyrights">
                &copy; Copyright 2017. All rights reserved. Powered by <a href="http://lanoyo.com/" target="_blank">DEWY IT LTD</a>.
            </div>
        </div>
    </div>
</footer>

<div class="move-top">
    <div class="big-triangle-second-color"></div>
    <div class="big-icon-second-color"><i class="jfont fa-lg">&#xe803;</i></div>
</div>

<!-- Login modal -->
<div class="modal fade apartment-modal" id="login-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title">
                    <h1>Login<span class="special-color">.</span></h1>
                    <div class="short-title-separator"></div>
                </div>
                <h4 class="login_info"></h4>
                <?php $form = ActiveForm::begin(['id' => 'login-form','action' => 'javascript:void(0)']); ?>
                <input name="phone" type="tel" class="input-full main-input" placeholder="Phone" required/>
                <input name="password" type="password" class="input-full main-input" placeholder="Your Password" required/>
                <button type="submit" class="button-primary button-shadow button-full user-login-button">
                    <span>Sign In</span>
                    <div class="button-triangle"></div>
                    <div class="button-triangle2"></div>
                    <div class="button-icon"><i class="fa fa-user"></i></div>
                </button>
                <?php ActiveForm::end(); ?>
                <a href="#forgot-modal" class="forgot-link pull-right">Forgot your password?</a>
                <div class="clearfix"></div>
                <p class="login-or">OR</p>
                <a href="#" class="facebook-button">
                    <i class="fa fa-facebook"></i>
                    <span>Login with Facebook</span>
                </a>
                <a href="#" class="google-button margin-top-15">
                    <i class="fa fa-google-plus"></i>
                    <span>Login with Google</span>
                </a>
                <p class="modal-bottom">Don't have an account? <a href="#" class="register-link">REGISTER</a></p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Register modal -->
<div class="modal fade apartment-modal" id="register-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title">
                    <h1 id="register-form-heading">Register<span class="special-color">.</span></h1>
                    <div class="short-title-separator"></div>
                </div>
                <h4 class="signup_info"></h4>

                <div class="register_section">
                    <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>
                    <input name="first-name" type="text" class="input-full main-input" placeholder="Full name"
                           value=""/>
                    <input name="phone" type="tel" class="input-full main-input" placeholder="Phone" value=""/>
                    <input name="password" type="password" class="input-full main-input" placeholder="Password"
                           value=""/>
                    <input name="repeat-password" type="password" class="input-full main-input"
                           placeholder="Repeat Password" value=""/>
<!--                    <input name="phone" id="phone_number_personal" type="text" class="input-full main-input number_input" placeholder="Phone" value="+--><?//=$country['phonecode']?><!--"/>-->
<!--                    <input name="phone_number_personal_hidden" id="phone_number_personal_hidden" type="hidden" class="" value="+--><?//=$country['phonecode']?><!--"/>-->
                    <input type="checkbox" id="c1" name="user_type" class="main-checkbox" value="1" checked/>
                    <label for="c1" style="padding: 15px 40px"><span></span>Owner</label>
                    <input type="checkbox" id="c2" name="user_type" class="main-checkbox" value="2"/>
                    <label for="c2"><span></span>Agency</label>
                    <a href="#" class="button-primary button-shadow button-full" id="register-user-button">
                        <span>Sign up</span>

                        <div class="button-triangle"></div>
                        <div class="button-triangle2"></div>
                        <div class="button-icon"><i class="fa fa-user"></i></div>
                    </a>
                    <?php ActiveForm::end(); ?>
                    <div class="clearfix"></div>
                    <p class="login-or">OR</p>
                    <a href="#" class="facebook-button">
                        <i class="fa fa-facebook"></i>
                        <span>Sign Up with Facebook</span>
                    </a>
                    <a href="#" class="google-button margin-top-15">
                        <i class="fa fa-google-plus"></i>
                        <span>Sign Up with Google</span>
                    </a>

                    <p class="modal-bottom">Already registered? <a href="#" class="login-link">SIGN IN</a></p>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Forgotten password modal -->
<div class="modal fade apartment-modal" id="forgot-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'forget-password-form','action' => 'javascript:void(0)']); ?>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title">
                    <h1>Forgot your password<span class="special-color">?</span></h1>
                    <div class="short-title-separator"></div>
                </div>
                <p class="negative-margin forgot-info">Insert your account email address.<br/>We will send you a link to reset your password.</p>
                <input name="forget-email-id" id="forget-email-id" type="email" class="input-full main-input" placeholder="Your email" />
                <a href="javascript:void(0);" class="forget-password-link button-primary button-shadow button-full" style="margin-bottom: 30px">
                    <span>Reset password</span>
                    <div class="button-triangle"></div>
                    <div class="button-triangle2"></div>
                    <div class="button-icon"><i class="fa fa-user"></i></div>
                </a>
                <div align="center" id="reset_password_sent_status"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->