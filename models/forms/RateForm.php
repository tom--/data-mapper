<?php
declare(strict_types = 1);

namespace app\models\forms;

use app\models\domain\Movie;
use app\models\domain\Rating;
use yii\base\Model;

/**
 * Standard Yii form model except for the addition of methods containing logic
 * mapping between a form instance and whatever data object(s) it uses.
 */
class RateForm extends Model
{
    /**
     * @var int
     */
    public $rating;
    /**
     * @var \app\models\domain\User
     */
    public $user;
    /**
     * @var Movie
     */
    public $movie;

    public function rules() : array
    {
        // Whatever you need. Familiar stuff
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
