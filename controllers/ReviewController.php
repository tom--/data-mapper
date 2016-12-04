<?php
declare(strict_types = 1);

namespace app\controllers;

use app\models\forms\RateForm;
use app\repositories\MovieRepo;
use app\repositories\RatingRepo;
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

        $movies = (new MovieRepo())->findAll();
        return $this->render('index', [
            'provider' => new ArrayDataProvider([
                'allModels' => $movies,
                //'totalCount' => count($movies),
            ])
        ]);
    }

    /**
     * @param string|int $id
     * @return string|\yii\web\Response
     */
    public function actionRate($id)
    {
        $form = new RateForm();
        $form->movie = (new MovieRepo())->findById((int) $id);
        /** @noinspection PhpUndefinedMethodInspection */
        $form->user = Yii::$app->user->identity->getModel();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            // The controller understands nothing of input mapping (from form model to data object)
            // except that the form model provides it.
            $rating = $form->getDataModel();

            // And understands nothing of storage mapping (from data object to persistent storage),
            // not even where it is.
            (new RatingRepo())->save($rating);

            return $this->redirect(['index']);
        }

        return $this->render('rate', [
            'model' => $form,
        ]);
    }
}
