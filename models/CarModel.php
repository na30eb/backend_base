<?php

namespace app\models;

use yii\db\ActiveRecord;

class CarModel extends ActiveRecord{
    public static function tableName(): string
    {
        return 'car';
    }
    public function rules(): array
    {
        return[
            [['id_brand','id_model','color','speed','consumption'],'required'],
            [['id_brand','id_model','speed','consumption'],'integer'],
            [['color'],'string'],
        ];
    }
    public function getBrand(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Brand::className(), ['id_brand' => 'id_brand']);
    }
    public function getModel(): \yii\db\ActiveQuery
    {
        return $this->hasOne(AddModel::className(), ['id_model' => 'id_model']);
    }
    public function getDetail(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Cardetail::className(), ['id_car' => 'id']);
    }
}