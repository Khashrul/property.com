<?php
    /**
     * top_left.php
     */
    use yii\helpers\Url;
    $base_url = Url::home(true);
?>

<!-- Top Left Begins -->
<div class="sidebar<?=isset($left) ? ($left ? '-left' : '') : '' ?>">
    <h3 class="sidebar-title"><?=isset($heading) ? $heading : 'Welcome Back' ?><span class="special-color">.</span></h3>
    <div class="title-separator-primary"></div>

    <div class="profile-info <?=isset($margin_top) ? 'margin-top-'.$margin_top : '' ?>">
        <div class="profile-info-title negative-margin"><?=isset($name) ? $name : ''?></div>
        <img src="<?=isset($photo) ? $photo : $base_url.'images/no-image.jpg'?>" alt="" class="pull-left" />
        <div class="profile-info-text pull-left">
            <p class="subtitle-margin"><?php if($user_type == 1){ echo "Owner";} else {echo "Agent";} ?></p>
            <a href="<?=Yii::$app->urlManager->createUrl(array('site/userlogout'))?>" class="logout-link margin-top-30"><i class="fa fa-lg fa-sign-out"></i>Logout</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="center-button-cont margin-top-30">
        <a href="<?=$base_url?>my-offer" class="button-primary button-shadow button-full">
            <span>My offers</span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="fa fa-th-list"></i></div>
        </a>
    </div>
    <div class="center-button-cont margin-top-15">
        <a href="<?=$base_url?>my-profile" class="button-primary button-shadow button-full">
            <span>My profile</span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="fa fa-user"></i></div>
        </a>
    </div>
    <div class="center-button-cont margin-top-15">
        <a href="<?=$base_url?>submit-property" class="button-primary button-shadow button-full">
            <span>add property</span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="jfont fa-lg">&#xe804;</i></div>
        </a>
    </div>
    <div class="center-button-cont margin-top-15">
        <a href="<?=$base_url?>subscription-upgrade" class="button-primary button-shadow button-full">
            <span>Upgrade Package</span>
            <div class="button-triangle"></div>
            <div class="button-triangle2"></div>
            <div class="button-icon"><i class="fa fa-pencil-square-o"></i></div>
        </a>
    </div>
</div>
<!-- Top Left Ends -->
