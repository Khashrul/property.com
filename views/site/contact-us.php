<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'lanoyo.com';
$base_url = Url::home(true);
?>
<div id="wrapper">

    <section class="contact-page-1 no-padding" style="height: 680px;">
        <div id="contact-map1"></div>
        <div class="contact1-cont">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row contact1">
                            <div class="col-sm-12">
                                <h5 class="subtitle-margin">get in touch</h5>
                                <h1>Contact Us<span class="special-color">.</span></h1>
                                <div class="title-separator-primary"></div>
                            </div>
                            <div class="col-xs-12 col-md-6 margin-top-45">
                                <p class="negative-margin">If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
                                <img src="<?=$base_url?>images/Lanoyo.jpg" alt="" class="pull-left margin-top-45 hidden-md" />
                                <address class="contact-info pull-left">
                                    <span><i class="fa fa-map-marker"></i>Tribune Tower (8th Floor),<br>2-B kda avenue,Khulna-9100</span>
                                    <span><i class="fa fa-envelope fa-sm"></i><a href="#">info@lanoyo.com</a></span>
                                    <span><i class="fa fa-phone"></i>+88-041-731839, +880 1996 304 100</span>
                                    <span><i class="fa fa-globe"></i><a href="#">http://www.lanoyo.com</a></span>
                                </address>
                            </div>
                            <div class="col-xs-12 col-md-6 margin-top-45">
                                <!--<form name="contact-from" id="contact-form" action="#" method="get">-->
                                <?php $form = ActiveForm::begin(['id' => 'contact-from']); ?>
                                <div id="form-result"></div>
                                <input name="name" id="name" type="text" class="input-short2 main-input required,all" placeholder="Your name" />
                                <input name="phone" id="phone" type="text" class="input-short2 pull-right main-input required,all" placeholder="Your phone" />
                                <input name="email" id="email" type="email" class="input-full main-input required,email" placeholder="Your email" />
                                <textarea name="message" id="message" class="input-full contact-textarea main-input required,email" placeholder="Your question"></textarea>
                                <div class="form-submit-cont">
                                    <a href="javascript:void(0)" class="button-primary pull-right" id="form-submit">
                                        <span>send</span>
                                        <div class="button-triangle"></div>
                                        <div class="button-triangle2"></div>
                                        <div class="button-icon"><i class="fa fa-paper-plane"></i></div>
                                    </a>
                                    <div class="clearfix"></div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBaFb-9fPEhBUj2YvbstHFTDm9qwOGMmgg&amp;libraries=places"></script>

<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        mapInit(41.6926,-87.6021,"contact-map1","images/pin-contact.png", true, true);
    }
</script>