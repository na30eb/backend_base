<?php

namespace app\models;

use yii\db\ActiveRecord;

class Person extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'person';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['surname'], 'default', 'value' => ''],
            [['name', 'surname'], 'string', 'max' => 255],
        ];

    }


}