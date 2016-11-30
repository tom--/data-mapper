<?php
declare(strict_types = 1);

namespace app\models\domain;

use yii\base\Object;

class Movie extends Object
{
    private $id;
    private $title;
    private $numRatings;
    private $meanRating;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setNumRatings(int $numRatings)
    {
        $this->numRatings = $numRatings;
    }

    public function setMeanRating(float $meanRating)
    {
        $this->meanRating = $meanRating;
    }

    public function getNumRatings()
    {
        return $this->numRatings;
    }

    public function getMeanRating()
    {
        return $this->meanRating;
    }
}
