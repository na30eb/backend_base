<?php

namespace app\models;

class Brand extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return 'brands';
    }
    public function rules(): array
    {
        return [
            ['name', 'required'],
            // Other validation rules if any
        ];
    }
    public function getModels()
    {
        return $this->hasMany(AddModel::class, ['id_brand' => 'id_brand']);
    }


}

