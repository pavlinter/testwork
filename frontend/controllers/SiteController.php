<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Cinema;
use common\models\Films;
use common\models\Halls;
use common\models\Session;
use common\models\Places;
use common\models\SessionSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionInstall()
    {



        Yii::$app->db->createCommand()->truncateTable('{{%places}}')->execute();
        Yii::$app->db->createCommand()->truncateTable('{{%session}}')->execute();



        $halls = Halls::find()->asArray()->all();
        $films = Films::find()->asArray()->all();

        $currentDay = strtotime(date('Y-m-d')) + 3600 * 8;
        $nexDay     = strtotime('+24 hour',$currentDay);

        $times = [];
        while ($currentDay < $nexDay) {

            $currentDay += 3600*2;
            $times[] = [
                'secconds' => $currentDay,
                'begin' => date('Y-m-d H:i:s',$currentDay),
                'end' => date('Y-m-d H:i:s',$currentDay + 3*1800),
            ];
        }


        $new = [];
        foreach ($halls as $hall) {

            if (!mt_rand(0,2)) {
                continue;
            }

            foreach ($films as $film) {

                if (mt_rand(0,3)) {
                    $keys   = array_rand($times,mt_rand(1,3));
                    if (!is_array($keys)) {
                        $keys = [$keys];

                    }
                    foreach ($keys as $key) {
                        $new[] = ArrayHelper::merge([
                            'id_films' => $film['id'],
                            'id_halls' => $hall['id'],
                            'count_place' => $hall['count_place'],
                        ],$times[$key]);
                    }

                }
            }
        }

        foreach ($new as $data) {
            $model = new Session();
            $model->attributes = $data;
            if ($model->save(false)) {

                for ($i = 1; $i <= $data['count_place']; $i++) {
                    if (!mt_rand(0,1)) {
                        $places = new Places();

                        $places->attributes = [
                            'id_session' => $model->id,
                            'nr' => $i,
                        ];
                        $places->save(false);
                    }
                }
            }

        }
        return $this->render('install');
    }

    public function actionIndex()
    {

        $searchModel = new SessionSearch;
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionPlaces($session,$id = 0)
    {
        $model = Session::findOne($session);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $places = Places::find()->where(['id_session'=>$model->id])->indexBy('nr')->asArray()->all();

        if (Yii::$app->request->isPost && $id) {
            $places = new Places();
            $places->nr = $id;
            $places->id_session = $model->id;
            if ($places->save(false)) {
                return $this->redirect(['places','session'=>$session]);
            }
        }

        return $this->render('places', [
            'model' => $model,
            'places' => $places,

        ]);
    }
}
