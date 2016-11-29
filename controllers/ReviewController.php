<?php

namespace app\controllers;

use app\models\forms\RateForm;
use app\store\MovieStore;
use app\store\RatingStore;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class ReviewController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => [],
                    ],
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
        }

        $movies = (new MovieStore())->findAll();
        return $this->render('index', [
            'provider' => new ArrayDataProvider([
                'allModels' => $movies,
                //'totalCount' => count($movies),
            ])
        ]);
    }

    public function actionRate($id)
    {
        $form = new RateForm();
        $form->movie = (new MovieStore())->findById($id);
        $form->user = Yii::$app->user->identity;
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            // The controller understands nothing of input mapping (from form model to data object)
            // except that the form model provides it.
            $rating = $form->getDataModel();

            // And understands nothing of storage mapping (from data object to persistent storage),
            // not even where it is.
            (new RatingStore())->save($rating);

            return $this->redirect(['index']);
        }

        return $this->render('rate', [
            'model' => $form,
        ]);
    }
}
