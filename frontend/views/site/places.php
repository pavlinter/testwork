<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 */
$this->title = 'Places';
$this->params['breadcrumbs'][] = $this->title;
ksort($places);
$free_places = [];
for ($i = 1; $i <= $model->halls->count_place; $i++) {
    if (!isset($places[$i])) {
        $free_places[] = $i;
    }
}


?>

<div class="session-view">

    <h2>Cinema: <span style="color: darkseagreen;"><?= Html::encode($model->halls->cinema->name) ?></span></h2>
    <h2>Hall: <span style="color: darkseagreen;"><?= Html::encode($model->halls->name) ?></span></h2>
    <h2>Film: <span style="color: darkseagreen;"><?= Html::encode($model->films->name) ?></span></h2>
    <h3>
        <span>Free places:</span>
        <span>
            <?php
                foreach ($free_places as $place) {
                    echo Html::a('№'.$place, ['','session' => $model->id, 'id' => $place], [
                        'style' => 'margin-left: 10px;',
                        'class' => 'btn btn-min btn-success',
                        'data' => [
                            'confirm' => 'Купить данное место?',
                            'method' => 'post',
                        ],
                    ]);
                }

                if (!$free_places) {
                    echo '<span style="color: darkseagreen;">Нет свободных мест</span>';
                }

            ?>
        </span>
    </h3>
</div>
