<?php
declare(strict_types = 1);

namespace app\models\forms;

use app\models\domain\User;
use app\repositories\UserNotFound;
use app\repositories\UserRepo;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     */
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()) {
            try {
                $user = (new UserRepo())->findByUsername($this->username);
            } catch (UserNotFound $e) {
                $this->addError($attribute, 'Incorrect username');

                return;
            }

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login() : bool
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     */
    public function getUser() : User
    {
        if (empty($this->_user)) {
            $this->_user = (new UserRepo())->findByUsername($this->username);
        }

        return $this->_user;
    }
}
