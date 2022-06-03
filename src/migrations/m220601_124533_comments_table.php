<?php

use yii\db\Migration;

/**
 * Class m220601_124533_comments_table
 */
class m220601_124533_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comments', [
            'id' => $this->primaryKey(),
            'author' => $this->string(),
            'content' => $this->text(),
            'postId' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('comments');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220601_124533_comments_table cannot be reverted.\n";

        return false;
    }
    */
}
