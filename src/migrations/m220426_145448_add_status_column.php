<?php

use yii\db\Migration;

/**
 * Class m220426_145448_add_status_column
 */
class m220426_145448_add_status_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220426_145448_add_status_column cannot be reverted.\n";

        return false;
    }
    */
}
