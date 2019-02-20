<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\Generic;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= Html::encode($this->title) ?></title>
    <meta name="keywords" content="Download, Apartment, Premium, Real Estate, HMTL, Site Template, property, mortgage, CSS" />
    <meta name="description" content="Download Apartment - Premium Real Estate HMTL Site Template" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


    <!--<meta charset="<?/*= Yii::$app->charset */?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?/*= Html::csrfMetaTags() */?>
    <title><?/*= Html::encode($this->title) */?></title>-->
    <?php $this->head() ?>
</head>
<body>
<?php Generic::determineCountry(); ?>
<?php $this->beginBody() ?>
<?php echo $this->render('../elements/common_header'); ?>
<?= $content ?>
<?php echo $this->render('../elements/common_footer'); ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
