<?php

use yii\db\Migration;

/**
 * Handles the creation of table `performer`.
 */
class m181120_211650_create_performer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('performer', [
            'index' => $this->primaryKey(),
            'name' => $this->string(150)->notNull(),
            'id_users' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('performer');
    }
}
