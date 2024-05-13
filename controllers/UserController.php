<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex()
    {
        $db = Yii::$app->db;

        $users=$db->createCommand("select username from user")->queryAll();
        var_dump($users);
        return 'List of users ';

    }
    public function actionView($id=1 , $username='nastaran')
    {
        $db = Yii::$app->db;

        $users=$db->createCommand("select username from user where id=:id AND username=:username")
            ->bindValue('username', $username)
            ->bindValue('id',$id)
            ->queryOne();
        echo '<pre>';
        var_dump($users);
        echo '<pre>';

    }
    public function actionCreate()
    {
        $db = Yii::$app->db;
        $result=$db->createCommand("")->insert('user',[
            'username'=>'yasaman',
            'status'=>'1',
            'createdAt'=>date('Y-m-d H:i:s'),
            'email'=>'yasaman@gmail.com',
        ])->execute();
        echo '<pre>';
        var_dump($result);
        echo '<pre>';
        return 'User created';
    }
    public function actionUpdate()
    {
        $db = Yii::$app->db;
        $db->createCommand()->update('user',[
            'email'=>'yasamansdfsd@gmail.com',
        ],[
            'id'=>4
        ])->execute();
        return 'user updated';
    }

    public function actionDelete()
    {
        $db = Yii::$app->db;
        $db->createCommand()->delete('user',[
            'id'=>5
        ])->execute();
        return 'user deleted';

    }

    public function actionUpsert(){
        $db = Yii::$app->db;
        $db->createCommand()->upsert('user',[
            'username'=>'nastaran',
            'email'=>'aaaaa@gmail.com',
        ],[
            'email'=>'bbbbbb@gmail.com',
        ])->execute();
    }
    public function actionAdduser(){
        $db = Yii::$app->db;
        $model= new \app\models\UserModel();
    }

}



?>