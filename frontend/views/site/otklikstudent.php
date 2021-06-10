<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../web/css/site.css">
    <title>Отклики</title>
</head>
<body>
<section>
    <h2>Это вакансии на которые вы откликнулись</h2>
    <hr>
<div class="cards">
    <?
    foreach ($model as $vacancy):?>
        <div class="card">
            <h3><?=$vacancy->vacancy->title?></h3>
            <p><?=$vacancy->vacancy->description?></p>
            <p><?=$vacancy->vacancy->zp?></p>
        </div>
    <?endforeach;?>
</div>
</section>
</body>
</html>