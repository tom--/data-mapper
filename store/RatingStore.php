<?php

namespace app\store;

use app\models\ar\RatingRecord;
use app\models\data\Rating;
use yii\db\ActiveQuery;

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
        $record = RatingRecord::findOne([
            'user_id' => $object->user->id,
            'movie_id' => $object->movie->id,
        ]);
        if (empty($record)) {
            $record = new RatingRecord([
                'user_id' => $object->user->id,
                'movie_id' => $object->movie->id,
            ]);
        }
        $record->rating = $object->rating;
        $record->save(false);
    }

    public function getUserRating(int $userId, int $movieId): Rating
    {
        return static::fromRecord(
            $this->one(
                RatingRecord::find()
                    ->joinWith('movie')
                    ->where(['user_id' => $userId])
                    ->andWhere(['movie_id' => $movieId])
            )
        );
    }

    /**
     * @param $id
     * @return Rating[]
     */
    public function getMovieRatings($id): array
    {
        return array_map([static::class, 'fromRecord'], RatingRecord::findAll(['movie_id' => $id]));
    }

    public static function fromRecord(RatingRecord $record)
    {
        $model = new Rating();
        $model->user = UserStore::fromRecord($record->user);
        $model->movie = MovieStore::fromRecord($record->movie);
        $model->rating = $record->rating;

        return $model;
    }

    protected function one(ActiveQuery $query): RatingRecord
    {
        /** @var \app\models\ar\RatingRecord $model */
        $model = $query->one();

        if (empty($model)) {
            throw new RatingNotFound();
        }

        return $model;
    }
}
