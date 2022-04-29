<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m220429_114422_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'status' => $this->integer(),
            'publicDate' => $this->integer(),
            'textShort' => $this->text(),
            'textFull' => $this->text(),
            'category' => $this->string(),
            'commentOff' => $this->boolean(),
            'createdAt' => $this->integer(),
            'updatedAt' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
    }
}
