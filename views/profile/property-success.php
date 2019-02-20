<?php
use yii\helpers\Url;
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
                    <?php
                    echo $this->render('../elements/sidebar_right',array(
                        'image' => '/images/success.png',
                        'button_link' => $property,
                        'message' => 'Your property submitted successfully',
                        'button' => 'Preview Now',
                        'footer' => '<div class="footer">
                                <h3 style="margin: -40px 17px 20px; color: #fff">Do you want to add more property?</h3>
                                <p style="text-align: center;">
                                    <a href="'.$base_url.'submit-property" target="_blank" class="activation_link" style="background: #00b000">Add property</a>
                                </p>
                            </div>',
                    ));
                    ?>
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
                    <?php
                    #Narrow Search
                    echo $this->render('../elements/narrow_search',array(
                        'heading'=>'Your Offer',
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