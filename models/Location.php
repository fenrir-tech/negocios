<?php

namespace app\models;

use Yii;

class Location extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'location';
    }

    public function rules()
    {
        return [
            [['shortname', 'fullname', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['shortname','num_cnpj','zipcode','phone'], 'string', 'max' => 50],
            [['fullname','email'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 200],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shortname' => 'Nº do PA',
            'fullname' => 'Nome da Agência',
            'address' => 'Endereço',
            'zipcode' => 'CEP',
            'num_cnpj' => 'CNPJ',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'is_active' => 'Situação',
        ];
    }
}
