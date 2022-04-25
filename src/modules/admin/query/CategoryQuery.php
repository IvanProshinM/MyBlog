<?php

namespace app\query;

use app\models\Category;

/**
 * This is the ActiveQuery class for [[\app\models\User]].
 *
 * @see \app\models\Category
 */
class StaffQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return \app\models\Category[]|array
     * nam
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

}

