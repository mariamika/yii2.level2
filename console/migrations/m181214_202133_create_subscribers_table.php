<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribers`.
 */
class m181214_202133_create_subscribers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('subscribers', [
            'id' => $this->primaryKey(),
            'subscriber' => $this->integer()->notNull(),
            'event' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('subscribers');
    }
}
