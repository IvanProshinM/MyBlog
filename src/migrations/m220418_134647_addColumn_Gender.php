<?php

use yii\db\Migration;

/**
 * Class m220418_134647_addColumn_Gender
 */
class m220418_134647_addColumn_Gender extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'gender', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'gender');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220418_134647_addColumn_Gender cannot be reverted.\n";

        return false;
    }
    */
}
