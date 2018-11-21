<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files`.
 */
class m181120_212348_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id_file' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'address_big_picture' => $this->string(250),
            'address_small_picture' => $this->string(250),
            'tasks_id' => $this->integer(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('files');
    }
}
