<?php
declare(strict_types = 1);

namespace app\repositories;

use app\models\ar\UserRecord;
use app\models\domain\User;

/**
 * The "store" class for UserMovieRating data model objects.
 *
 * A "store" class isolates the persistence logic for data models from their users.
 * The data model user does not know anything about how the models are saved to
 * persistent storage, how they are retrieved or changed.
 */
class UserRepo
{
    public static function fromRecord(UserRecord $record = null): User
    {
        if (empty($record)) {
            throw new UserNotFound();
        }

        $user = new User();
        $user->setId((int) $record->id);
        $user->setUsername($record->username);

        return $user;
    }

    public function findByUsername(string $username): User
    {
        return $this->fromRecord(UserRecord::findOne(['username' => $username]));
    }

    public function findById(int $id): User
    {
        return $this->fromRecord(UserRecord::findOne($id));
    }
}
