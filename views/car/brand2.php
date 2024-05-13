<?php use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

foreach ($result as $item): ?>
    <?= $item['brand_name'] ?> - <?= $item['model_name'] ?><br>
<?php endforeach; ?>
<p>Suggestions: <span id="txtHint"></span></p>

<?php
echo "<hr>";
$form = ActiveForm::begin([
    'id' => 'my-form-id',
    'enableAjaxValidation' => true, // Enable AJAX validation
    'enableClientValidation' => true,
    'validationUrl' => ['site/validation'], // URL to validate the form fields
]);

echo $form->field($brand, 'name')->textInput();

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();
?>
<script>
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  xmlhttp.open("GET", "gethint.php?q=" + str);
  xmlhttp.send();
  }
}
</script>


