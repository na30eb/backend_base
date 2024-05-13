<?php
namespace app\controllers;

use SebastianBergmann\CodeCoverage\Report\Html\Renderer;
use yii\base\Controller;

class HelloController extends Controller{//hello
    public function actionIndex()//index
    {
        return $this->render('index');
    }
}



?>