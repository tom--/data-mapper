<?php
declare(strict_types = 1);

namespace app\models\domain;

use app\repositories\UserRepo;
use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    private $id;
    private $username;

    public function getUsername() : string {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function validatePassword(string $password): bool
    {
        // password security is not implemented. password is same as username
        return $this->username === $password;
    }

    public static function findIdentity($id)
    {
        return (new UserRepo())->findById($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {
    }
}
