<?php

namespace app\controllers;

use TestModel;
use yii\base\Controller;

class TestController extends Controller{

    public function actionTest(){//test

        $test =new TestModel();

        //assiging attribute

        $test -> name='jon';

        $test['surename']='doe';

        echo $test['surename'];
    }

}


?>