<?php
declare(strict_types = 1);

namespace app\models\data;

/**
 * In this example, just data. But it could have logic too. The main point is that this
 * class is reusable within the app and is isolated from forms and from DB. If either of
 * those changes, the corresponding changes to mapping logic are isolated elsewhere.
 */
class Rating
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Movie
     */
    public $movie;
    /**
     * @var int
     */
    public $rating;
}
