<?php
use yii\helpers\Html;

//echo \yii\helpers\Html::encode($data);

foreach ($data as $item): ?>
    <?= $item ?>
<?php endforeach;

//echo $find_id;
echo "<br>"

//foreach ($find_id as $item): ?>
<!--    --><?php //= $item ?>
<?php //endforeach;
?>
<?php foreach ($find_id as $item): ?>
    <?= $item->id ?> - <?= $item->name ?><br>
<?php endforeach; ?>
<?php echo "--------------------------------------------"?>
<?php foreach ($select_all as $item): ?>
    <?= $item->id ?> - <?= $item->name ?><br>
<?php endforeach; ?>

<?php echo "--------------------------------------------"?>
<?php foreach ($select_one as $item): ?>
    <?= $item->id ?> - <?= $item->name ?>- <?= $item->surname?><br>
<?php endforeach; ?>

<?php echo "--------------------------------------------"?>
<?php foreach ($testquery as $item): ?>
    <?= $item->id_brand ?> - <?= $item->name ?><br>
<?php endforeach; ?>

