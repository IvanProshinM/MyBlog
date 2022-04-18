<?php

use yii\db\Migration;

/**
 * Class m220418_102443_addColumn
 */
class m220418_102443_addColumn extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('user', 'username', $this->text());
        $this->addColumn('user', 'nickname', $this->text());
        $this->addColumn('user', 'password', $this->text());
        $this->addColumn('user', 'email', $this->text());
        $this->addColumn('user', 'activateHash', $this->text());
        $this->addColumn('user', 'activatedAt', $this->text());


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'username');
        $this->dropColumn('user', 'nickname');
        $this->dropColumn('user', 'password');
        $this->dropColumn('user', 'email');
        $this->dropColumn('user', 'activateHash');
        $this->dropColumn('user', 'activatedAt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220418_102443_addColumn cannot be reverted.\n";

        return false;
    }
    */
}
