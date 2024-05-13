
<?php

use kartik\select2\Select2;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;

echo 'successful <br>';
//    echo var_dump($showAll);
?>
    <?php foreach ($showbrand as $item): ?>
    <?= $item->id_model ?> - <?= $item->name ?>- <?= $item->id_brand ?><br>
<?php endforeach; ?>

<div class="container">

    <div class="dropdown">
        <?php $form = \yii\widgets\ActiveForm::begin(); ?>
        <?= $form->field($brandModel, 'id_brand')->widget(Select2::classname(), [
            'data' => $dropdownOptions,
            'id' => 'brand-dropdown',
            'options' => ['placeholder' => 'Select a brand ...'],
            'disabled' => false,
            'class' => 'test',
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label('Brands'); ?>

        <?= $form->field($addModel, 'id_model')->widget(Select2::classname(), [
            'id' => 'model-dropdown',
            'data' => $modeldropdownOptions,
            'options' => ['placeholder' => 'Select a model ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('Models'); ?>
    </div>



    <?= $form->field($carmodel,'color')->textInput()?>
            <?= $form->field($carmodel,'consumption')->textInput()?>
            <?= $form->field($carmodel,'speed')->textInput()?>

            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        <?php \yii\widgets\ActiveForm::end();?>

</div>

<?php
$js = <<<JS
$(function() {
    $('#brand-id_brand').change(function() {
        var brandId = $(this).val();
        $.ajax({
            url: '/car/get',
            method: 'GET',
            data: { brandId: brandId },
            success: function(response) {
                $('#addmodel-id_model').empty();
                $.each(response, function(index, model) {
                    $('#addmodel-id_model').append($('<option>', {
                        value: model.id,
                        text: model.name
                    }));
                })
                $('#addmodel-id_model').trigger('change');
            },
        });
    });
});
JS;
$this->registerJs($js);
?>

