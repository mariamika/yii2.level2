<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m181129_153819_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id_comment' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'task_id' => $this->integer(),
            'message' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->addForeignKey('fk_comment_tasks','comment','task_id','tasks','id_task');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_comment_tasks','comment');
        $this->dropTable('comment');
    }
}
