<?php
namespace app\models;
use yii\base\Model;

class TestModel extends Model{
    public $name;
    public $surename;
    public $email;

    public function attributeLabels(){
    
        return [
            'name'=>'Enter your name ',
            'afe'=>'your age ',
        ];
    }

    public function rules()
    {
        return[
            [['name' ,'surename'] , 'required' ,'message'=>'please enter your name ']
        ];
    }
       
}


?>