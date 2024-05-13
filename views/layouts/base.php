<?php

/** @var $content string  */

use app\assets\AppAsset;

/** @var $this \yii\web\View */

?>

<?php $this->beginContent('@app/views/layouts/clear.php') ?>
<header>
    header goes here 
</header>

<div class="container">
    <div class="row" >
        <div class="col-sm-9">
        <?php   echo $content ?>
        </div>
        <div class="col-sm-3">

            <ul class="list-group">
                <li class="list-group-item">sidebar item 1 </li>
                <li class="list-group-item">sidebar item 2</li>
                <li class="list-group-item">sidebar item 3</li>
            </ul>
            <hr>
            <?php if(isset($this->blocks['sidebar'])): ?>
                <?php echo $this->blocks['sidebar'] ?> 
            <?php endif; ?>
        </div>
    </div>
</div>

<footer>
    footer goes here 
</footer>


<?php $this->endContent() ?>
