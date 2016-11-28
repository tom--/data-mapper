<?php

namespace app\store;

use app\models\data\Rating;

/**
 * The "store" class for UserMovieRating data model objects.
 *
 * A "store" class isolates the persistence logic for data models from their users.
 * The data model user doesn't know anything about how the models are saved to
 * persistant storage, how they are retrieved or changed. They could
 */
class RatingStore
{
    public function save(Rating $object)
    {
        (new \app\models\ar\Rating([
            'userId' => $object->userId,
            'movieId' => $object->movieId,
            'stars' => $object->rating,
        ]))->insert(false);
    }
}
