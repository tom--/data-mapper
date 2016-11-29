<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/** @var \app\models\forms\RateForm $model */

?>

<h1>Rate: “<?= \yii\bootstrap\Html::encode($model->movie->title) ?>”</h1>

<div class="invitation-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rating')->input('number', ['min' => 1, 'max' => 5]) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>
</div>
