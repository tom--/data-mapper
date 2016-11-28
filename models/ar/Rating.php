<?php

namespace app\models\ar;

use yii\db\ActiveRecord;

/**
 * Standard AR model without any form or validation stuff. This does nothing except
 * provide a standard API to the persistent storage data structures. This is not an
 * abstract API, it reflects e.g. DB schema, so DB migrations may cause rework of
 * Persister logic.
 */
class Rating extends ActiveRecord
{
    public static function tableName()
    {
        return 'rating';
    }
}
