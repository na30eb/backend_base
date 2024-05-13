<?php

$form = \yii\widgets\ActiveForm::begin();

echo $form->field($brandModel, 'name')->textInput();

echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']);

\yii\widgets\ActiveForm::end();

?>