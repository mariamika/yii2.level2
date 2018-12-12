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
            'responsible' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
        $this->addForeignKey('fk_tasks_project','tasks','project_id','project','id_project');
        $this->addForeignKey('fk_project_user','project','responsible','user','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tasks_project','tasks');
        $this->dropForeignKey('fk_project_user','project');
        $this->dropTable('project');
    }
}
