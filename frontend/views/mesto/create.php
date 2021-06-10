<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Mesto */

$this->title = 'Create Mesto';
$this->params['breadcrumbs'][] = ['label' => 'Mestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
