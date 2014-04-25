<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use common\models\Films;
use common\models\Halls;
use yii\helpers\ArrayHelper;

$halls = ArrayHelper::merge([''=>''],Halls::find()->select('id,name')->all());
$films = ArrayHelper::merge([''=>''],Films::find()->select('id,name')->all());
/**
 * @var yii\web\View $this
 */
$this->title = 'Cinema';


?>
<div class="session-index">



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_halls',
                'format'=>'raw',
                'value'=>function ($model, $index, $widget) {
                        return $model->halls->name;
                    },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map($halls,'id','name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],
            [
                'attribute' => 'id_films',
                'format'=>'raw',
                'value'=>function ($model, $index, $widget) {
                        return $model->films->name;
                    },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map($films,'id','name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ],
            ],
            [
                'attribute' => 'begin',
                'filterType'=>GridView::FILTER_DATE,
                'filterWidgetOptions' => [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                    ],
                ],

            ],
            [
                'attribute' => 'free_places',
                'filter'=>false,
                'format'=>'raw',
                'value'=>function ($model, $index, $widget) {
                        $busy = Yii::$app->db->createCommand("
                            SELECT COUNT(*) FROM
                                {{%places}}
                                WHERE id_session=:id",[':id'=>$model->id])->queryScalar();

                    return Html::a(($model->halls->count_place - $busy).'/'.$model->halls->count_place,['places','session'=>$model->id]);
                },

            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
