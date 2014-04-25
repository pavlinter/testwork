<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Session;

/**
 * SessionSearch represents the model behind the search form about `common\models\Session`.
 */
class SessionSearch extends Session
{
    public $free_places = '';


    public function rules()
    {
        return [
            [['id', 'id_halls', 'id_films'], 'integer'],
            [['begin', 'end', 'free_places'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Session::find();
        $query = Session::find()
            ->innerJoin(['film'=>'{{%films}}'],'film.id=id_films')
            ->innerJoin(['hall'=>'{{%halls}}'],'hall.id=id_halls')
            ->with([
                'films',
                'halls',
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['id_films']['asc'] = ['film.name' => SORT_ASC];
        $dataProvider->sort->attributes['id_films']['desc'] = ['film.name' => SORT_DESC];
        $dataProvider->sort->attributes['id_halls']['asc'] = ['hall.name' => SORT_ASC];
        $dataProvider->sort->attributes['id_halls']['desc'] = ['hall.name' => SORT_DESC];

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'session.id' => $this->id,
            'id_halls' => $this->id_halls,
            'id_films' => $this->id_films,
        ]);


        $query->andFilterWhere(['like', 'begin', $this->begin])
            ->andFilterWhere(['like', 'end', $this->end]);

        return $dataProvider;
    }



}
