<div>
    <?foreach ($model as $vacancy):?>
    <h1><?=$vacancy->name?></h1>
    <h1><?=$vacancy->description?></h1>
    <h1><?=$vacancy->zp?></h1>
    <?endforeach;?>
</div>