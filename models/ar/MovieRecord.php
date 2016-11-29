<?php
declare(strict_types = 1);

namespace app\models\ar;

use app\models\data\Rating;
use yii\db\ActiveRecord;

/**
 * Standard AR model without any form or validation stuff. This does nothing except
 * provide a standard API to the persistent storage data structures. This is not an
 * abstract API, it reflects e.g. DB schema, so DB migrations may cause rework of
 * store class logic.
 *
 * @property int $id
 * @property string $title
 *
 * @property Rating[] $ratings
 */
class MovieRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'movie';
    }

    public function getNumRatings(): int
    {
        return $this->getRatings()->count();
    }

    public function getMeanRating(): float
    {
        return $this->getRatings()->average('rating') ?: 0;
    }

    public function getRatings()
    {
        return $this->hasMany(RatingRecord::class, ['movie_id' => 'id']);
    }
}
