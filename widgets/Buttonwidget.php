<?php
namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap4\Button;

class Buttonwidget extends Widget{
    public  $text;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->text=ucfirst($this->text);
    }
    public function run()
    {
        parent::run(); // TODO: Change the autogenerated stub
        return '<button>'.$this->text.'</button>';
    }

}
?>