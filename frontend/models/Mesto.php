<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "Mesto".
 *
 * @property int $id
 * @property string $fio
 * @property string $mesto
 * @property int $id_user
 */
class Mesto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Mesto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'mesto', 'id_user'], 'required'],
            [['fio', 'mesto'], 'string'],
            [['id_user'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Ф.И.О.',
            'mesto' => 'Место работы',
            'id_user' => 'Id User',
        ];
    }
}
