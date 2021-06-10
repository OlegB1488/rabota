<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
    <div class="row0">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'fio')->textInput(['class' => 'textarea','autofocus' => true]) ?>

                <?= $form->field($model, 'mesto')->textInput(['class' => 'textarea','autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>