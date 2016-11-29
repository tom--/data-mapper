<?php

/** @var \yii\data\ArrayDataProvider $provider */

?>

<h3>Click a title to add/change your review</h3>

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
