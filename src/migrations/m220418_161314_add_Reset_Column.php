<?php

use yii\db\Migration;

/**
 * Class m220418_161314_add_Reset_Column
 */
class m220418_161314_add_Reset_Column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'resetHash', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'resetHash', $this->text());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220418_161314_add_Reset_Column cannot be reverted.\n";

        return false;
    }
    */
}
