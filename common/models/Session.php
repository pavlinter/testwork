<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property string $id_halls
 * @property string $id_films
 * @property string $begin
 * @property string $end
 *
 * @property Films $idFilms
 * @property Halls $idHalls
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%session}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_halls', 'id_films', 'begin', 'end'], 'required'],
            [['id_halls', 'id_films'], 'integer'],
            [['begin', 'end'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_halls' => Yii::t('app', 'Halls'),
            'id_films' => Yii::t('app', 'Films'),
            'begin' => Yii::t('app', 'Begin'),
            'end' => Yii::t('app', 'End'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasOne(Films::className(), ['id' => 'id_films']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasOne(Halls::className(), ['id' => 'id_halls']);
    }
}
