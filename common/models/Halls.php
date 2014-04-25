<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "halls".
 *
 * @property string $id
 * @property string $id_cinema
 * @property string $name
 * @property string $count_place
 *
 * @property Cinema $idCinema
 * @property Places[] $places
 * @property Session[] $sessions
 */
class Halls extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%halls}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cinema', 'name'], 'required'],
            [['id_cinema', 'count_place'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_cinema' => Yii::t('app', 'Id Cinema'),
            'name' => Yii::t('app', 'Name'),
            'count_place' => Yii::t('app', 'Count Place'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinema()
    {
        return $this->hasOne(Cinema::className(), ['id' => 'id_cinema']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaces()
    {
        return $this->hasMany(Places::className(), ['id_halls' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::className(), ['id_halls' => 'id']);
    }
}
