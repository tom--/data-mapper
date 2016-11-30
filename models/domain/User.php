<?php
declare(strict_types = 1);

namespace app\models\domain;

use app\store\UserStore;
use yii\web\IdentityInterface;

class User implements IdentityInterface
{
    public $id;
    public $username;

    public function validatePassword(string $password): bool
    {
        // password security is not implemented. password is same as username
        return $this->username === $password;
    }

    public static function findIdentity($id)
    {
        return (new UserStore())->findById($id);
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
