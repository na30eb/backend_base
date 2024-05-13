<?php

/** @var $content string  */

use app\assets\AppAsset;

/** @var $this \yii\web\View */

?>

<?php $this->beginContent('@app/views/layouts/clear.php') ?>

<div class="container">
<?php   echo $content ?>
</div>


<?php $this->endContent() ?>




