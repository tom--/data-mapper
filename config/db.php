<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:' . dirname(__DIR__) . '/runtime/movie_ratings.db',
    'charset' => 'utf8',
];
