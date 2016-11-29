<?php

namespace app\models\data;

use app\store\UserStore;

class User implements \yii\web\IdentityInterface
{
    public $id;
    public $username;

    public function validatePassword(string $password): bool
    {
        // password security is not implemented. passsword is same as username
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
