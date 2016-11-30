<?php

/** @var \yii\data\ArrayDataProvider $provider */
use app\models\domain\Movie;

?>

<h3>Click a title to add/change your review</h3>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        [
            'attribute' => 'title',
            'content' => function (Movie $model) {
                return \yii\bootstrap\Html::a($model->getTitle(), ['rate', 'id' => $model->getId()], ['encode' => true]);
            }
        ],
        [
            'attribute' => 'numRatings',
            'content' => function (Movie $model) {
                return $model->getNumRatings();
            }
        ],
        [
            'attribute' => 'meanRating',
            'content' => function (Movie $model) {
                return $model->getMeanRating();
            }
        ],
    ],
]) ?>
