<?php

/* @var $this yii\web\View */

$this->title = 'Data mapping demo';
?>

<div class="site-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <p>Log in to review movies</p>
    <?php else: ?>
        <p>Hi, <?= /** @noinspection PhpUndefinedFieldInspection */
            Yii::$app->user->identity->getUsername() ?></p>
        <p>You may</p>
        <ul><li><?= \yii\bootstrap\Html::a('Review movies', ['review/index']) ?></li></ul>
    <?php endif ?>
</div>

