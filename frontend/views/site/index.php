
<section1>
    <div class="fon">
        <form action="" method="post" class="search">
            <input type="search" name="" placeholder="поиск" class="input" />
            <input type="submit" name="" value="" class="submit" />
        </form>
    </div>
</section1>

<section2>
    <div class="cards">
    <?
    use yii\helpers\Html;

    foreach ($model as $vacancy):?>
        <div class="card">
    <h3><?=$vacancy->title?></h3>
    <p><?=$vacancy->description?></p>
    <p><?=$vacancy->zp?></p>
            <?php
                if (Yii::$app->user->can('student')){
                    echo Html::beginForm(['/site/index'], 'post');
                    echo Html::activeInput('text', $otklik, 'id_vacancy', ['hidden' => 'true', 'value' => $vacancy->id]);
                    echo Html::submitButton(
                        'Откликнутся',
                        ['class' => 'button']
                    );
                    echo Html::endForm();
                }
            ?>
        </div>
    <?endforeach;?>
    </div>
</section2>
