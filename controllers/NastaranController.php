<?php
namespace app\controllers;

use yii\base\Controller;
use SebastianBergmann\CodeCoverage\Report\Html\Renderer;

class NastaranController extends Controller{//nastaran
    public function actionMsg(){ //msg
        //nastaran/msg.php ==>view
        return $this->render('msg');
    }

    public function actionPartest($id){//partest

        return $this->render("partest",[
            'user'=>'nastaran',
            'status'=>$id,
            //'requestnum'=>$request_num,
        ]);  
    }

}

?>