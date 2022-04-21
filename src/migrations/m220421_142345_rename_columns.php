<?php

use yii\db\Migration;

/**
 * Class m220421_142345_rename_columns
 */
class m220421_142345_rename_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('category', 'createdAt', 'created_at');
        $this->renameColumn('category', 'updatedAt', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('category', 'created_at', 'createdAt');
        $this->renameColumn('category', 'updated_at', 'updatedAt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220421_142345_rename_columns cannot be reverted.\n";

        return false;
    }
    */
}
