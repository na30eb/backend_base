<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Update car: ' . $selected->id_car;

?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="person-update">
    <?php
    $form=\yii\bootstrap\ActiveForm::begin();
    echo "<p>please sign in before you submit your order ! thank you for your pationce </p>";

    ?>
    <div class="dropdown">
        <?= $form->field($carmodel, 'id')->widget(Select2::classname(), [
            'data' => $modeldropdownOptions,
            'id' => 'brand-dropdown',
            'options' => ['placeholder' => 'Select a car ...'],
            'disabled' => false,
            'class' => 'test',
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label('cars:'); ?>

        <?php
        echo $form->field($carDetail,'inventory')->textInput();
        echo $form->field($carDetail,'initialPrice')->textInput();

        echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']);

        \yii\bootstrap\ActiveForm::end();

        ?>

</div>
