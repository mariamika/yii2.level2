<?php

use yii\db\Migration;

/**
 * Class m181121_083946_alter_tasks_performer_files_role_table
 */
class m181121_083946_alter_tasks_performer_files_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk_tasks_performer','tasks','namePerformer','performer','index');
        $this->addForeignKey('fk_performer_user','performer','id_users','user','id');
        $this->addForeignKey('fk_files_tasks','files','tasks_id','tasks','id_task');
        $this->addColumn('user','role_id','integer');
        $this->addForeignKey('fk_user_role','user','role_id','role','id_role');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_tasks_performer','tasks');
        $this->dropForeignKey('fk_performer_user','performer');
        $this->dropForeignKey('fk_files_tasks','files');
        $this->dropColumn('user','role_id');
        $this->dropForeignKey('fk_user_role','user');
    }
}
