<?php


namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap5\Html;

class BgWidget extends Widget
{
    public $bgcolor='white';
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        ob_start();
    }
    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
        $output=ob_get_clean();
//        return $this->render('test',[
//            'message'=>'hello from widget viw  file'
//        ]);
//        return Html::tag('div',$output,[
//        'style'=>'background-color:'.$this->bgcolor
//        ]);

//        return'<div>'.$output.'</div>';
    }
}



?>