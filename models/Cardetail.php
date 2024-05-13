<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cardetail extends ActiveRecord{
    public static function tableName(){
        return 'carDetails';
    }
    public function rules()
    {
        return [
            [['id_car','inventory','initialPrice'], 'required'],
        ];
    }
    public function getCar()
    {
        return $this->hasOne(CarModel::className(), ['id' => 'id_car']);
    }
}