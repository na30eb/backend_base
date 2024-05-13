<?php
namespace app\models;

use yii\db\ActiveRecord;

class jointest extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'brands';
    }

    public static function test()
    {
        return static::find()->all();
    }
    public static function join()
    {


    }


    public static function innerjointest()
    {

    }

}