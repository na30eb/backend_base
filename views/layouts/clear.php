
<?php

/** @var $content string  */

use app\assets\AppAsset;

/** @var $this \yii\web\View */
AppAsset::register($this);

?>

<?php
echo $this->beginPage()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->registerCsrfMetaTags()    ?>
    <title>Document</title>
    <?php echo $this->head() ?>
</head>
<body>

<?php
echo $this->beginBody();
?>

<?php   echo $content ?>
<?php
echo $this->endBody();
?>
</body>
</html>
<?php
echo $this->endPage();
?>

