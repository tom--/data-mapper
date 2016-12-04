<?php
declare(strict_types = 1);

namespace app\models\domain;

class User
{
    private $id;
    private $username;

    public function __construct(int $id, string $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    /**
     * @return int The model's unique id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string The users username
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
