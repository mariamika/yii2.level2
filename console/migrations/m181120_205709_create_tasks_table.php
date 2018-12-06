<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tasks`.
 */
class m181120_205709_create_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks', [
            'id_task' => $this->primaryKey(),
            'taskName' => $this->string()->notNull(),
            'description' => $this->string(),
            'statusTask' => $this->integer()->notNull()->defaultValue(1),
            'namePerformer' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull(),
            'creator' => $this->integer()->notNull(),
            'dateCreate' => $this->date()->notNull(),
            'dateDeadline' => $this->date(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks');
    }
}
