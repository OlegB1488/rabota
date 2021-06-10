<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProfileStudent */
/* @var $form ActiveForm */
?>
<div class="row0">
    <div class="col-lg-5">
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'text')->textarea(['class' => 'textarea2']) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-profilestudent -->
