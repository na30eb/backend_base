<?php
    $form=\yii\bootstrap\ActiveForm::begin();
    echo "<p>please sign in before you submit your order ! thank you for your pationce </p>";

    echo $form->field($customer,'name')->textInput();
    echo $form->field($customer,'family')->textInput();

    echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary']);

    \yii\bootstrap\ActiveForm::end();

?>