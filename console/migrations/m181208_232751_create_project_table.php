<?php

use yii\db\Migration;

/**
 * Handles the creation of table `project`.
 */
class m181208_232751_create_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id_project' => $this->primaryKey(),
            'projectName' => $this->string()->notNull(),
            'project_status' => $this->integer()->defaultValue(1),
            'description' => $this->string(),
            'responsible' => $this->string(),
        ]);
        $this->addForeignKey('fk_tasks_project','tasks','project_id','project','id_project');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_project_tasks','project');
        $this->dropTable('project');
    }
}
