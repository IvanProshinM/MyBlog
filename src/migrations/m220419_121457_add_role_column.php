<?php

use yii\db\Migration;

/**
 * Class m220419_121457_add_role_column
 */
class m220419_121457_add_role_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220419_121457_add_role_column cannot be reverted.\n";

        return false;
    }
    */
}
