<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

/**
 * Standard AR model without any form or validation stuff. This does nothing except
 * provide a standard API to the persistent storage data structures. This is not an
 * abstract API, it reflects e.g. DB schema, so DB migrations may cause rework of
 * Persister logic.
 *
 * @property int $id
 * @property int $user_id
 * @property int $movie_id
 * @property int $rating
 *
 * @property UserRecord $user
 * @property MovieRecord $movie
 */
class RatingRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'rating';
    }

    public function getUser()
    {
        return $this->hasOne(UserRecord::class, ['id' => 'user_id']);
    }

    public function getMovie()
    {
        return $this->hasOne(MovieRecord::class, ['id' => 'movie_id']);
    }
}
