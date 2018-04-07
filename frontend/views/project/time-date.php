<?php
Pjax::begin(); ?>
<?= Html::a("Показать дату", ['pjax-demo/date'], ['class' => 'btn btn-lg
btn-success']) ?>
<?= Html::a("Показать время", ['pjax-demo/time'], ['class' => 'btn btn-lg
btn-primary']) ?>
<h1>Сейчас: <?= $response ?></h1>
<?php Pjax::end(); ?>