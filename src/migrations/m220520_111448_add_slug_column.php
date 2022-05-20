<?php

use yii\db\Migration;

/**
 * Class m220520_111448_add_slug_column
 */
class m220520_111448_add_slug_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'slug', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post','slug');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220520_111448_add_slug_column cannot be reverted.\n";

        return false;
    }
    */
}
