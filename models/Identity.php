<?php
declare(strict_types = 1);

namespace app\models;

use app\models\domain\User;
use app\repositories\UserRepo;
use yii\base\Object;
use yii\web\IdentityInterface;

/**
 * The Identity class for Yii's authentication mechanisms.
 *
 * Password authentication is implemented trivially, i.e. without any security.
 * AccessToken authentication and AuthKey ("Remember Me") authentication are not implemented.
 */
class Identity extends Object implements IdentityInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user, array $config = [])
    {
        parent::__construct($config);
        $this->user = $user;
    }

    /**
     * @param string $username
     * @return \app\models\Identity
     */
    public static function findByUsername(string $username): Identity
    {
        $identity = new Identity((new UserRepo())->findByUsername($username));

        return $identity;
    }

    public function getModel(): User
    {
        return $this->user;
    }

    public function getUsername(): string
    {
        return $this->user->getUsername();
    }

    public function getId()
    {
        return $this->user->getId();
    }

    public function validatePassword(string $password): bool
    {
        // password security is not implemented. password is same as username
        return $this->getUsername() === $password;
    }

    public static function findIdentity($id)
    {
        return new Identity((new UserRepo())->findById($id));
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
