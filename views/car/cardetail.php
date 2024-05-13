<?php

use yii\grid\ActionColumn;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',

        // Columns from the related models
        [
            'attribute' => 'id_car', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'id car',
        ],
        [
            'attribute' => 'inventory', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'inventory',
        ],
        'price',
        [
            'class' => ActionColumn::class,
            'header' => 'Actions',
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $cars, $key, $index) {
                if ($action === 'update') {
                    return \yii\helpers\Url::to(['update', 'id' => $cars->id]); // Update action URL
                }
                if ($action === 'delete') {
                    return \yii\helpers\Url::to(['delete', 'id' => $cars->id]); // Delete action URL
                }
            },
        ],
    ],
]);

?>