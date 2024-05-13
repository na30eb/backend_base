<?php

use kartik\select2\Select2;
use yii\helpers\Html;

?>
<!--div begin-->
<div class="dropdown">
<!--    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Choose the brand <b class="caret"></b></a>-->
    <?php
    //form begin
    $form = \yii\widgets\ActiveForm::begin(); ?>
<!--    creating filed for dispalaying options from brandmodel which was passed to this view -->
    <?= $form->field($brandModel, 'name')->widget(Select2::classname(), [
        'data' => $dropdownOptions, // $dropdownOptions should contain your dropdown options
        'options' => ['placeholder' => 'Select a brand ...'],//tyhe dispaly text
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label(false); ?>
<!--    // creating the text field for sanding the user input to add model model and then db -->
    <?= $form->field($addModel, 'name')->textInput()->label('Enter model name') ?>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php
    \yii\widgets\ActiveForm::end();
    ?>
</div>
