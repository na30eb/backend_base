<div class="container">

    <h1>brand Profile</h1>
    <p>Name: <?= $brand_model->name ?></p>

    <?php

    echo \yii\helpers\Html::a('Delete', ['delete', 'id' => $brand_model->id_brand], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this user?',
            'method' => 'post',
        ],
    ]);
    ?>

</div>


