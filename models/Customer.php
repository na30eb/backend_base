<?php

namespace app\models;

use yii\db\ActiveRecord;

class Customer extends ActiveRecord{
    public static function tableName(){
        return 'customer';
    }
    public function rules()
    {
        return [
            [['name','family'], 'required'],
        ];
    }
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'id']);

    }
}