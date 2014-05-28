<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cinema".
 *
 * @property string $id
 * @property string $name
 *
 * @property Halls[] $halls
 */
class Cinema extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cinema}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => Yii::t('app', 'Surname'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHalls()
    {
        return $this->hasMany(Halls::className(), ['id_cinima' => 'id']);
    }
}
