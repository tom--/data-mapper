<?php
declare(strict_types = 1);

namespace app\models\data;

class Movie
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var int
     */
    public $numRatings;
    /**
     * @var float
     */
    public $meanRating;
}
