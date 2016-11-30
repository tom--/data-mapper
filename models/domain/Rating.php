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

    public function getUser() : User
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getMovie() : Movie
    {
        return $this->movie;
    }

    public function setMovie(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getRating() : int
    {
        return $this->rating;
    }

    public function setRating(int $rating)
    {
        $this->rating = $rating;
    }
}
