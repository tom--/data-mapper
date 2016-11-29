<?php

/** @var \yii\data\ArrayDataProvider $provider */

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'attribute' => 'title',
            'content' => function ($model) {
                return \yii\bootstrap\Html::a($model->title, ['rate', 'id' => $model->id], ['encode' => true]);
            }
        ],
        'numRatings',
        'meanRating',
    ],
]) ?>

