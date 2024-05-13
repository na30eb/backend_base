<?php
use yii\helpers\Html;


?>
<!---->
<!--<div class="user-itme">-->
<!--    <h2>--><?php //= \yii\helpers\Html::encode($model->name) ?><!--</h2>-->
<!--    --><?php //= \yii\helpers\Html::process($model->surname)?>
<!--</div>-->

<div class="row">
    <h2><?= Html::encode($model->name) ?></h2>
    <p><?= Html::encode($model->surname) ?></p>
</div>
