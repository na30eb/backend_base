<?php

$form = \yii\widgets\ActiveForm::begin();

echo  $form->field($model, 'name')->textInput();
echo  $form->field($model, 'surname')->textInput();

echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']);

\yii\widgets\ActiveForm::end();

?>