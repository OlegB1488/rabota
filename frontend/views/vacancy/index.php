<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Панель администратора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancy-index">

    <h1>Панель администратора:</h1>

    <p>
        <?= Html::a('Создать вакансию', ['create'], ['class' => 'button']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title:ntext',
            'zp:ntext',
            'description:ntext',
            //'id_user',
            [
                'value' => function($data) {
                    return \common\models\User::find()->where(['id' => $data])->one()->username;
                },
                'header' => 'Работадатель'
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<div class="mesto-index">

    <h1>Место трудоустройства пользователя:</h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'filterModel' => $searchModel2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//              'id',
                'fio',
                'mesto:ntext',
//              'id_user',

        ],
    ]); ?>


</div>
