<?php

namespace app\controllers;

use app\models\forms\RateForm;
use app\store\RatingStore;
use Yii;
use yii\web\Controller;

class ReviewController extends Controller
{
    public function actionRate()
    {
        $form = new RateForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            // The controller understands nothing of input mapping (from form model to data object)
            // except that the form model provides it.
            $dataObject = $form->getDataObject(Yii::$app->user);

            // And understands nothing of storage mapping (from data object to persistent storage),
            // not even where it is.
            (new RatingStore())->save($dataObject);

            return $this->redirect(['somewhere']);
        }

        return $this->render('form', ['model' => $form]);
    }
}
