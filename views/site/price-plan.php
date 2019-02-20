<?php
use yii\widgets\ActiveForm;
$this->title = 'lanoyo.com';
?>

<section class="section-light section-top-shadow">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    <section class="section-light">
                        <div class="container">
                            <div class="row">
                                <?php foreach($packages as $package) { ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4">
                                        <?php $form = ActiveForm::begin(['id' => 'package-choose-form','action' => Yii::$app->urlManager->createUrl('payment-selection')]); ?>
                                        <div class="price-table">
                                            <div class="price-table-header">
                                                <h2 class="second-color"><?= $package->name ?><span class="third-color">.</span></h2>
                                                <div class="price-table-triangle"></div>
                                                <div class="price-table-icon">&#2547;<?php echo intval($package->price) ?></div>
                                            </div>
                                            <div class="price-table-body">
                                                <?= $package->details ?>
                                            </div>
                                            <div class="price-table-footer">
                                                <div class="price-table-triangle2"></div>
                                                <input type="hidden" name="package_id" value="<?= $package->id ?>">
                                                <button class="button-primary button-shadow pull-right">
                                                    <span>Choose Package</span>
                                                    <div class="button-triangle"></div>
                                                    <div class="button-triangle2"></div>
                                                    <div class="button-icon"><i class="jfont">&#xe802;</i></div>
                                                </button>
                                            </div>
                                        </div>
                                        <?php ActiveForm::end(); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>