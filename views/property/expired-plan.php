<?php
use yii\helpers\Url;
use app\components\Generic;
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

                    </div>

                    <div class="row list-offer-row">
                        <div class="col-xs-12">
                            <?php
                            echo $this->render('../elements/sidebar_right',array(
                                'image' => '/images/limit_exceed.png',
                                'button_link' => 'my-offer',
                                'message' => 'You have added maximum number of properties for current package. Check them at:',
                                'button' => 'My Offer',
                                'footer' => '<div class="footer">
                                <h3 style="margin: -40px 17px 20px; color: #fff">Do you want to add more property?</h3>
                                <p style="text-align: center;">
                                    <a href="'.$base_url.'subscription-upgrade" target="_blank" class="activation_link" style="background: #00b000">Upgrade Package</a>
                                </p>
                            </div>',
                            ));
                            ?>
                        </div>
                    </div>

<!--                    <div class="offer-pagination margin-top-30">-->
<!--                        <a href="#" class="prev"><i class="jfont">&#xe800;</i></a><a class="active">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#" class="next"><i class="jfont">&#xe802;</i></a>-->
<!--                        <div class="clearfix"></div>-->
<!--                    </div>-->
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

                    ?>
                </div>
            </div>
        </div>
    </section>

</div>