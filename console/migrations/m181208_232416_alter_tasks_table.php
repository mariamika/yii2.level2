<?php

use yii\db\Migration;

/**
 * Class m181208_232416_alter_tasks_table
 */
class m181208_232416_alter_tasks_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tasks','project_id','integer');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('tasks','project_id');
    }
}
