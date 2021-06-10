<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use common\models\User;


/**
 * This is the model class for table "vacancy".
 *
 * @property int $id
 * @property string $title
 * @property string $zp
 * @property string $description
 * @property int $id_user
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Otklik[] $otkliks
 * @property User $user
 */
class ProfileRd extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'zp', 'description', 'id_user'], 'required'],
            [['title', 'zp', 'description'], 'string'],
            [['id_user'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'title' => 'Название',
            'zp' => 'Оклад',
            'description' => 'Описание',
            'id_user' => 'Id User',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Otkliks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOtkliks()
    {
        return $this->hasMany(Otklik::className(), ['id_vacancy' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
