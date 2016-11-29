<?php

namespace app\models\forms;

use app\models\data\Movie;
use app\models\data\Rating;

/**
 * Standard Yii form model except for the addition of methods containing logic
 * mapping between a form instance and whatever data object(s) it uses.
 */
class RateForm extends \yii\base\Model
{
    /**
     * @var int
     */
    public $rating;
    /**
     * @var \app\models\data\User
     */
    public $user;
    /**
     * @var Movie
     */
    public $movie;

    public function rules() : array
    {
        // whatever you need. familliar stuff
        return [
            ['rating', 'required'],
            ['rating', 'number', 'min' => 1, 'max' => 5],
        ];
    }

    public function getDataModel() : Rating
    {
        $model = new Rating();
        $model->rating = $this->rating;
        $model->user = $this->user;
        $model->movie = $this->movie;

        return $model;
    }
}
