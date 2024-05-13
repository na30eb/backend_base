<?php
//add
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'surname',
        [
            'class' => ActionColumn::class,
            'header' => 'Actions',
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'update') {
                    return \yii\helpers\Url::to(['update', 'id' => $model->id]); // Update action URL
                }
                if ($action === 'delete') {
                    return \yii\helpers\Url::to(['delete', 'id' => $model->id]); // Delete action URL
                }
            },
        ],
    ],
]);


?>


