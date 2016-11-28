<?php

namespace app\models\forms;

use app\models\data\Rating;
use yii\web\User;

/**
 * Standard Yii form model except for the addition of methods containing logic
 * mapping between a form instance and whatever data object(s) it uses.
 */
class RateForm extends \yii\base\Model
{
    public $movieId;
    public $rating;

    public function rules() : array
    {
        // whatever you need. familliar stuff
        return [
            [['rating'], 'required'],
        ];
    }

    public function getDataObject(User $user) : Rating
    {
        return new Rating([
            'userId' => $user->id,
            'movieId' => $this->movieId,
            'rating' => $this->rating,
        ]);
    }
}
