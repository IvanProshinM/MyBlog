<?php

use yii\db\Migration;

/**
 * Class m220504_122228_change_column
 */
class m220504_122228_change_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('post', 'created_At', 'created_at');
        $this->renameColumn('post', 'updated_At', 'updated_at');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('post', 'created_at', 'created_At');
        $this->renameColumn('post', 'created_at', 'updated_At');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220504_122228_change_column cannot be reverted.\n";

        return false;
    }
    */
}
