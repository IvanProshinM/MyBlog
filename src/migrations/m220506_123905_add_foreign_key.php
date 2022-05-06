<?php

use yii\db\Migration;

/**
 * Class m220506_123905_add_foreign_key
 */
class m220506_123905_add_foreign_key extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('post_category_post', 'post_category', 'post_id', 'post', 'id');
        $this->addForeignKey('post_category_category', 'post_category', 'category_id', 'category', 'id');
        $this->createIndex('post_unique', 'post_category', ['post_id', 'category_id'], 'true');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('post_category_post', 'post_category');
        $this->dropForeignKey('post_category_category', 'post_category');
        $this->dropIndex('post_unique', 'post_category');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220506_123905_add_foreign_key cannot be reverted.\n";

        return false;
    }
    */
}
