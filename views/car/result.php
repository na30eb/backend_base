<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\db\Query;


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        // Columns from the related models
        [
            'attribute' => 'brand.name', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'brand name ',
        ],
        [
            'attribute' => 'model.name', // Assuming 'model_name' is the column name in the 'models' table
            'label' => 'Model Name',
        ],
        'color',
        'speed',
        'consumption'

        // Add more columns as needed
    ],
]);