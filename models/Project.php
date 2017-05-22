<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * Project model
 */
class Project extends ActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
