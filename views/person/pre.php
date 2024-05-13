<div class="container">

    <h1>User Profile</h1>
    <p>Name: <?= $model->name ?></p>
    <p>Surname: <?= $model->surname ?></p>

    <?php

    echo \yii\helpers\Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this user?',
            'method' => 'post',
        ],
    ]);
    ?>

</div>


