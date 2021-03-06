<?php

namespace app\models;

use Yii;

class Department extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'department';
    }

    public function rules()
    {
        return [
            [['name', 'description', 'is_active'], 'required'],
            [['description'], 'string'],
            [['is_active'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Departamento',
            'description' => 'Descrição',
            'is_active' => 'Situação',
        ];
    }
}
