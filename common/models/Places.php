<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "places".
 *
 * @property string $id
 * @property string $id_session
 * @property string $nr
 */
class Places extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%places}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_session', 'nr'], 'required'],
            [['id_session', 'nr'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_session' => Yii::t('app', 'Id Session'),
            'nr' => Yii::t('app', 'Nr'),
        ];
    }
}
