<?php

namespace app\models;

use Yii;

class AddModel extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'models';
    }

    public function rules()
    {
        return [
            [['name', 'id_brand'], 'required'],
            // Other validation rules if any
        ];
    }

    // Define the relation to the Brand model
    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id_brand' => 'id_brand']);
    }
    public function getCar()
    {
        return $this->hasMany(CarModel::class, ['id_model' => 'id_model']);
    }
}
