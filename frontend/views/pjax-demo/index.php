<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(); ?>
<?= Html::a("Обновить", ['pjax-demo/index'], ['id'=>'refreshButton','class' => 'btn btn-lg btn-primary']) ?>
<h1>Сейчас: <?= $time ?></h1>
<?php Pjax::end(); ?>