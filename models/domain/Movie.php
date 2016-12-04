<?php
declare(strict_types = 1);

namespace app\models\domain;

use yii\base\InvalidParamException;

/**
 * The domain model representing a movie.
 *
 * A domain model encapsulates its state and is immutable. Field values can be set only
 * at instantiation and are read explicitly through methods
 */
class Movie
{
    private $id;
    private $title;
    private $numRatings;
    private $meanRating;

    /**
     * @param int $id The model's unique id
     * @param string $title The movie title
     * @param int $numRatings The number of user ratings the movie has been given
     * @param float $meanRating The average user rating of the movie. Zero when numRatings is zero.
     */
    public function __construct(int $id, string $title, int $numRatings = 0, float $meanRating = 0.0)
    {
        if ($numRatings === 0 && $meanRating !== 0.0) {
            throw new InvalidParamException('meanRating must be zero if the movie has no ratings');
        }

        $this->id = $id;
        $this->title = $title;
        $this->numRatings = $numRatings;
        $this->meanRating = $meanRating;
    }

    /**
     * @return int The model's unique id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string The movie title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return integer The number of user ratings the movie has been given
     */
    public function getNumRatings(): int
    {
        return $this->numRatings;
    }

    /**
     * @return float The average user rating of the movie. Zero when numRatings is zero.
     */
    public function getMeanRating(): float
    {
        return $this->meanRating;
    }
}
