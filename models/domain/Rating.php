<?php
declare(strict_types = 1);

namespace app\models\domain;

/**
 * In this example, just data. But it could have logic too. The main point is that this
 * class is reusable within the app and is isolated from forms and from DB. If either of
 * those changes, the corresponding changes to mapping logic are isolated elsewhere.
 */
class Rating
{
    private $user;
    private $movie;
    private $rating;

    public function __construct(User $user, Movie $movie, int $rating)
    {
        $this->user = $user;
        $this->movie = $movie;
        $this->rating = $rating;
    }

    /**
     * @return \app\models\domain\User The user that gave this rating
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return \app\models\domain\Movie The movie of which this is the user's rating
     */
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return int The rating
     */
    public function getRating(): int
    {
        return $this->rating;
    }
}
