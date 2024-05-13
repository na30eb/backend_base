<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update Person: ' . $selected->name;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="person-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($selected, 'name')->textInput() ?>

    <?= $form->field($selected, 'family')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
