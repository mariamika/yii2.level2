<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m181129_111136_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id_comment' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_task' => $this->integer(),
            'message' => $this->string(),
        ]);
        $this->addForeignKey('fk_comment_tasks','comment','id_task','tasks','id_task');
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
