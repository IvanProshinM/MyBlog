<?php

use yii\db\Migration;

/**
 * Class m220519_161815_add_postOwner_column
 */
class m220519_161815_add_postOwner_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'redactor', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('post', 'redactor');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220519_161815_add_postOwner_column cannot be reverted.\n";

        return false;
    }
    */
}
