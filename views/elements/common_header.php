<?php
use yii\helpers\Url;
use app\components\Generic;

$base_url = Url::home(true);?>

<header>
    <div class="top-bar-wrapper">
        <div class="container top-bar">
            <div class="row">
                <div class="col-xs-5 col-sm-8">
                    <div class="top-mail pull-left hidden-xs">
							<span class="top-icon-circle">
								<i class="fa fa-envelope fa-sm"></i>
							</span>
                        <span class="top-bar-text">info@lanoyo.com</span>
                    </div>
                    <div class="top-phone pull-left hidden-xxs">
							<span class="top-icon-circle">
								<i class="fa fa-phone"></i>
							</span>
                        <span class="top-bar-text">(+880)-41-731-839</span>
                    </div>
                    <div class="top-localization pull-left hidden-sm hidden-md hidden-xs">
							<span class="top-icon-circle pull-left">
								<i class="fa fa-map-marker"></i>
							</span>
                        <span class="top-bar-text">Tribune Tower (8th Floor), 2B KDA Avenue, Khulna, Bangladesh</span>
                    </div>
                </div>
                <div class="col-xs-7 col-sm-4">
                    <?php if(!Generic::checkUserDetails()){?>
                    <div class="top-social-last top-dark pull-right" data-toggle="tooltip" data-placement="bottom" title="Login/Register">
                        <a class="top-icon-circle" href="#login-modal" data-toggle="modal">
                            <i class="fa fa-sign-in"></i>
                        </a>
                    </div>
                    <?php } else {?>
                    <div class="top-social-last top-dark pull-right" data-toggle="tooltip" data-placement="bottom" title="Logout">
                        <a class="top-icon-circle" href="<?=Yii::$app->urlManager->createUrl(array('site/userlogout'))?>" title="Logout">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </div>
                    <?php } ?>

                    <div class="top-social pull-right">
                        <a class="top-icon-circle" href="https://www.facebook.com/Lanoyo.co" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </div>
                    <div class="top-social pull-right">
                        <a class="top-icon-circle" href="https://twitter.com/LanoyoOfficial" target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                    </div>
                    <div class="top-social pull-right">
                        <a class="top-icon-circle" href="https://plus.google.com/u/0/116734664439452794849" target="_blank">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                    <div class="top-social pull-right">
                        <a class="top-icon-circle" href="https://www.instagram.com/Lanoyo.co" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- /.top-bar -->
    </div><!-- /.Page top-bar-wrapper -->
    <nav class="navbar main-menu-cont">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar icon-bar1"></span>
                    <span class="icon-bar icon-bar2"></span>
                    <span class="icon-bar icon-bar3"></span>
                </button>
                <a href="<?=$base_url?>" title="" class="navbar-brand">
                    <img src="/images/logo-dark.png" alt="Lanoyo.com" />
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="<?=$base_url?>">Home</a>
                    </li>
                    <?php if(!Generic::checkUserDetails()){?>
                    <li class="dropdown">
                        <a href="#register-modal" data-toggle="modal">Register</a>
                    </li>
                    <li class="dropdown">
                        <a href="#login-modal" data-toggle="modal">Login</a>
                    </li>
                    <?php } else {?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=$base_url?>my-profile">Profile</a></li>
                            <li><a href="<?=$base_url?>my-offer">Offer</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <!--
                    <li class="dropdown">
                        <a href="<?=$base_url?>contact-us">Contact Us</a>
                    </li>
                    -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sale</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('apartment','transaction' => 'sale'))?>">Apartment</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('house','transaction' => 'sale'))?>">House</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('commercial','transaction' => 'sale'))?>">Commercial</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('land','transaction' => 'sale'))?>">Land</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Rent</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('apartment','transaction' => 'rent'))?>">Apartment</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('house','transaction' => 'rent'))?>">House</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('commercial','transaction' => 'rent'))?>">Commercial</a></li>
                            <li><a href="<?=Url::base().Yii::$app->urlManager->createUrl(array('land','transaction' => 'rent'))?>">Land</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="<?=$base_url?>agencies-listing">Agencies</a>
                    </li>
                    <li><a href="<?=$base_url?>submit-property" class="special-color">Submit property</a></li>
                </ul>
            </div>
        </div>
    </nav><!-- /.mani-menu-cont -->
    <div class="success_info">
        <div class="container">
            <?= Yii::$app->session->getFlash('success'); ?>
        </div>
    </div>
    <div class="error_info">
        <div class="container">
            <?= Yii::$app->session->getFlash('error'); ?>
        </div>
    </div>
</header>