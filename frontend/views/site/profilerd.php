<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title='Профиль';
?>
<section>

    <h2>Создайте вакансию</h2>
    <hr>
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'title')->textInput(['class' => 'textarea', 'autofocus' => true]) ?>

                <?= $form->field($model, 'zp')->textInput(['class' => 'textarea']) ?>

                <?= $form->field($model, 'description')->textarea(['class' => 'textarea']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Опубликовать', ['class' => 'button', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>

</section>