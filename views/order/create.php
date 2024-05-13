<?php

use kartik\select2\Select2;
use yii\helpers\Html;

?>
<div class="container">

    <div class="dropdown">

                <?php $form = \yii\widgets\ActiveForm::begin(); ?>
                <?= $form->field($customer, 'id')->widget(Select2::classname(), [
                    'data' => $modeldropdownOptions,
                    'id' => 'customer-dropdown',
                    'options' => ['placeholder' => 'list of customers...'],
                    'disabled' => false,
                    'class' => 'test',
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ])->label('Select a customer : '); ?>
Orders


                <?= $form->field($carDetail, 'id_car')->widget(Select2::classname(), [
                    'id' => 'car-dropdown',
                    'data' => $carDropDownOptions,
                    'options' => ['placeholder' => 'list of cars... '],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'pluginEvents'=>[
                        "select2:open" => "function() { console.log('opened'); }"
                    ]
                ])->label('parchased cars'); ?>
    </div>


    <?php echo $form->field($carDetail, 'initialPrice')->textInput(['id' => 'initialPriceField']) ?>
    <?php echo $form->field($order, 'final_price')->textInput(['id' => 'finalPrice']) ?>



    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary',
                                            'id'=>'submit']) ?>
        <?php \yii\widgets\ActiveForm::end();?>

</div>

<?php
$js = <<<JS
$(function() {
    $('#customer-id').change(function() {
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: '/order/get-car-options',
            method: 'POST',
            data: {id:id},
            success: function(response){
            $('#cardetail-id_car').empty();
            $.each(response, function(key, value){
                $('#cardetail-id_car').append('<option value="' + value.id_car + '">' + value.id_car +'</option>');
            });
        },
        });
    });
});
JS;
$this->registerJs($js);
?>

<?php
$js = <<<JS
    $('#cardetail-id_car').on("select2:open",function() {
        var id = $(this).val();
    $.ajax({
        url: '/order/get-init-price', // Change the URL to your controller action that returns the initial price
        method: 'POST',
        data: {id:id},
        dataType: 'json',
        success: function(response){
            console.log(response.initialPrice);
            $('#initialPriceField').val(response.initialPrice);
            $('#initialPriceField').prop('readonly', true); // Make the text field readonly
        }
    });
});

JS;
$this->registerJs($js);
?>
<?php
$js = <<<JS
    $('#cardetail-id_car').on("select2:open",function() {
        var id = $(this).val();
    $.ajax({
        url: '/order/get-total-price', // Change the URL to your controller action that returns the initial price
        method: 'POST',
        data: {id:id},
        dataType: 'json',
        success: function(response){
            console.log(response.NewPrice);
            $('#finalPrice').val(response.NewPrice);
            $('#finalPrice').prop('readonly', true);
        
        }
    });
});

JS;
$this->registerJs($js);
?>
<?php
$js = <<<JS
    $('#cardetail-id_car').change(function() {
        var id = $(this).val();
        console.log('car id ',id);
    $.ajax({
        url: '/order/get-init-price', // Change the URL to your controller action that returns the initial price
        method: 'POST',
        data: {id:id},
        dataType: 'json',
        success: function(response){
            console.log(response.initialPrice);
            $('#initialPriceField').val(response.initialPrice);
            $('#initialPriceField').prop('readonly', true); // Make the text field readonly
        }
    });
});

JS;
$this->registerJs($js);
?>
<?php
$js = <<<JS
    $('#cardetail-id_car').change(function() {
        var id = $(this).val();
    $.ajax({
        url: '/order/get-total-price', // Change the URL to your controller action that returns the initial price
        method: 'POST',
        data: {id:id},
        dataType: 'json',
        success: function(response){
            console.log(response.NewPrice);
            $('#finalPrice').val(response.NewPrice);
            $('#finalPrice').prop('readonly', true);
        
        }
    });
});

JS;
$this->registerJs($js);
?>


