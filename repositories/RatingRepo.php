<?php
declare(strict_types = 1);

namespace app\repositories;

use app\models\ar\RatingRecord;
use app\models\domain\Rating;
use yii\db\ActiveQuery;

/**
 * The "store" class for UserMovieRating data model objects.
 *
 * A "store" class isolates the persistence logic for data models from their users.
 * The data model user does not know anything about how the models are saved to
 * persistent storage, how they are retrieved or changed.
 */
class RatingRepo
{
    public function save(Rating $object)
    {
        $record = RatingRecord::findOne([
            'user_id' => $object->getUser()->getId(),
            'movie_id' => $object->getMovie()->getId(),
        ]);
        if (empty($record)) {
            $record = new RatingRecord([
                'user_id' => $object->getUser()->getId(),
                'movie_id' => $object->getMovie()->getId(),
            ]);
        }
        $record->rating = $object->getRating();
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
        $model->setUser(UserRepo::fromRecord($record->user));
        $model->setMovie(MovieRepo::fromRecord($record->movie));
        $model->setRating($record->rating);

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
