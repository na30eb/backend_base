<?php

namespace app\models;

use yii\db\ActiveRecord;

class Test1 extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'person';
    }

    public static function findByLastName(int $id): array
    {
        return static::find()
            ->select(['id', 'name'])
            ->from('person')
            ->where(['id' => $id])
            ->limit(10)
            ->all();


    }

    public static function selectAll(): array
    {
        return static::find()
            ->select('*')
            ->from('person')
            ->limit(5)
            ->all();
    }

    public static function selectOne($id): array
    {
        return static::find()
            ->select(['id','name','surname'])
            ->from('person')
            ->where(('id=:id'))
            ->addParams([':id' => $id])
            ->all();
    }

}


