<!-- views/person/index.php -->


<h1>All Users</h1>
<!---->
<!--<table class="table">-->
<!--    <thead>-->
<!--    <tr>-->
<!--        <th>id</th>-->
<!--        <th>Name</th>-->
<!--        <th>Surname</th>-->
<!--        <th>config</th>-->
<!--    </tr>-->
<!--    </thead>-->
<!--    <tbody>-->
<!--    --><?php //foreach ($users as $user): ?>
<!--        <tr>-->
<!--            <td>--><?php //= $user->id ?><!--</td>-->
<!--            <td>--><?php //= $user->name ?><!--</td>-->
<!--            <td>--><?php //= $user->surname ?><!--</td>-->
<!--            <td>-->
<!--                <td>--><?php //= \yii\helpers\Html::a('Edit', ['edit', 'id' => $user->id], ['class' => 'btn btn-primary']) ?><!--</td>-->
<!--                <td>-->
<!--                --><?php

//                echo \yii\helpers\Html::a('Delete', ['delete', 'id' => $user->id], [
//                    'class' => 'btn btn-danger',
//                    'data' => [
//                        'confirm' => 'Are you sure you want to delete this user?',
//                        'method' => 'post',
//                    ],
//                ]);
//                ?>
<!---->
<!--            </td>-->
<!--        </tr>-->
<!--    --><?php //endforeach; ?>
<!--    </tbody>-->
<!--</table>-->

<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_user',
]);
?>