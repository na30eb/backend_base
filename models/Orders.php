<?php

namespace app\models;

class Orders extends \yii\db\ActiveRecord{
    public static function tableName(){
        return 'orders';
    }
    public function rules(){
        return [
            [['car_id','customer_id','initial_price','final_price'], 'required'],
            // Other validation rules if any
        ];
    }
    public function getCar()
    {
        return $this->hasOne(CarModel::className(), ['id' => 'car_id']);
    }
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
    public function getCardetail()
    {
        return $this->hasOne(Cardetail::className(), ['id_car' => 'car_id']);
    }

}