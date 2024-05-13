<h1>Edit User</h1>
<?php $form = \yii\widgets\ActiveForm::begin(); ?>
<?php echo  $form->field($model, 'name')->textInput() ?>
<?php echo $form->field($model, 'surname')->textInput() ?>
<!--<div class="form-group">-->
<?php echo \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
<?php \yii\widgets\ActiveForm::end();

?>

<?php
echo "dakdkas";
?>
