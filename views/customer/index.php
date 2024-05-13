<?php


use yii\grid\ActionColumn;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        // Columns from the related models
        [
            'attribute' => 'name', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'first name',
        ],
        [
            'attribute' => 'family', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'last name',
        ],
        [
            'class' => ActionColumn::class,
            'header' => 'Actions',
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $customers, $key, $index) {
                if ($action === 'update') {
                    return \yii\helpers\Url::to(['update', 'id' => $customers->id]); // Update action URL
                }
                if ($action === 'delete') {
                    return \yii\helpers\Url::to(['delete', 'id' => $customers->id]); // Delete action URL
                }
            },
        ],
    ],
]);
