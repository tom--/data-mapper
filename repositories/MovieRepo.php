<?php
declare(strict_types = 1);

namespace app\repositories;

use app\models\ar\MovieRecord;
use app\models\domain\Movie;

/**
 * The "store" class for Movie data models.
 *
 * A "store" class isolates the persistence logic for data models from their users.
 * The data model user does not know anything about how the models are saved to
 * persistent storage, how they are retrieved or changed.
 */
class MovieRepo
{
    public static function fromRecord(MovieRecord $record = null) : Movie
    {
        if (empty($record)) {
            throw new MovieNotFound();
        }

        $movie = new Movie();
        $movie->setId((int) $record->id);
        $movie->setTitle($record->title);
        $movie->setNumRatings($record->getNumRatings());
        $movie->setMeanRating($record->getMeanRating());

        return $movie;
    }

    public function findById(int $id): Movie
    {
        return $this->fromRecord(MovieRecord::findOne($id));
    }

    /**
     * @return Movie[]
     */
    public function findAll(): array
    {
        return array_map([static::class, 'fromRecord'], MovieRecord::find()->all());
    }
}
